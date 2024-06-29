<div class="navbar-area">

    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="assets/img/footer-logo.png" alt="Logo">
        </a>
    </div>

    <div class="main-nav">
        <div class="container-fluid m-0">
            <nav class="container-max navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="{{ route('web.landing-page') }}">
                    <img src="{{ $settings?->photo_table }}" alt="Logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link active">
                                الرئيسية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                عن المسبح
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                خدماتنا
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                اللوكيشن
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link">
                                الاخبار
                            </a>
                        </li>
                    </ul>


                    <div class="modal-menu">
                        <a href="#" class="modal-icon-btn contactus" data-bs-toggle="modal"
                            data-bs-target="#myModal2">
                            تواصل معنا
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
