<script type="text/javascript">
    'use strict';

    var myOffcanvas = document.getElementById("offcanvasAddUser"),
        bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

    var dtUserTable = $('.datatables-user'),
        dtUser;

    $(function() {

        if (dtUserTable.length) {
            var dtUser = dtUserTable.DataTable({
                processing: true,
                ajax: "{{ route('user.get') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (
                                `<div class="d-flex align-items-center">
                            <a href="#" class="text-body btn-edit" data-id="${full.id}"><i class="ti ti-edit ti-sm me-2"></i></a>
                            <a href="#" class="text-body btn-hapus" data-id="${full.id}"><i class="ti ti-trash ti-sm mx-2"></i></a>
                            </div>`
                            );
                        }
                    }
                ],
                order: [
                    [1, 'desc']
                ],
                dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    search: '',
                    searchPlaceholder: 'Search..'
                },
                buttons: [
                    {
                        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Data</span>',
                        className: 'tambah-data btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'offcanvas',
                            'data-bs-target': '#offcanvasAddUser'
                        }
                    }
                ],
                initComplete: function() {}
            });
        }
        $('div.head-label').html('<h5 class="card-title mb-0">Data User</h5>');

        // Delete Record
        $('.datatables-user tbody').on('click', '.btn-hapus', function(e) {
            let $id = $(this).data('id');

            Swal.fire({
                title: 'Peringatan',
                text: "Anda yakin ingin menghapus data?",
                icon: 'warning',
                //showCancelButton: false,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: $id,
                        },
                        url: "{{ route('user.hapus') }}",
                        success: function(response) {
                            if (response.status) {
                                pesan('success', 'Sukses', response.message);
                            } else {
                                pesan('error', 'Error', response.message);
                            }
                            $('#modalAdd').modal('hide');
                            dtUserTable.DataTable().ajax.reload(null, false);
                            // dtUser.row($(this).parents('tr')).remove().draw();
                            // dtUser.ajax.reload(null, false);
                        }
                    });
                }
            });
            e.preventDefault();

        });

        // edit data
        $('.datatables-user tbody').on('click', '.btn-edit', function() {
            let myRow = dtUserTable.DataTable().row($(this).parents('tr')).data();
            $('.dt-username').val(myRow.username);
            $('.dt-fullname').val(myRow.full_name);
            $('.dt-email').val(myRow.email);
            $('.dt-role').val(myRow.role);
            $('.btn-simpan').data('id', myRow.id);
            bsOffcanvas.show();
        });

        $('#addNewUserForm').formValidation({
            // Options
            fields: {
                namaUser: {
                    validators: {
                        notEmpty: {
                            message: 'Masukkan nama user '
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    eleValidClass: '',
                    rowSelector: function(field, ele) {
                        // field is the field name & ele is the field element
                        return '.mb-3';
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // Submit the form when all fields are valid
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
        });

        $('.btn-simpan').on('click',  function(e) {
            let $username = $('.dt-username').val(),
                $fullname = $('.dt-fullname').val(),
                $email = $('.dt-email').val(),
                $role = $('.dt-role').val();
            let $id = $(this).data('id');
            let fv = $('#addNewUserForm').data('formValidation');

            fv.validate().then(function(status) {
                if(status=='Valid'){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: $id,
                            username: $username,
                            fullname: $fullname,
                            email: $email,
                            role: $role,
                        },
                        url: "{{ route('user.simpan') }}",
                        cache: false,
                        global: false,
                        beforeSend: function(arr, $form, options) {
                            bsOffcanvas.hide();
                            $.blockUI({
                                message: '<div class="spinner-border text-white" role="status"></div>',
                                css: {
                                    backgroundColor: 'transparent',
                                    border: '0'
                                },
                                overlayCSS: {
                                    opacity: 0.5
                                }
                            });
                        },
                        success: function(data) {
                            $.unblockUI();
                            // dtUser.ajax.reload(null, false);
                            dtUserTable.DataTable().ajax.reload(null, false);
                            if (data.status) {
                                pesan('success', 'Sukses', data.message);
                            } else {
                                pesan('error', 'Error', data.message);
                            }
                        }
                    });
                }
            });
            // $('#addNewUserForm').data('formValidation').on('core.form.valid', function(e) {
                // Prevent form submission
                // e.preventDefault();



            // });
        });





    }); //ready

    $("#offcanvasAddUser").on('hidden.bs.offcanvas', function() {
        $("#addNewUserForm").trigger('reset');
    });
</script>
