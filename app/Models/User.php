<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ModelHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "type",
        "status",
        "password",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "name",
            "email",
            "type",
            "status",
            "password",
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'type' => null,
        ], $filters);


        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['[type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });
    }

    public function scopeChangeAccountStatus(Builder $builder, $id)
    {
        $user = $builder->find($id);
        if ($user) {
            $user->update([
                'status' =>  $user->status == "active" ? "inactive" : "active",
            ]);
            return "تم تغير حالة المستخدم بنجاح";
        }
        return false;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$id"],
            "password" => ['required', 'string', 'min:8'],
            'status' => ['required', 'string', 'in:active,inactive'],
            'type' => ['required', 'string', 'in:superadmin,admin'],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "ادخل الاسم",
            "email.required" => "ادخل البريد الالكتروني",
            "email.email" => "البريد الالكتروني غير صالح",
            "email.unique" => "البريد الإلكتروني مستخدم بالفعل",
            "password.required" => "ادخل كلمة المرور",
            "password.min" => "حقل كلمة المرور يجب أن لا يقل عن 8 أحرف",
            "status.required" => "اختر حالة الحساب",
            "type.required" => "اختر نوع الحساب",
        ];
    }


    public function scopeStore(Builder $builder, array $data = [])
    {

        $user = $builder->create($data);

        if ($user) {
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        if ($data["password"]) {
            $data["password"] = Hash::make($data["password"]);
        } else {
            unset($data["password"]);
        }

        $user = $builder->find($id);

        if ($user) {
            $user = $user->update($data);
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }
}
