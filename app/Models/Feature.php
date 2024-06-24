<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'name',
        'status'
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'status'
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
            'name' => ['required', 'string', 'max:255', "unique:features,name,$id"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "ادخل الاسم",
            "name.unique" => "الميزة موجودة بالفعل",
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
