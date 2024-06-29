@extends('layouts.web.app')
@section('content')
    <div class="inner-banner inner-bg2">
        <div class="container">
            <div class="inner-title text-center">
                {{-- <h3>عنوان الصفحة يكتب هنا</h3>

                <ul>
                    <li>
                        <a href="index.html">الرئيسية</a>
                    </li>
                    <li>
                        <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>رابط</li>
                </ul> --}}

            </div>
        </div>
    </div>

    <div class="service-dtls-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="service-left-side">
                        <div class="service-catagory">
                            <h3>جميع الخدمات</h3>
                            <ul>
                                @foreach ($our_services as $our_service_selected)
                                    <li class="{{ $our_service_selected->id == $our_service->id ? 'active' : '' }}">
                                        <a style="text-decoration: none; color: inherit;"
                                            href="{{ route('web.our_service', $our_service_selected->id) }}">
                                            <i class="flaticon-send"></i>
                                            {{ $our_service_selected->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="service-list-side">
                            <ul>
                                <li>
                                    <div class="service-list-icon">
                                        <i class="flaticon-phone-call"></i>
                                    </div>
                                    <span>تواصل معنا</span>
                                    <h3>{{ $location->phone }} (966)+</h3>
                                </li>
                                <li>
                                    <div class="service-list-icon">
                                        <i class="flaticon-email"></i>
                                    </div>
                                    <span>البريد الالكتروني</span>
                                    <h3><a href="../../cdn-cgi/l/email-protection.html" class="__cf_email__"
                                            data-cfemail="761f18101936061f0c1f5815191b">{{ $location->email }}</a></h3>
                                </li>
                                <li>
                                    <div class="service-list-icon">
                                        <i class="flaticon-alarm-clock"></i>
                                    </div>
                                    <span>من {{ __($settings?->day_from) }} الي {{ __($settings?->day_to) }}</span>
                                    <h3>
                                        {{ $settings?->time_to }}
                                        -
                                        {{ $settings?->time_from }}
                                    </h3>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="service-dtls-content">

                        <div class="service-img">
                            <img src="{{ $our_service->photo_table }} " alt="Images">
                        </div>

                        <div class="section-title">
                            <h2 class="color-title-blue">{{ $our_service->title }}</h2>
                            <p>
                                {!! $our_service->description !!}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
