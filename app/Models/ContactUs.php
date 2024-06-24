<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        "name",
        "email",
        "phone",
        "message",
        "our_service_id",
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            "name",
            "email",
            "phone",
            "message",
            "our_service_id",
        ]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeChangeStatus(Builder $builder, $id)
    {
        $active_model = $this->where('status', 'active')->first();

        if ($active_model) {
            $active_model->update(['status' => 'inactive']);
        }

        $model = $builder->find($id);

        if ($model) {
            $model->update(['status' => 'active']);
            return true;
        }
        return false;
    }


    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'message' => ['required',],
            'time_to' => ['required',],
            'our_service_id' => ['required'],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "الحقل مطلوب",
            "email.required" => "الحقل مطلوب",
            "phone.required" => "الحقل مطلوب",
            "message.required" => "الحقل مطلوب",
            "time_to.required" => "الحقل مطلوب",
            "our_service_id.required" => "الحقل مطلوب",
        ];
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $model = $builder->create($data);

        if ($model) {
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $model = $builder->find($id);

        if ($model) {
            $model = $model->update($data);
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }
}
