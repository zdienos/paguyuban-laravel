<script type="text/javascript">

    "use strict";
    const formAuthentication = document.querySelector("#formAuthentication");
    var fv;

    document.addEventListener("DOMContentLoaded", function(e) {
        (function() {
            // Form validation for Add new record
            if (formAuthentication) {
                fv = FormValidation.formValidation(formAuthentication, {
                    fields: {
                        "email-username": {
                            validators: {
                                notEmpty: {
                                    message: "Masukkan email / username Anda",
                                },
                                stringLength: {
                                    min: 6,
                                    message: "Minimal 6 karakter",
                                },
                            },
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: "Masukkan password Anda",
                                },
                                stringLength: {},
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: ".mb-3",
                        }),
                        submitButton: new FormValidation.plugins.SubmitButton(),

                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                    },
                    init: (instance) => {
                        instance.on("plugins.message.placed", function(e) {
                            if (
                                e.element.parentElement.classList.contains(
                                    "input-group"
                                )
                            ) {
                                e.element.parentElement.insertAdjacentElement(
                                    "afterend",
                                    e.messageElement
                                );
                            }
                        });
                    },
                });
            }

            //  Two Steps Verification
            const numeralMask = document.querySelectorAll(".numeral-mask");

            // Verification masking
            if (numeralMask.length) {
                numeralMask.forEach((e) => {
                    new Cleave(e, {
                        numeral: true,
                    });
                });
            }
        })();
    });


    $('.btn-login').on('click', function() {
        let $email = $('#email').val(),
            $password = $('#password').val();
        // console.log(fv);
        // fv.on('core.form.valid', function() {
        //     alert('valid');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: "JSON",
            data: {
                email: $email,
                password: $password,
            },
            url: "{{ route('auth.login') }}",
            beforeSend: function(arr, $form, options) {
                // bsOffcanvas.hide();
                // $.blockUI({
                //     message: '<div class="spinner-border text-white" role="status"></div>',
                //     css: {
                //     backgroundColor: 'transparent',
                //     border: '0'
                //     },
                //     overlayCSS: {
                //     opacity: 0.5
                //     }
                // });
            },
            success: function(data) {
                // $.unblockUI();
                // dtGuru.ajax.reload(null, false);
                // dtGuruTable.DataTable().ajax.reload(null, false);
                if (data.status) {
                    // toastr.success('', data.message, { timeOut: 1000 });
                    window.location.href = data.redirect;
                } else {
                    formLogin[0].reset();
                    toastr.error('', data.message, { timeOut: 1000 });
                }
            }
        });
        // });

    });
</script>
