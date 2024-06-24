<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\OurService;
use App\Models\Partner;
use App\Models\Settings;
use App\Models\Slider;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    public function landingPage()
    {
        $filters = ['status' => ["active"]];
        $sliders = Slider::data()->filters($filters)->reorder("id", "asc")->get();
        $about_us = AboutUs::data()->active()->first();
        $our_services = OurService::data()->active()->get();
        $location = Location::data()->active()->first();
        $gallery = Gallery::data()->active()->get();
        $partners = Partner::data()->active()->get();
        $settings = Settings::data()->active()->first();


        return view('pages.web.landing-page', [
            'sliders' => $sliders,
            'about_us' => $about_us,
            'our_services' => $our_services,
            'location' => $location,
            'gallery' => $gallery,
            'partners' => $partners,
            'settings' => $settings
        ]);
    }
}
