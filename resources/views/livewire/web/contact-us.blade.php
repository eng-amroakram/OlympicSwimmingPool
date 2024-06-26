<div class="sidebar-modal" wire:ignore>
    <div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-bs-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                        <span aria-hidden="true">
                            <i class="bx bx-x"></i>
                        </span>
                    </button>
                    <h2 class="modal-title" id="myModalLabel2">
                        <a href="index.html">
                            <img src="{{ asset('assets/web/img/logo.png') }} " alt="Logo">
                        </a>
                    </h2>
                </div>

                <div class="banner-from banner-rs-from">
                    <span>تواصل معنا</span>
                    <h3>يسعدنا تواصلك معنا</h3>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 form-condition">

                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <i class="bx bx-user"></i>
                                <input class="form-control" type="text" wire:model.defer="name" placeholder="الاسم">
                                <div class="form-helper text-danger name-contact-us-validation reset-validation">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <i class="bx bx-mail-send"></i>
                                <input class="form-control" type="text" wire:model.defer="email"
                                    placeholder="البريد الالكتروني">
                                <div class="form-helper text-danger email-contact-us-validation reset-validation">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <i class="bx bx-file"></i>
                                <select class="form-control" id="our_service_select_id"
                                    wire:model.live="our_service_id">
                                    @foreach (our_services(true) as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="form-helper text-danger our_service_id-contact-us-validation reset-validation">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <i class="bx bx-file"></i>

                                <input class="form-control" type="text" wire:model.defer="phone"
                                    placeholder="رقم الجوال">
                                <div class="form-helper text-danger phone-contact-us-validation reset-validation">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <i class="bx bx-mail-send"></i>
                                <textarea wire:model.defer="message" class="form-control" id="message" cols="30" rows="5" required=""
                                    data-error="اكتب رسالتك هنا" placeholder="اكتب رسالتك هنا"></textarea>
                                <div class="form-helper text-danger message-contact-us-validation reset-validation">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 text-center">
                            <button type="submit" wire:click="submit()" class="get-btn2 page-btn text-center">
                                ارسال
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@push('contact-us-script-js')
    <script>
        $(document).ready(function() {
            $our_service_select = $("#our_service_select_id");
            $our_service_select.on('change', function() {
                @this.set("our_service_id", $(this).val());
            });


            Livewire.on("process-has-been-done", function() {
                $(".reset-validation").text("");
            });

            Livewire.on("create-contact-us-errors", function(errors) {
                console.log(errors);
                $(".reset-validation").text("");
                for (let key in errors[0]) {
                    if (errors[0].hasOwnProperty(key)) {
                        $("." + key + "-contact-us-validation").text(errors[0][key]);
                    }
                }
            });



        });
    </script>
@endpush
