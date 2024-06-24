<footer class="footer-area">
    <div class="footer-top">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="footer-logo">
                        <a href="{{ route('web.landing-page') }}">
                            <img src="{{ $settings?->photo_table }}" alt="Images">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="footer-top-card">
                        <i class="flaticon-calendar"></i>
                        <span>أيام العمل:</span>
                        <h3>من {{ __($settings?->day_from) }} الي {{ __($settings?->day_to) }}</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">

                    <div class="footer-top-card">
                        <i class="flaticon-alarm-clock"></i>
                        <span>أوقات العمل:</span>
                        <h3>
                            {{ $settings?->time_to }}
                            -
                            {{ $settings?->time_from }}
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">

                    <div class="bottom-text right">
                        <p>
                            جميع الحقوق محفوظة للجامعة الاسلامية بالمدينة المنورة
                        </p>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6">

                    <div class="bottom-text">
                        <p>
                            تطوير شركة
                            <a href="#">حلول التقنية</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
