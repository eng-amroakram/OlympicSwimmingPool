@extends('layouts.web.landing-page')
@section('content')
    @livewire('web.contact-us')


    <div class="home-area">
        <div class="container-fluid m-0 p-0">

            <div class="home-slider owl-carousel owl-theme">
                @foreach ($sliders as $slider)
                    <div class="slider-item" style="background-image: url({{ $slider->photo_table }})">
                        <div class="slider-content banner-content">
                            <h3>{{ $slider->sub_title }}</h3>
                            <h1>{{ $slider->title }}</h1>
                            <p>{{ $slider->description }}</p>

                            <div class="slider-btn">
                                <a target="_blank" href="{{ $slider->link }}" class="default-btn default-bg-white">إكتشف
                                    أكثر</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="about-area darkbg pt-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="section-title">
                            <h2 class="yallowbg">{{ $about_us?->title }}</h2>

                            <ul class="features">

                                @foreach ($about_us?->features_relation ?? [] as $feature)
                                    <li>
                                        {{ $feature->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-img">
                        <div class="about-single">
                            <img src="{{ asset('assets/web/img/about/1.jpg') }}" alt="About Images">

                            <div class="about-play">
                                <a href="{{ $about_us?->video_link }}" class="play-btn">
                                    <i class="bx bx-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="project-area pt-100 pb-70">
        <div class="container-fluid">
            <div class="container-max">
                <div class="section-title text-center">
                    {{-- <span> خدماتنا</span> --}}
                    <h2 class="margin-auto">خدماتنا</h2>
                    {{-- <p class="margin-auto">
                        نص تجريبي لتفاصيل الخدمات يكتب هنا نص تجريبي يضاف من لوحة التحكم
                    </p> --}}
                </div>


                <div class="row pt-45">

                    @foreach ($our_services as $our_service)
                        <div class="col-lg-3 col-sm-6">
                            <div class="project-card">
                                <div class="project-card-img">
                                    <a href="projects.html">
                                        <img src="{{ $our_service->photo_table }}" alt="Project Images">
                                    </a>
                                    <div class="project-content">

                                        <a href="projects.html">
                                            <h3>{{ $our_service->title }}</h3>
                                        </a>
                                        <a target="_blank" href="{{ route('web.our_service', $our_service->id) }}"
                                            class="view-more-btn">
                                            <i class="flaticon-diagonal-arrow"></i>
                                            تعرف اكثر
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <div class="location">
        <div class="container">
            <div class="row darkbg align-items-center">
                <div class="col-lg-5">
                    <div class="info-title">
                        <h2 class="yallowbg">{{ $location?->title }}</h2>
                        <ul class="info">
                            <li>
                                <i class="flaticon-email"></i>
                                <span>العنوان</span>
                                <p>{{ $location?->address }}</p>

                            </li>
                            <li>
                                <i class="flaticon-email"></i>

                                <span>البريد الالكتروني
                                </span>
                                <p>{{ $location?->email }}</p>
                            </li>
                            <li>
                                <i class="flaticon-phone-call"></i>
                                <span> الهاتف</span>
                                <p>{{ $location?->phone }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <img src="{{ asset('assets/web/img/home2.jpg') }}" alt="map Images">
                </div>
            </div>
        </div>
    </div>

    <div class="gallery-area pt-100 pb-70">
        <div class="container">

            <div class="section-title text-center">
                <span>مرئيات</span>
                <h2 class="margin-auto color-title-blue">صور ومرئيات</h2>
            </div>

            <div class="brand-slider-two container-max owl-carousel owl-theme owl-rtl owl-loaded owl-drag">

                <div class="owl-stage-outer pt-45">

                    <div class="owl-stage"
                        style="transition: all 0.25s ease 0s; width: 4244px; transform: translate3d(2122px, 0px, 0px);">

                        @foreach ($gallery as $photo)
                            <div class="owl-item cloned gallery-view" style="width: 235.2px; margin-left: 30px;">

                                <div class="single-gallery">
                                    <img src="{{ $photo->photo_table }}" alt="Gallery Images">
                                    <a href="{{ $photo->photo_table }}" class="single-icon">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                </div>

                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                {{-- <span>اخبارنا</span> --}}
                <h2 class="margin-auto">الاخبار والانشطة</h2>
                {{-- <p class="margin-auto">نص تجريبي لنبذة مختصرة عن عنوان الاخبار يكتب هنا نص تجريبي للتفاصيل نبذة مختصرة --}}
                </p>
            </div>
            <div class="row pt-45">

                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-card">
                            <a href="blog-details.html">
                                <img src="{{ $blog->photo_table }}" alt="Blog Images">
                            </a>
                            <div class="blog-content">
                                <ul>
                                    <li>
                                        <i class="bx bx-time-five"></i>
                                        {{ $blog->created_at }}
                                    </li>
                                </ul>
                                <a href="blog-details.html">
                                    <h3>{{ $blog->title }}</h3>
                                </a>
                                <a target="_blank" href="{{ route('web.blog-details', $blog->id) }}" class="more-blog">
                                    <i class="flaticon-diagonal-arrow"></i>
                                    اقرا المزيد
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach





            </div>
        </div>
    </section>

    <div class="brand-area-two pb-100">
        <div class="container">
            <div class="brand-slider-two container-max owl-carousel owl-theme owl-rtl owl-loaded owl-drag">

                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transition: all 0.25s ease 0s; width: 4244px; transform: translate3d(2122px, 0px, 0px);">

                        @foreach ($partners as $partner)
                            <div class="owl-item cloned" style="width: 235.2px; margin-left: 30px;">
                                <div class="brand-item-two">
                                    <a href="#">
                                        <img src="{{ $partner->photo_table }}" class="brand-item-logo1"
                                            alt="Brand Images">
                                        <img src="{{ $partner->photo_table }}" class="brand-item-logo2"
                                            alt="Brand Images">
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="owl-nav disabled">
                    <button type="button" role="presentation" class="owl-prev">
                        <span aria-label="Previous">‹</span></button><button type="button" role="presentation"
                        class="owl-next"><span aria-label="Next">›</span></button>
                </div>
                <div class="owl-dots disabled"></div>
            </div>
        </div>
    </div>
@endsection
