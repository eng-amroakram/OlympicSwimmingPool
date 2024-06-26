<div class="container-fluid">
    <div class="p-4 mb-4">


        <!-- Page Header-->
        <div class="row mb-4" wire:ignore>

            <!-- Page Title  -->
            <h2 style="font-weight: bold;">رسائل العملاء</h2>
            <!-- Page Title  -->

            <!-- Breadcrumb -->
            <nav data-mdb-navbar-init class="d-flex navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-weight: bold;">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
                            <li class="breadcrumb-item"><a href="#">التواصل مع العملاء</a></li>
                            </li>
                        </ol>
                    </nav>

                    <div class="d-flex align-items-center pe-3">
                        <!-- Notifications -->
                        {{-- <div class="dropdown">
                            <a data-mdb-toggle="dropdown" class="link-secondary me-3 dropdown-toggle" href="#"
                                id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                                <i class="fas fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" data-mdb-toggle="modal"
                                        data-mdb-target="#create-new-about-us-modal" href="#create-new-about-us-modal">
                                        <i class="far fa-square-plus me-2"></i>
                                        <span>إضافة بيانات حولنا</span>
                                    </a>
                                </li>

                            </ul>
                        </div> --}}

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

                {{-- <div class="col-md-3">
                    <select class="select" multiple wire:model.live="search_status">
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                    </select>
                </div> --}}

            </div>
        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="th-sm"><strong>ID</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الاسم</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الايميل</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>رقم الهاتف</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الخدمة</strong></th>
                        <th data-mdb-sort="true" class="th-sm"><strong>الرسالة</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>التحكم</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contact_us as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->service?->title }}</td>
                            <td>
                                <a tabindex="0" class="text-primary fa-lg me-2 ms-2" role="button"
                                    data-mdb-ripple-init data-mdb-popover-init data-mdb-trigger="focus"
                                    title="رسالة {{ $client->name }}" data-mdb-placement="top"
                                    data-mdb-content="{{ $client->message }}" data-mdb-toggle="popover">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="text-danger fa-lg me-2 ms-2"
                                        wire:click='delete({{ $client->id }})' title="Delete">
                                        <i class="fas fa-trash-can"></i>
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
                    {{ $contact_us->withQueryString()->onEachSide(0)->links() }}
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

</div>


@push('create-new-contact-us-script')
    <script>
        $(document).ready(function() {

            $(".update-button").hide();

            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
                $("#create-new-about-us-modal").modal('hide');
                $(".create-button").show();
                $(".update-button").hide();
            });

            Livewire.on("create-new-feature-errors", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-about-us-validation").text(errors[0][key]);
                    }
                }
            });

            Livewire.on("set-about-us-features", function(data) {
                const singleSelect = document.querySelector("#about-us-features");
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
                const singleSelect = document.querySelector("#about-us-features");
                const singleSelectInstance = mdb.Select.getInstance(singleSelect);
                singleSelectInstance.setValue([]);
                $(".create-button").show();
                $(".update-button").hide();
            });

        });
    </script>
@endpush
