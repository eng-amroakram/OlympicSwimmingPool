<div class="container-fluid">
    <div class="p-4 mb-4">


        <!-- Page Header-->
        <div class="row mb-4" wire:ignore>

            <!-- Page Title  -->
            <h2 style="font-weight: bold;">إدارة العملاء</h2>
            <!-- Page Title  -->

            <!-- Breadcrumb -->
            <nav data-mdb-navbar-init class="d-flex navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-weight: bold;">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
                            <li class="breadcrumb-item"><a href="#">إدارة العملاء</a></li>
                            <li class="breadcrumb-item active"><a href="#">العملاء</a>
                            </li>
                        </ol>
                    </nav>

                    <div class="d-flex align-items-center pe-3">

                        <div class="dropdown dropright">
                            <a class="link-secondary me-3 dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-gear"></i>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" data-mdb-toggle="modal"
                                        data-mdb-target="#create-new-user-modal" href="#create-new-user-modal">
                                        <i class="far fa-square-plus me-2"></i>
                                        <span>إضافة عميل</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#export-data" wire:click="exportUsers">
                                        <i class="fas fa-file-export me-2"></i>
                                        <span>تصدير البيانات</span>
                                    </a>
                                </li>
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
                    <div class="form-outline">
                        <i class="fab fa-searchengin trailing text-primary"></i>
                        <input type="search" id="search" wire:model.live="search"
                            class="form-control form-icon-trailing" aria-describedby="textExample1" />
                        <label class="form-label" for="search">البحث</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <select class="select" multiple wire:model.live="search_account_type">
                        <option value="employee">موظف</option>
                        <option value="company">شركة</option>
                        <option value="person">فرد</option>
                        <option value="admin">أدمن فرعي</option>
                        <option value="superadmin">أدمن رئيسي</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="select" multiple wire:model.live="search_account_status">
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                        {{-- <option value="blocked">محظور</option> --}}
                    </select>
                </div>
            </div>

        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="th-sm"><strong>ID</strong></th>
                        {{-- <th class="th-sm"><strong>الصورة</strong></th> --}}
                        <th data-mdb-sort="true" class="th-sm"><strong>الاسم</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الهاتف</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الايميل</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>نوع الحساب</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>الحالة</strong></th>
                        <th data-mdb-sort="false" class="th-sm"><strong>التحكم</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users_models as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            {{-- <td>
                                <div class="lightbox">
                                    <img src="{{ $user->photo }}" data-mdb-img="{{ $user->photo }}"
                                        alt="Lightbox image 1" style="width: 50px;">
                                </div>
                            </td> --}}
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->account_type == 'superadmin')
                                    <span style="font-size: 12px;" class="badge rounded-pill badge-danger">ادمن
                                        رئيسي</span>
                                @endif

                                @if ($user->account_type == 'admin')
                                    <span style="font-size: 12px;" class="badge rounded-pill badge-danger">ادمن</span>
                                @endif

                                @if ($user->account_type == 'person')
                                    <span style="font-size: 12px;" class="badge rounded-pill badge-warning">فرد</span>
                                @endif
                                @if ($user->account_type == 'company')
                                    <span style="font-size: 12px;" class="badge rounded-pill badge-info">شركة</span>
                                @endif
                                @if ($user->account_type == 'employee')
                                    <span style="font-size: 12px;" class="badge rounded-pill badge-success">موظف</span>
                                @endif
                            </td>
                            <td>
                                <div class="switch">
                                    <label>
                                        نشط
                                        <input wire:click="changeAccountStatus({{ $user->id }})" type="checkbox"
                                            {{ $user->account_status == 'active' ? 'checked' : '' }}>
                                        <span class="lever"></span>
                                        غير نشط
                                    </label>
                                </div>
                            </td>

                            <x-actions delete="delete_user" edit="edit_user" :show="false" :link="route('admin.users.edit', ['user' => $user->id])"
                                :id="$user->id"></x-actions>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <!-- Table Pagination -->
        <div class="d-flex justify-content-between">

            <nav aria-label="...">
                <ul class="pagination pagination-circle">
                    {{ $users_models->withQueryString()->onEachSide(0)->links() }}
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

    <div class="modal fade" id="create-new-user-modal" tabindex="-1" data-mdb-backdrop="static"
        data-mdb-keyboard="false" aria-labelledby="Creator" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg cascading-modal" style="margin-top: 4%">
            <div class="modal-content">
                <div class="modal-c-tabs">


                    <!-- Tabs navs -->
                    <ul class="nav md-tabs nav-tabs" id="create-new-user" role="tablist"
                        style="background-color: #303030;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="create-new-user-tab-1" href="#create-new-user-tabs-1"
                                role="tab" aria-controls="create-new-user-tabs-1" aria-selected="true"
                                data-mdb-toggle="pill">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    البيانات الأساسية للمستخدم
                                </strong>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="create-new-user-tab-2" href="#create-new-user-tabs-2"
                                role="tab" aria-controls="create-new-user-tabs-2" aria-selected="false"
                                data-mdb-toggle="pill">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    بيانات التواصل للمستخدم
                                </strong>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="create-new-user-tab-3" href="#create-new-user-tabs-3"
                                role="tab" aria-controls="create-new-user-tabs-3" aria-selected="false"
                                data-mdb-toggle="pill">
                                <i class="fas fa-circle-info me-1"></i>
                                <strong>
                                    صلاحيات المستخدم
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


                        <div class="tab-pane fade show active" id="create-new-user-tabs-1" role="tabpanel"
                            aria-labelledby="create-new-user-tab-1">

                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">

                                        <label class="form-label" for="forName"><strong>اسم
                                                المستخدم</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </span>

                                            <input type="name" wire:model.defer="name" maxlength="15"
                                                class="form-control" placeholder="ادخل اسم المستخدم" />

                                        </div>
                                        <div
                                            class="form-helper text-danger name-create-new-user-validation reset-validation">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="forAccountType"><strong>نوع
                                                الحساب</strong></label>
                                        <select class="select" id="add-user-account-type" wire:model="account_type">
                                            <option value="employee">موظف</option>
                                            <option value="company">شركة</option>
                                            <option value="person">فرد</option>
                                            <option value="admin">أدمن فرعي</option>
                                            <option value="superadmin">أدمن رئيسي</option>
                                        </select>
                                        <div
                                            class="form-helper text-danger account_type-create-new-user-validation reset-validation">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="forAccountType"><strong>حالة
                                                الحساب</strong></label>
                                        <select class="select" id="add-user-account-status"
                                            wire:model="account_status">
                                            <option value="active">نشط</option>
                                            <option value="inactive">غير نشط</option>
                                        </select>
                                        <div
                                            class="form-helper text-danger account_status-create-new-user-validation reset-validation">
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label" for="forPassword"><strong>كلمة
                                                المرور</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </span>

                                            <input type="password" wire:model.defer="password" maxlength="25"
                                                class="form-control" placeholder="ادخل كلمة المرور" />

                                        </div>
                                        <div
                                            class="form-helper text-danger password-create-new-user-validation reset-validation">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn bg-blue-color" data-mdb-dismiss="modal">
                                    إغلاق
                                </button>

                                {{-- <button type="button" class="btn bg-blue-color nextCreator">السابق</button> --}}
                                <button type="button" class="btn text-white blue-color"
                                    wire:click='addUser()'>حفظ</button>
                                {{-- <button type="button" class="btn bg-blue-color nextCreator">التالي</button> --}}

                            </div>
                        </div>

                        <div class="tab-pane fade" id="create-new-user-tabs-2" role="tabpanel"
                            aria-labelledby="create-new-user-tab-2">
                            <div class="modal-body">
                                <div class="row mb-3">

                                    <div class="col-md-6">
                                        <label class="form-label" for="forEmail"><strong>البريد
                                                الالكتروني</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </span>

                                            <input type="email" wire:model.defer="email" maxlength="60"
                                                class="form-control" placeholder="ادخل البريد الالكتروني" />

                                        </div>
                                        <div
                                            class="form-helper text-danger email-create-new-user-validation reset-validation">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label class="form-label" for="forPhone"><strong>رقم الهاتف</strong></label>
                                        <div class="input-group">

                                            <input type="phone" wire:model.defer="phone" maxlength="10"
                                                class="form-control" placeholder="ادخل رقم الهاتف" />
                                            <span class="input-group-text">966+</span>
                                        </div>
                                        <div
                                            class="form-helper text-danger phone-create-new-user-validation reset-validation">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <label class="form-label" for="forPhoto"><strong>صورة
                                                المستخدم</strong></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-image"></i>
                                            </span>

                                            <input type="file" wire:model.defer="photo" class="form-control"
                                                placeholder="ارفق صورة" />

                                        </div>
                                        <div class="form-helper text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn bg-blue-color" data-mdb-dismiss="modal">
                                    إغلاق
                                </button>

                                {{-- <button type="button" class="btn bg-blue-color nextCreator">السابق</button> --}}
                                <button type="button" class="btn text-white blue-color"
                                    wire:click='addUser()'>حفظ</button>
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


@push('create-new-user-script')
    <script>
        $(document).ready(function() {

            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
                $("#create-new-user-modal").modal('hide');
            });

            Livewire.on("create-new-user-errors", function(errors) {
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-user-validation").text(errors[0][key]);
                    }
                }
            });
        });
    </script>
@endpush
