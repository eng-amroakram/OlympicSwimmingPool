<header class="top-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="header-right">
                    <div class="header-right-card">
                        <ul>

                            <li>
                                <div class="head-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <a href="tel:+(704)279-1249">{{ $location?->phone }} (966)+</a>
                            </li>
                            <li>
                                <div class="head-icon">
                                    <i class="flaticon-email"></i>
                                </div>
                                <a href="../../cdn-cgi/l/email-protection.html#03396a6d656c43736a796a2d606c6e"><span
                                        class="__cf_email__"
                                        data-cfemail="c5acaba3aa85b5acbfaceba6aaa8">{{ $location?->email }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="top-social-link">
                    <ul>
                        @if ($location?->facebook)
                            <li>
                                <a class="color-blue" href="{{ $location?->facebook }}" target="_blank">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                            </li>
                        @endif

                        @if ($location?->twitter)
                            <li>
                                <a class="active" href="{{ $location?->twitter }}" target="_blank">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                            </li>
                        @endif

                        @if ($location?->instagram)
                            <li>
                                <a class="color-pink" href="{{ $location?->instagram }}" target="_blank">
                                    <i class="bx bxl-instagram"></i>
                                </a>
                            </li>
                        @endif

                        @if ($location?->tiktok)
                            <li>
                                <a class="active" href="{{ $location?->tiktok }}" target="_blank">
                                    <i class="bx bxl-tiktok"></i>
                                </a>
                            </li>
                        @endif

                        @if ($location?->snap_chat)
                            <li>
                                <a class="color-blue" href="{{ $location?->snap_chat }}" target="_blank">
                                    <i class="bx bxl-snapchat"></i>
                                </a>
                            </li>
                        @endif

                        {{-- @if ($location?->instagram)
                            <li>
                                <a class="color-red" href="{{ $location?->instagram }}" target="_blank">
                                    <i class="bx bxl-pinterest-alt"></i>
                                </a>
                            </li>
                        @endif


                        @if ($location?->youtube)
                            <li>
                                <a class="color-dark-red" href="{{ $location?->youtube }}" target="_blank">
                                    <i class="bx bxl-youtube"></i>
                                </a>
                            </li>
                        @endif --}}

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
