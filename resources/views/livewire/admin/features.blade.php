<div class="container-fluid">
    <div class="p-4 mb-4">


        <!-- Page Header-->
        <div class="row mb-4" wire:ignore>

            <!-- Page Title  -->
            <h2 style="font-weight: bold;">المميزات</h2>
            <!-- Page Title  -->

            <!-- Breadcrumb -->
            <nav data-mdb-navbar-init class="d-flex navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-weight: bold;">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
                            <li class="breadcrumb-item"><a href="#">قسم حولنا</a></li>
                            <li class="breadcrumb-item active"><a href="#">المميزات</a>
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
                                        data-mdb-target="#create-new-feature-modal" href="#create-new-feature-modal">
                                        <i class="far fa-square-plus me-2"></i>
                                        <span>إضافة ميزة</span>
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
                        <th data-mdb-sort="true" class="th-sm"><strong>الاسم</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الحالة</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>التحكم</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($features as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->name }}</td>
                            <td>
                                <div class="switch">
                                    <label>
                                        نشط
                                        <input wire:click="changeStatus({{ $feature->id }})" type="checkbox"
                                            {{ $feature->status == 'active' ? 'checked' : '' }}>
                                        <span class="lever"></span>
                                        غير نشط
                                    </label>
                                </div>

                            </td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="text-danger fa-lg me-2 ms-2"
                                        wire:click='delete({{ $feature->id }})' title="Delete">
                                        <i class="fas fa-trash-can"></i>
                                    </a>
                                    <a type="button" class="text-dark fa-lg me-2 ms-2 set-button-update"
                                        data-mdb-toggle="modal" data-mdb-target="#create-new-feature-modal"
                                        href="#create-new-feature-modal" title="EditFeature"
                                        wire:click="edit({{ $feature->id }})">
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
                    {{ $features->withQueryString()->onEachSide(0)->links() }}
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

    <div class="modal top fade" id="create-new-feature-modal" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog cascading-modal" style="margin-top: 4%">
            <div class="modal-content">
                <div class="modal-c-tabs">

                    <!-- Tabs navs -->
                    <ul class="nav md-tabs nav-tabs" id="create-new-feature" role="tablist"
                        style="background-color: #303030;">
                        <li class="nav-item" role="presentation">
                            <a data-mdb-tab-init class="nav-link active" id="create-new-feature-tab-1"
                                href="#create-new-feature-tabs-1" role="tab"
                                aria-controls="create-new-feature-tabs-1" aria-selected="true">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    بيانات الميزة
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


                        <div class="tab-pane fade show active" id="create-new-feature-tabs-1" role="tabpanel"
                            aria-labelledby="create-new-feature-tab-1">

                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <x-text-input label="اسم الميزة" name="name"
                                            model="feature"></x-text-input>
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
                                    wire:click='addFeature()'>حفظ</button>

                                <button type="button" class="btn text-white blue-color update-button"
                                    wire:click='updateFeature()'>تحديث</button>
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


@push('create-new-feature-script')
    <script>
        $(document).ready(function() {

            $(".update-button").hide();

            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
                $("#create-new-feature-modal").modal('hide');
                $(".create-button").show();
                $(".update-button").hide();
            });

            Livewire.on("create-new-feature-errors", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-feature-validation").text(errors[0][key]);
                    }
                }
            });

            Livewire.on("set-feature-status", function(data) {
                const singleSelect = document.querySelector("#add-feature-status");
                const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                singleSelectInstance.setValue(data[0]['status']);
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
