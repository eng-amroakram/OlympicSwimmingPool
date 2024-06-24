<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'title',
        'address',
        'phone',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'snap_chat',
        'tiktok',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'title',
            'address',
            'phone',
            'email',
            'facebook',
            'instagram',
            'twitter',
            'snap_chat',
            'tiktok',
            'status',
        ]);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
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
            'title' => ['required', 'string', 'max:255', "unique:locations,title,$id"],
            'address' => ['required', 'string', "unique:locations,address,$id"],
            'phone' => ['required', 'string', "unique:locations,phone,$id"],
            'email' => ['required', 'string', "unique:locations,email,$id"],
            'facebook' => ['string', "unique:locations,facebook,$id"],
            'instagram' => ['string', "unique:locations,instagram,$id"],
            'twitter' => ['string', "unique:locations,twitter,$id"],
            'snap_chat' => ['string', "unique:locations,snap_chat,$id"],
            'tiktok' => ['string', "unique:locations,tiktok,$id"],
            // 'status' => ['required', 'string', "unique:locations,status,$id"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "title.required" => "الحقل مطلوب",
            "title.unique" => "العنوان موجود بالفعل",
            "address.required" => "الحقل مطلوب",
            "phone" => "الحقل مطلوب",
            "email" => "الحقل مطلوب",
            // "facebook" => "الحقل مطلوب",
            // "instagram" => "الحقل مطلوب",
            // "twitter" => "الحقل مطلوب",
            // "snap_chat" => "الحقل مطلوب",
            // "tiktok" => "الحقل مطلوب",

        ];
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $model = $builder->create($data);
        if ($model) {
            return true;
        }
        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $model = $builder->find($id);
        if ($model) {
            $model = $model->update($data);
            return true;
        }
        return false;
    }
}
