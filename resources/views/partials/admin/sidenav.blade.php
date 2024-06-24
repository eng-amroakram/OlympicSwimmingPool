<nav id="sidenav-1" class="sidenav ps ps--active-y" data-mdb-color="light" style="background-color: #2d2c2c"
    role="navigation" data-mdb-mode="side" data-mdb-right="false" data-mdb-hidden="false" data-mdb-accordion="true">

    <a class="ripple d-flex justify-content-center py-5" style="padding-top: 5rem !important;"
        href="{{ route('admin.index') }}" data-ripple-color="primary">

        <img id="MDB-logo" width="200" src="{{ asset('assets/admin/images/logo-white.png') }}" alt="MDB Logo"
            draggable="false" />
    </a>

    <ul class="sidenav-menu">

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.index') }}">
                <i class="fas fa-chart-area pr-4 me-2 "></i><span>الصفحة الرئيسية</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.sliders') }}">
                <i class="fas fa-sliders pr-3 me-2"></i>
                <span> السلايدر</span>
            </a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;">
                <i class="fas fa-circle-info pr-3 me-2 "></i><span> حولنا</span></a>
            <ul class="sidenav-collapse">
                <li class="sidenav-item ">
                    <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.about-us') }}">حولنا</a>
                </li>
                <li class="sidenav-item ">
                    <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.features') }}">المميزات</a>
                </li>
            </ul>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" href="{{ route('admin.our-services') }}" style="font-size: 16px;">
                <i class="fab fa-servicestack pr-3 me-2 "></i><span> خدماتنا</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.locations') }}">
                <i class="fas fa-earth-europe pr-3 me-2 "></i><span> اللوكيشن</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.gallery') }}">
                <i class="far fa-image pr-3 me-2 "></i><span> المرئيات</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.partners') }}">
                <i class="fas fa-handshake pr-3 me-2 "></i><span> الشركاء</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.contact-us') }}">
                <i class="fas fa-users pr-3 me-2 "></i><span>تواصل العملاء</span></a>
        </li>

        <li class="sidenav-item">
            <a class="sidenav-link" style="font-size: 16px;" href="{{ route('admin.settings') }}">
                <i class="fas fa-screwdriver-wrench pr-3 me-2 "></i><span> الاعدادات العامة</span></a>
        </li>

    </ul>

</nav>
