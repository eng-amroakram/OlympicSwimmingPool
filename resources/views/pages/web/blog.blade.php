@extends('layouts.web.app')
@section('content')
    <div class="inner-banner inner-bg2">
        <div class="container">
            <div class="inner-title text-center">
                {{-- <h3>المدونة</h3> --}}

                {{-- <ul>
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

    <div class="blog-page-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row pt-45">

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/1.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            16 فبراير 2024
                                        </li>

                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>نص تجريبي لتفاصيل الخبر يكتب هنا عنوان تجريبي </h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا المزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/2.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            13 January 2024
                                        </li>

                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>عنوان اخر للاخبار يكتب هنا نص تجريبي</h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا المزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/3.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            15 مايو 2024
                                        </li>

                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>عنوان تجريبي لتفاصيل الخبر يكتب هنا نبذة مختصرة</h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا المزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/4.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            17 March 2024
                                        </li>


                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>عنوان اخر للاخبار يكتب هنا نص تجريبي للتفاصيل والاخبار مع رابط للتفاصيل</h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا الامزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/5.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            12 June 2024
                                        </li>

                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>نص لعنوان الخبر يكتب هنا تفاصيل العنوان نص تجريبي</h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا المزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog-card">
                                <a href="blog-details.html">
                                    <img src="{{ asset('assets/web/img/blog/6.jpg') }} " alt="Blog Images">
                                </a>
                                <div class="blog-content">
                                    <ul>
                                        <li>
                                            <i class="bx bx-time-five"></i>
                                            27 July 2024
                                        </li>

                                    </ul>
                                    <a href="blog-details.html">
                                        <h3>عنوان وتفاصيل الخبر يكتب هنا نص تجريبي للتفاصيل</h3>
                                    </a>
                                    <a href="blog-details.html" class="more-blog">
                                        <i class="flaticon-diagonal-arrow"></i>
                                        اقرا المزيد
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="pagination-area">
                                <nav aria-label="Page navigation example text-center">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link page-links" href="#">
                                                <i class="bx bx-chevrons-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item current">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <i class="bx bx-chevrons-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
