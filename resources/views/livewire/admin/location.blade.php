<div class="container-fluid">
    <div class="p-4 mb-4">


        <!-- Page Header-->
        <div class="row mb-4" wire:ignore>

            <!-- Page Title  -->
            <h2 style="font-weight: bold;">الموقع</h2>
            <!-- Page Title  -->

            <!-- Breadcrumb -->
            <nav data-mdb-navbar-init class="d-flex navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-weight: bold;">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
                            <li class="breadcrumb-item"><a href="#">قسم الموقع</a></li>
                            <li class="breadcrumb-item active"><a href="#">بيانات الموقع وروابط السوشيال ميديا</a>
                            </li>
                        </ol>
                    </nav>

                    <div class="d-flex align-items-center pe-3">
                        <!-- Notifications -->
                        <div class="dropdown">
                            <a data-mdb-toggle="dropdown" class="link-secondary me-3 dropdown-toggle" href="#"
                                id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                                <i class="fas fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" data-mdb-toggle="modal"
                                        data-mdb-target="#create-new-location-modal" href="#create-new-location-modal">
                                        <i class="far fa-square-plus me-2"></i>
                                        <span>إضافة بيانات الموقع</span>
                                    </a>
                                </li>
                                {{-- <li>
                                        <a class="dropdown-item" href="#export-data" wire:click="exportUsers">
                                            <i class="fas fa-file-export me-2"></i>
                                            <span>تصدير البيانات</span>
                                        </a>
                                    </li> --}}

                            </ul>
                        </div>

                    </div>
                </div>
            </nav>
            <!-- Breadcrumb -->
        </div>
        <!-- Page Header-->

        <!-- Data Tables -->
        <div class="row" wire:ignore>
            <div class="row p-2 mb-3">

                <div class="col-md-3">
                    <div class="form-outline" data-mdb-input-init>
                        <i class="fab fa-searchengin trailing text-primary"></i>
                        <input type="search" id="search" wire:model.live="search"
                            class="form-control form-icon-trailing" aria-describedby="textExample1" />
                        <label class="form-label" for="search">البحث</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <select class="select" multiple wire:model.live="search_status">
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="th-sm"><strong>ID</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>عنوان القسم</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>اللوكيشن</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>رقم الهاتف</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الايميل</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الفيسبوك</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>انستا</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>تويتر</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>سناب</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>تيك توك</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الحالة</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>التحكم</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->id }}</td>
                            <td>{{ $location->title }}</td>
                            <td>{{ $location->address }}</td>
                            <td>{{ $location->phone }}</td>
                            <td>{{ $location->email }}</td>

                            <td><a target="_blank"
                                    href="{{ $location->facebook }}"><strong>{{ $location->facebook ? 'facebook' : 'Not Found' }}</strong></a>
                            </td>
                            <td><a target="_blank"
                                    href="{{ $location->instagram }}"><strong>{{ $location->instagram ? 'instagram' : 'Not Found' }}</strong></a>
                            </td>
                            <td><a target="_blank"
                                    href="{{ $location->twitter }}"><strong>{{ $location->twitter ? 'twitter' : 'Not Found' }}</strong></a>
                            </td>
                            <td><a target="_blank"
                                    href="{{ $location->snap_chat }}"><strong>{{ $location->snap_chat ? 'snap_chat' : 'Not Found' }}</strong></a>
                            </td>
                            <td><a target="_blank"
                                    href="{{ $location->tiktok }}"><strong>{{ $location->tiktok ? 'tiktok' : 'Not Found' }}</strong></a>
                            </td>

                            <td>
                                <div class="switch">
                                    <label>
                                        نشط
                                        <input wire:click="changeStatus({{ $location->id }})" type="checkbox"
                                            {{ $location->status == 'active' ? 'checked' : '' }}>
                                        <span class="lever"></span>
                                        غير نشط
                                    </label>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="text-danger fa-lg me-2 ms-2"
                                        wire:click='delete({{ $location->id }})' title="Delete">
                                        <i class="fas fa-trash-can"></i>
                                    </a>
                                    <a type="button" class="text-dark fa-lg me-2 ms-2 set-button-update"
                                        data-mdb-toggle="modal" data-mdb-target="#create-new-location-modal"
                                        href="#create-new-location-modal" title="Editlocation"
                                        wire:click="edit({{ $location->id }})">
                                        <i class="far fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Table Pagination -->
        <div class="d-flex justify-content-between">

            <nav aria-label="...">
                <ul class="pagination pagination-circle">
                    {{ $locations->withQueryString()->onEachSide(0)->links() }}
                </ul>
            </nav>

            <div class="col-md-1" wire:ignore>
                <select class="select" wire:model.live="pagination">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

        </div>
        <!-- Table Pagination -->

    </div>

    <div class="modal top fade" id="create-new-location-modal" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg cascading-modal" style="margin-top: 4%">
            <div class="modal-content">
                <div class="modal-c-tabs">

                    <!-- Tabs navs -->
                    <ul class="nav md-tabs nav-tabs" id="create-new-location" role="tablist"
                        style="background-color: #303030;">
                        <li class="nav-item" role="presentation">
                            <a data-mdb-toggle="pill" class="nav-link active" id="create-new-location-tab-1"
                                href="#create-new-location-tabs-1" role="tab"
                                aria-controls="create-new-location-tabs-1" aria-selected="true">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    بيانات الموقع
                                </strong>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a data-mdb-toggle="pill" class="nav-link" id="create-new-location-tab-2"
                                href="#create-new-location-tabs-2" role="tab"
                                aria-controls="create-new-location-tabs-2" aria-selected="true">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    روابط السوشيال ميديا
                                </strong>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="ex1-content">

                        <div class="mask mask-color" wire:loading
                            style="z-index: 1; background-color: #303030; opacity: 50%;">
                            <div
                                class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only text-primary">Loading...</span>
                                </div>
                                <h4 class="text-white">جاري التحميل يرجى الانتظار ...</h4>
                            </div>
                        </div>


                        <div class="tab-pane fade show active" id="create-new-location-tabs-1" role="tabpanel"
                            aria-labelledby="create-new-location-tab-1">

                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-text-input label="عنوان القسم" name="title"
                                            model="location"></x-text-input>
                                    </div>

                                    <div class="col-md-6">
                                        <x-text-input label="اللوكيشن" name="address"
                                            model="location"></x-text-input>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-text-input label="رقم الهاتف" name="phone"
                                            model="location"></x-text-input>
                                    </div>

                                    <div class="col-md-6">
                                        <x-text-input label="البريد الالكتروني" name="email"
                                            model="location"></x-text-input>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn bg-blue-color close-modal-button"
                                    data-mdb-dismiss="modal" x-on:click="$wire.resetting()">
                                    إغلاق
                                </button>

                                {{-- <button type="button" class="btn bg-blue-color nextCreator">السابق</button> --}}
                                <button type="button" class="btn text-white blue-color create-button"
                                    wire:click='addLocation()'>حفظ</button>

                                <button type="button" class="btn text-white blue-color update-button"
                                    wire:click='updateLocation()'>تحديث</button>
                                {{-- <button type="button" class="btn bg-blue-color nextCreator">التالي</button> --}}

                            </div>
                        </div>

                        <div class="tab-pane fade" id="create-new-location-tabs-2" role="tabpanel"
                            aria-labelledby="create-new-location-tab-2">

                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-link-input label="الفيسبوك" name="facebook"
                                            model="location"></x-link-input>
                                    </div>

                                    <div class="col-md-6">
                                        <x-link-input label="انستا قرام" name="instagram"
                                            model="location"></x-link-input>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-link-input label="تويتر" name="twitter" model="location"></x-link-input>
                                    </div>

                                    <div class="col-md-6">
                                        <x-link-input label="سناب شات" name="snap_chat"
                                            model="location"></x-link-input>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <x-link-input label="تيك توك" name="tiktok" model="location"></x-link-input>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn bg-blue-color close-modal-button"
                                    data-mdb-dismiss="modal" x-on:click="$wire.resetting()">
                                    إغلاق
                                </button>

                                {{-- <button type="button" class="btn bg-blue-color nextCreator">السابق</button> --}}
                                <button type="button" class="btn text-white blue-color create-button"
                                    wire:click='addLocation()'>حفظ</button>

                                <button type="button" class="btn text-white blue-color update-button"
                                    wire:click='updateLocation()'>تحديث</button>
                                {{-- <button type="button" class="btn bg-blue-color nextCreator">التالي</button> --}}

                            </div>
                        </div>

                    </div>
                    <!-- Tabs content -->
                </div>
            </div>
        </div>
    </div>

</div>


@push('create-new-location-script')
    <script>
        $(document).ready(function() {

            $(".update-button").hide();

            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
                $("#create-new-location-modal").modal('hide');
                $(".create-button").show();
                $(".update-button").hide();
            });

            Livewire.on("create-new-location-errors", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-location-validation").text(errors[0][key]);
                    }
                }
            });

            Livewire.on("set-location-status", function(data) {
                // const singleSelect = document.querySelector("#add-location-status");
                // const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                // singleSelectInstance.setValue(data[0]['status']);
                $(".create-button").hide();
                $(".update-button").show();
            });

            $(".set-button-update").on('click', function() {
                $(".create-button").hide();
                $(".update-button").show();
            });

            $(".close-modal-button").on("click", function() {
                $(".create-button").show();
                $(".update-button").hide();
            });

        });
    </script>
@endpush
