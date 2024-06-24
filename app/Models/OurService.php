<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'photos/our-services';

    protected $fillable = [
        'title',
        'photo',
        'description',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'title',
            'photo',
            'description',
            'status',
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
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeChangeStatus(Builder $builder, $id)
    {
        $model = $builder->find($id);
        if ($model) {
            $model->update([
                'status' =>  $model->status == "active" ? "inactive" : "active",
            ]);
            return true;
        }
        return false;
    }


    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'title' => ['required', 'string', 'max:255', "unique:our_services,title,$id"],
            'photo' => ['required', 'image']
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "title.required" => "ادخل عنوان الخدمة",
            "title.unique" => "الخدمة موجودة بالفعل",
            "photo.required" => "صورة الخدمة مطلوبة",
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
