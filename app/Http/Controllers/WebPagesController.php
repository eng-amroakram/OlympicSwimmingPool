<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\OurService;
use App\Models\Partner;
use App\Models\Settings;
use App\Models\Slider;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    protected $location;
    protected $settings;

    public function __construct()
    {
        $this->location = Location::data()->active()->first();
        $this->settings = Settings::data()->active()->first();
    }

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
        $blogs = Blog::data()->active()->get();

        if ($blogs->count() > 3) {
            $blogs = $blogs->random(3);
        }

        return view('pages.web.landing-page', [
            'sliders' => $sliders,
            'about_us' => $about_us,
            'our_services' => $our_services,
            'location' => $location,
            'gallery' => $gallery,
            'partners' => $partners,
            'settings' => $settings,
            'blogs' => $blogs
        ]);
    }

    public function blog()
    {
        return view('pages.web.blog', [
            'settings' => $this->settings,
            'location' => $this->location
        ]);
    }

    public function blogDetails(Blog $blog)
    {
        $blogs = Blog::data()->active()->get()->random(5);

        return view('pages.web.blog-details', [
            'settings' => $this->settings,
            'location' => $this->location,
            'blogs' => $blogs,
            'blog' => $blog,
        ]);
    }

    public function gallery()
    {
        return view('pages.web.gallery', [
            'settings' => $this->settings,
            'location' => $this->location
        ]);
    }

    public function our_service(OurService $our_service)
    {
        $our_services = OurService::data()->active()->get();
        return view('pages.web.our_service', [
            'settings' => $this->settings,
            'location' => $this->location,
            'our_service' => $our_service,
            'our_services' => $our_services
        ]);
    }
}
