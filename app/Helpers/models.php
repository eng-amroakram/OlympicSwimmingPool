<?php

use App\Http\Controllers\Services\Services;
use App\Models\Feature;
use App\Models\OurService;

if (!function_exists('status_select')) {
    function status_select()
    {
        return [
            "active" => "نشط",
            "inactive" => "غير نشط",
        ];
    }
}

if (!function_exists('count_models')) {
    function count_models($name)
    {
        $model = Services::modelInstance($name);

        if ($model) {
            return $model->count();
        }

        return 0;
    }
}


if (!function_exists('our_services')) {
    function our_services($search = null)
    {
        if ($search) {
            return OurService::data()->active()->pluck("title", 'id')->mapWithKeys(function ($title, $id) {
                return [$id => $title];
            })->toArray();
        }

        return OurService::data()->get();
    }
}


if (!function_exists('features')) {
    function features($search = null)
    {
        if ($search) {
            return Feature::data()->active()->pluck("name", 'id')->mapWithKeys(function ($name, $id) {
                return [$id => $name];
            })->toArray();
        }

        return Feature::data()->get();
    }
}

if (!function_exists('days')) {
    function days()
    {
        return [
            'saturday' => "السبت",
            'sunday' => "الاحد",
            'monday' => "الاثنين",
            'tuesday' => "الثلاثاء",
            'wednesday' => "الاربعاء",
            'thursday' => "الخميس",
            'friday' => "الجمعة"
        ];
    }
}

if (!function_exists('times')) {
    function times()
    {
        return [
            'AM 12:00' => 'AM 12:00',
            'AM 01:00' => 'AM 01:00',
            'AM 02:00' => 'AM 02:00',
            'AM 03:00' => 'AM 03:00',
            'AM 04:00' => 'AM 04:00',
            'AM 05:00' => 'AM 05:00',
            'AM 06:00' => 'AM 06:00',
            'AM 07:00' => 'AM 07:00',
            'AM 08:00' => 'AM 08:00',
            'AM 09:00' => 'AM 09:00',
            'AM 10:00' => 'AM 10:00',
            'AM 11:00' => 'AM 11:00',
            'PM 12:00' => 'PM 12:00',
            'PM 01:00' => 'PM 01:00',
            'PM 02:00' => 'PM 02:00',
            'PM 03:00' => 'PM 03:00',
            'PM 04:00' => 'PM 04:00',
            'PM 05:00' => 'PM 05:00',
            'PM 06:00' => 'PM 06:00',
            'PM 07:00' => 'PM 07:00',
            'PM 08:00' => 'PM 08:00',
            'PM 09:00' => 'PM 09:00',
            'PM 10:00' => 'PM 10:00',
            'PM 11:00' => 'PM 11:00',
        ];
    }
}
