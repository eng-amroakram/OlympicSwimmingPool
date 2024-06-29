<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'photos/settings';

    protected $fillable = [
        "website_name",
        "day_from",
        "day_to",
        "time_from",
        "time_to",
        "photo",
        "status",
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            "website_name",
            "day_from",
            "day_to",
            "time_from",
            "time_to",
            "photo",
            "status",
        ]);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getPhotoTableAttribute()
    {
        return $this->attributes['photo'] ? asset('storage/' . $this->attributes['photo']) : asset('assets/admin/images/no-image-available.jpg');
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('website_name', 'like', '%' . $filters['search'] . '%');
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
            'website_name' => ['required', 'string', 'max:255', "unique:settings,website_name,$id"],
            'day_from' => ['required', 'string'],
            'day_to' => ['required', 'string'],
            'time_from' => ['required',],
            'time_to' => ['required',],
            'photo' => ['required', "max:1024"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "website_name.required" => "ادخل اسم الموقع",
            "website_name.unique" => "الاسم موجودة بالفعل",
            "day_from.required" => "الحقل مطلوب",
            "day_to.required" => "الحقل مطلوب",
            "time_from.required" => "الحقل مطلوب",
            "time_to.required" => "الحقل مطلوب",
            "photo.required" => "الحقل مطلوب"
        ];
    }

    public function scopeStore(Builder $builder, array $data = [])
    {
        $data['photo'] = $builder->storeFile($data['photo']);
        $model = $builder->create($data);

        if ($model) {
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $photo = $data['photo'];

        if (gettype($photo) == "object") {
            $builder->deletePhoto($id);
            $data['photo'] = $builder->storeFile($photo);
        } else {
            unset($data['photo']);
        }

        $model = $builder->find($id);

        if ($model) {
            $model = $model->update($data);
            $this->deleteLivewireTempFiles();
            return true;
        }

        return false;
    }
}
