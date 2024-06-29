@extends('layouts.web.app')
@section('content')
    <div class="inner-banner inner-bg2">
        <div class="container">
            <div class="inner-title text-center">
                {{-- <h3>عنوان الصفحة يكتب هنا</h3>

                <ul>
                    <li>
                        <a href="{{ route('web.landing-page') }}">الرئيسية</a>
                    </li>
                    <li>
                        <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>رابط</li>
                </ul> --}}

            </div>
        </div>
    </div>


    <div class="blog-dtls-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-dtls-content">
                        <div class="blog-dtls-img">
                            <img src="{{ $blog->photo_table }}" alt="Blog Images">
                        </div>

                        <div class="blog-dtls-date">

                            <div class="dtls-submit-date">
                                <h3>{{ $blog->created_at_day }}</h3>
                                <span>{{ $blog->created_at_month }}</span>
                            </div>

                            <p style="margin-top: 80px;">
                            <h2>{{ $blog->title }}</h2>
                            {!! $blog->description !!}
                            </p>
                        </div>



                        <div class="page-next-area">
                            <div class="row align-items-center">

                                <div class="col-lg-6 col-sm-6">

                                    @if ($blog->id > 1)
                                        <div class="prev-post">
                                            <a href="{{ route('web.blog-details', $blog->id - 1) }}">
                                                <i class="flaticon-right-arrow"></i>
                                                الخبر السابق
                                            </a>
                                        </div>
                                    @endif

                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <div class="next-post">
                                        <a href="{{ route('web.blog-details', $blog->id + 1) }}">
                                            الخبر التالي
                                            <i class="flaticon-left-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog-dtls-side">

                        <div class="blog-widget resent-post-widget">
                            <h3 class="title">اقرا ايضا</h3>
                            <ul>

                                @foreach ($blogs as $blog)
                                    <li>
                                        <a href="{{ route('web.blog-details', $blog->id) }}">
                                            <img src="{{ $blog->photo_table }}" alt="Image" width="70"
                                                height="60">
                                            <h3>{{ $blog->title }}</h3>
                                            <span>{{ $blog->created_at }}</span>
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
