@section('js')
    <script type="text/javascript">
        'use strict';

        var fv, 
            myOffcanvas = document.getElementById("offcanvasAddUser"),
            bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {
                const formAddNewRecord = document.getElementById('form-add-new-record');
                fv = FormValidation.formValidation(addNewUserForm, {
                    fields: {
                        namaGuru: {
                            validators: {
                                notEmpty: {
                                    message: 'Masukkan nama guru '
                                }
                            }
                        },
                        // userEmail: {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Please enter your email'
                        //         },
                        //         emailAddress: {
                        //             message: 'The value is not a valid email address'
                        //         }
                        //     }
                        // }
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
                    }
                });
            })();
        });

        // Datatable (jquery)
        var dtGuruTable = $('.datatables-guru'),
            dtGuru;
        $(function() {

            if (dtGuruTable.length) {
                var dtGuru = dtGuruTable.DataTable({
                    processing: true, 
                    ajax: "{{ route('guru.get') }}", // JSON file to add data
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'nama_lengkap'
                        },
                        {
                            data: 'nik'
                        },
                        {
                            data: 'kelamin'
                        },
                        {
                            data: 'bidang_studi'
                        },
                        {
                            data: 'alamat'
                        },
                        {
                            data: 'handphone'
                        },
                        {
                            data: null,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return (
                                    `<div class="d-flex align-items-center">
                                <a href="javascript:;" class="text-body"><i class="ti ti-edit ti-sm me-2"></i></a>
                                <a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>
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
                    // Buttons with Dropdown
                    buttons: [{
                            extend: 'collection',
                            className: 'btn btn-label-primary dropdown-toggle me-2',
                            text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [{
                                    extend: 'print',
                                    text: '<i class="ti ti-printer me-1" ></i>Print',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined &&
                                                        item
                                                        .classList.contains('user-name')
                                                    ) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText ===
                                                        undefined) {
                                                        result = result + item
                                                            .textContent;
                                                    } else result = result + item
                                                        .innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    },
                                    customize: function(win) {
                                        //customize print view for dark
                                        $(win.document.body)
                                            .css('color', config.colors.headingColor)
                                            .css('border-color', config.colors.borderColor)
                                            .css('background-color', config.colors.bodyBg);
                                        $(win.document.body)
                                            .find('table')
                                            .addClass('compact')
                                            .css('color', 'inherit')
                                            .css('border-color', 'inherit')
                                            .css('background-color', 'inherit');
                                    }
                                },
                                {
                                    extend: 'csv',
                                    text: '<i class="ti ti-file-text me-1" ></i>Csv',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined &&
                                                        item
                                                        .classList.contains('user-name')
                                                    ) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText ===
                                                        undefined) {
                                                        result = result + item
                                                            .textContent;
                                                    } else result = result + item
                                                        .innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'excel',
                                    text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined &&
                                                        item
                                                        .classList.contains('user-name')
                                                    ) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText ===
                                                        undefined) {
                                                        result = result + item
                                                            .textContent;
                                                    } else result = result + item
                                                        .innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    text: '<i class="ti ti-file-description me-1"></i>Pdf',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined &&
                                                        item
                                                        .classList.contains('user-name')
                                                    ) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText ===
                                                        undefined) {
                                                        result = result + item
                                                            .textContent;
                                                    } else result = result + item
                                                        .innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                },
                                {
                                    extend: 'copy',
                                    text: '<i class="ti ti-copy me-1" ></i>Copy',
                                    className: 'dropdown-item',
                                    exportOptions: {
                                        columns: [3, 4, 5, 6, 7],
                                        // prevent avatar to be display
                                        format: {
                                            body: function(inner, coldex, rowdex) {
                                                if (inner.length <= 0) return inner;
                                                var el = $.parseHTML(inner);
                                                var result = '';
                                                $.each(el, function(index, item) {
                                                    if (item.classList !== undefined &&
                                                        item
                                                        .classList.contains('user-name')
                                                    ) {
                                                        result = result + item.lastChild
                                                            .firstChild
                                                            .textContent;
                                                    } else if (item.innerText ===
                                                        undefined) {
                                                        result = result + item
                                                            .textContent;
                                                    } else result = result + item
                                                        .innerText;
                                                });
                                                return result;
                                            }
                                        }
                                    }
                                }
                            ]
                        },
                        {
                            text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Data</span>',
                            className: 'tambah-data btn btn-primary',
                            attr: {
                                'data-bs-toggle': 'offcanvas',
                                'data-bs-target': '#offcanvasAddUser'
                            }
                        }
                    ],
                    // For responsive popup
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['full_name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.title !==
                                        '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    },
                    initComplete: function() {}
                });
            }
            $('div.head-label').html('<h5 class="card-title mb-0">Data Guru</h5>');

            // Delete Record
            $('.datatables-guru tbody').on('click', '.delete-record', function() {
                dt_user.row($(this).parents('tr')).remove().draw();
            });

        });


        // simpan data
        $('.data-submit').on('click', function() {
            var $nama_lengkap = $('.tambah-guru .dt-nama-lengkap').val(),
                $nik = $('.tambah-guru .dt-nik').val(),
                $kelamin = $('.tambah-guru .dt-kelamin').val(),
                $bidang_studi = $('.tambah-guru .dt-bidang-studi').val(),
                $alamat = $('.tambah-guru .dt-alamat').val(),
                $handphone = $('.tambah-guru .dt-handphone').val();

            fv.on('core.form.valid', function() {
                $.ajax({
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        nama_lengkap: $nama_lengkap,
                        nik: $nik,
                        kelamin: $kelamin,
                        bidang_studi: $bidang_studi,
                        alamat: $alamat,
                        handphone: $handphone,
                    },
                    url: "{{ route('guru.simpan') }}",
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
                        // dtGuru.ajax.reload(null, false);
                        dtGuruTable.DataTable().ajax.reload(null, false);
                        if (data.status) {
                            pesan('success', 'Sukses', data.pesan);
                        } else {
                            pesan('error', 'Error', data.pesan);
                        }
                    }
                });
            }); 
        });
    </script>
@endsection
