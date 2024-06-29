<div class="container-fluid">
    <div class="p-4 mb-4">


        <!-- Page Header-->
        <div class="row mb-4" wire:ignore>

            <!-- Page Title  -->
            <h2 style="font-weight: bold;">خدماتنا</h2>
            <!-- Page Title  -->

            <!-- Breadcrumb -->
            <nav data-mdb-navbar-init class="d-flex navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-weight: bold;">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
                            <li class="breadcrumb-item"><a href="#">قسم خدماتنا</a></li>
                            <li class="breadcrumb-item active"><a href="#">الخدمات</a>
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
                                        data-mdb-target="#create-new-our-services-modal"
                                        href="#create-new-our-services-modal">
                                        <i class="far fa-square-plus me-2"></i>
                                        <span>إضافة خدمة</span>
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
                        <th data-mdb-sort="true" class="th-sm"><strong>الصورة</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>العنوان</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الحالة</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>التحكم</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($our_services as $our_service)
                        <tr>
                            <td>{{ $our_service->id }}</td>
                            <td>
                                <div class="lightbox">
                                    <img src="{{ $our_service->photo_table }}"
                                        data-mdb-img="{{ $our_service->photo_table }}" width="30" height="30">
                                </div>
                            </td>
                            <td>{{ $our_service->title }}</td>

                            <td>
                                <div class="switch">
                                    <label>
                                        نشط
                                        <input wire:click="changeStatus({{ $our_service->id }})" type="checkbox"
                                            {{ $our_service->status == 'active' ? 'checked' : '' }}>
                                        <span class="lever"></span>
                                        غير نشط
                                    </label>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="text-danger fa-lg me-2 ms-2"
                                        wire:click='delete({{ $our_service->id }})' title="Delete">
                                        <i class="fas fa-trash-can"></i>
                                    </a>
                                    <a type="button" class="text-dark fa-lg me-2 ms-2 set-button-update"
                                        data-mdb-toggle="modal" data-mdb-target="#create-new-our-services-modal"
                                        href="#create-new-our-services-modal" title="EditOurService"
                                        wire:click="edit({{ $our_service->id }})">
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
                    {{ $our_services->withQueryString()->onEachSide(0)->links() }}
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

    <div class="modal top fade" id="create-new-our-services-modal" tabindex="-1" data-mdb-backdrop="static"
        aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg cascading-modal" style="margin-top: 5%">
            <div class="modal-content">
                <div class="modal-c-tabs">

                    <!-- Tabs navs -->
                    <ul class="nav md-tabs nav-tabs" id="create-new-our-services" role="tablist"
                        style="background-color: #303030;">
                        <li class="nav-item" role="presentation">
                            <a data-mdb-toggle="pill" class="nav-link active" id="create-new-our-services-tab-1"
                                href="#create-new-our-services-tabs-1" role="tab"
                                aria-controls="create-new-our-services-tabs-1" aria-selected="true">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    بيانات الخدمة
                                </strong>
                            </a>
                        </li>


                        <li class="nav-item" role="presentation">
                            <a data-mdb-toggle="pill" class="nav-link" id="create-new-our-services-tab-2"
                                href="#create-new-our-services-tabs-2" role="tab"
                                aria-controls="create-new-our-services-tabs-2" aria-selected="true">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    وصف الخدمة
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


                        <div class="tab-pane fade show active" id="create-new-our-services-tabs-1" role="tabpanel"
                            aria-labelledby="create-new-our-services-tab-1">

                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <x-text-input label="العنوان" name="title"
                                            model="our-services"></x-text-input>
                                    </div>

                                    <div class="col-md-6">
                                        <x-file-input label="صورة" name="photo"
                                            model="our-services"></x-file-input>
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
                                    wire:click='addOurServices()'>حفظ</button>

                                <button type="button" class="btn text-white blue-color update-button"
                                    wire:click='updateOurServices()'>تحديث</button>
                                {{-- <button type="button" class="btn bg-blue-color nextCreator">التالي</button> --}}

                            </div>
                        </div>

                        <div class="tab-pane fade" id="create-new-our-services-tabs-2" role="tabpanel"
                            aria-labelledby="create-new-our-services-tab-2">

                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <input id="description-input" type="hidden">
                                        <trix-editor id="description-input-editor" input="description-input"
                                            wire:model.defer="description"
                                            placeholder="ادخل هنا تفاصيل الخدمة"></trix-editor>

                                        <div
                                            class="form-helper text-danger description-our-services-validation reset-validation">
                                        </div>
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
                                    wire:click='addOurServices()'>حفظ</button>

                                <button type="button" class="btn text-white blue-color update-button"
                                    wire:click='updateOurServices()'>تحديث</button>
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


@push('create-new-our-services-script')
    <script>
        $(document).ready(function() {

            $(".update-button").hide();

            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
                $("#create-new-our-services-modal").modal('hide');
                $(".create-button").show();
                $(".update-button").hide();
            });

            Livewire.on("create-new-our-services-errors", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-our-services-validation").text(errors[0][key]);
                    }
                }
            });

            Livewire.on("set-our-services-features", function(data) {
                const singleSelect = document.querySelector("#our-services-features");
                const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                singleSelectInstance.setValue(data[0]['features']);
                $(".create-button").hide();
                $(".update-button").show();
            });

            $(".set-button-update").on('click', function() {
                $(".create-button").hide();
                $(".update-button").show();
            });

            $(".close-modal-button").on("click", function() {
                const singleSelect = document.querySelector("#our-services-features");
                const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                singleSelectInstance.setValue([]);
                $(".create-button").show();
                $(".update-button").hide();
            });

            $(".create-button").on('click', function() {
                const editorElement = $('#description-input-editor')[0];
                const editorHtml = editorElement.editor.element.innerHTML;
                @this.set('description', editorHtml);
            });

            $(".update-button").on('click', function() {
                const editorElement = $('#description-input-editor')[0];
                const editorHtml = editorElement.editor.element.innerHTML;
                @this.set('description', editorHtml);
            });

        });
    </script>
@endpush
