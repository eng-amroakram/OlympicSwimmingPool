<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'title',
        'features',
        'video_link',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'title',
            'features',
            'video_link',
            'status',
        ]);
    }

    // Define the accessor for related features
    public function getFeaturesRelationAttribute()
    {
        // Get the IDs from the features JSON field
        $featureIds = $this->features;

        // Return the collection of related Feature models
        return Feature::whereIn('id', $featureIds)->get();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getFeaturesAttribute($value)
    {
        return json_decode($value);
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
            'title' => ['required', 'string', 'max:255', "unique:about_us,title,$id"],
        ];
    }

    public function scopeGetMessages()
    {
        return [
            "name.required" => "ادخل الاسم",
            "name.unique" => "العنوان موجودة بالفعل",
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
