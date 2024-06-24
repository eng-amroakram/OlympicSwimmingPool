<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'photos/sliders';

    protected $fillable = [
        "title",
        "sub_title",
        "description",
        "photo",
        "link",
        "status"
    ];

    public function scopeData($query)
    {
        return $query->select([
            "id",
            "title",
            "sub_title",
            "description",
            "photo",
            "link",
            "status"
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
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->where('sub_title', 'like', '%' . $filters['search'] . '%');
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
            'title' => ['required', 'string', 'max:255', "unique:sliders,title,$id"],
            'sub_title' => ['required', 'string', 'max:255', "unique:sliders,sub_title,$id"],
            'photo' => ['required', 'image'],
            'description' => ['required', 'string'],
            'link' => ['required', 'string', 'url'],
            'status' => ['required', 'string', 'in:active,inactive'],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "title.required" => "الحقل مطلوب",
            "title.unique" => "العنوان مستخدم مسبقا",
            "sub_title.required" => "الحقل مطلوب",
            "sub_title.unique" => "العنوان مستخدم مسبقا",
            "photo.required" => "الحقل مطلوب",
            "description.required" => "الحقل مطلوب",
            "link.required" => "الحقل مطلوب",
            "link.url" => "ادخل رابط صالح",
            "status.required" => "اختر حالة السلايدر",
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
