<div style="width: 30rem;" wire:ignore>
    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form1Example13" class="form-control form-control-lg admin-email-login-input" />
        <label class="form-label" for="form1Example13">البريد الالكتروني</label>
        <div class="form-helper text-danger admin-email-login-validation"></div>
    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form1Example23" class="form-control form-control-lg admin-password-login-input" />
        <label class="form-label" for="form1Example23">كلمة المرور</label>
        <div class="form-helper text-danger admin-password-login-validation"></div>

    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Checkbox -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
            <label class="form-check-label" for="form1Example3"> تذكر بيانات الدخول </label>
        </div>
        <a href="#!">هل نسيت كلمة المرور؟</a>
    </div>

    <!-- Submit button -->
    <button type="submit" data-mdb-button-init data-mdb-ripple-init
        class="btn btn-primary btn-lg btn-block admin-submit-login-button">تسجيل
        الدخول</button>


</div>



@push('admin-login-script')
    <script>
        $(document).ready(function() {

            // Values
            var $admin_email_login_value = "";
            var $admin_password_login_value = "";

            // Inputs
            var $admin_email_login_validation = $(".admin-email-login-validation");
            var $admin_password_login_validation = $(".admin-password-login-validation");

            // Validations
            var $admin_email_login_input = $(".admin-email-login-input");
            var $admin_password_login_input = $(".admin-password-login-input");

            // Buttons
            var $admin_submit_login_button = $(".admin-submit-login-button");

            $admin_email_login_input.on('input', function() {
                $admin_email_login_validation.text("");
                $admin_email_login_value = $(this).val();
            });

            $admin_password_login_input.on('input', function() {
                $admin_password_login_validation.text("");
                $admin_password_login_value = $(this).val();
            });


            $admin_submit_login_button.on('click', function() {
                let $result = admin_login_validation();

                if ($result) {
                    @this.set('email', $admin_email_login_value);
                    @this.set('password', $admin_password_login_value);
                    Livewire.dispatch('submitting-admin-login-data');
                }

            });


            function admin_login_validation() {
                $admin_email_login_validation.text("");
                $admin_password_login_validation.text("");

                if (!$admin_email_login_value && $admin_password_login_value) {
                    $admin_email_login_validation.text("تأكد من الايميل !");
                    $admin_email_login_validation.text("تأكد من كلمة المرور!");
                    return false;
                }

                if (!$admin_email_login_value) {
                    $admin_email_login_validation.text("تأكد من الايميل !");
                    return false;
                }
                if (!$admin_password_login_value) {
                    $admin_password_login_validation.text("تأكد من كلمة المرور!");
                    return false;
                }

                return true;
            }


            //Validation From DB
            Livewire.on('admin-db-login-validation', function(value) {
                let message = value[0];

                if (message.password) {
                    $admin_password_login_validation.text(message.password);
                }

                if (message.email) {
                    $admin_email_login_validation.text(message.email);
                }
            });

        });
    </script>
@endpush
