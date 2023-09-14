<!-- build:js assets/vendor/js/core.js -->
<script src="./assets/vendor/libs/jquery/jquery.js"></script>
<script src="./assets/vendor/libs/popper/popper.js"></script>
<script src="./assets/vendor/js/bootstrap.js"></script>
<script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="./assets/vendor/libs/node-waves/node-waves.js"></script>

<script src="./assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="./assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="./assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

<script src="./assets/vendor/libs/hammer/hammer.js"></script>
<script src="./assets/vendor/libs/i18n/i18n.js"></script>
<script src="./assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="./assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="./assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<script src="./assets/vendor/libs/block-ui/block-ui.js"></script>
{{-- <script src="./assets/js/extended-ui-blockui.js"></script> --}}
<script src="./assets/vendor/libs/toastr/toastr.js"></script>
<script src="./assets/vendor/libs/sweetalert2/sweetalert2.js"></script>


<!-- Main JS -->
<script src="./assets/js/main.js"></script>


<script>
    pesan = (tipe, title, teks) => {
        // toastr[tipe](teks,title);
        switch (tipe) {
            case 'success':
                toastr.success(teks, title, { timeOut: 1000 });
                break;
            case 'info':
                toastr.info(teks, title, { timeOut: 1000 });
                break;
            case 'warning':
                toastr.warning(teks, title, { timeOut: 1000 });
                break;
            case 'error':
                toastr.error(teks, title, { timeOut: 1000 });
                break;
        }
    }
    
</script>