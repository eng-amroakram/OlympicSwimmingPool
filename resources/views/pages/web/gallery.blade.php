@extends('layouts.web.app')
@section('content')
    <div class="inner-banner inner-bg7">
        <div class="container">
            <div class="inner-title text-center">
                <h3>البوم الصور</h3>
                <ul>
                    <li>
                        <a href="index.html">الرئيسية</a>
                    </li>
                    <li>
                        <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>الصور</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="gallery-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span>البوم الصور</span>
                <h2 class="margin-auto color-title-blue">صور من داخل المسبح</h2>
            </div>
            <div class="gallery-view pt-45">
                <div class="row">

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-gallery">
                            <img src="{{ asset('assets/web/img/gallery/1.jpg') }}" alt="Gallery Images">
                            <a href="{{ asset('assets/web/img/gallery/1.jpg') }}" class="single-icon">
                                <i class="bx bx-show-alt"></i>
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6 ">
                        <div class="single-gallery">
                            <img src="{{ asset('assets/web/img/gallery/9.jpg') }} " alt="Gallery Images">
                            <a href="{{ asset('assets/web/img/gallery/9.jpg') }} " class="single-icon">
                                <i class="bx bx-show-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
