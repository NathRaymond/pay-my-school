<script src="{{ asset('assets/plugins/jQuery/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('assets/dist/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/plugins/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="{{ asset('assets/plugins/chartJs/Chart.min.js')}}"></script>
<script src="{{ asset('assets/plugins/sparkline/sparkline.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.min.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!--Page Active Scripts(used by this page)-->
<script src="{{ asset('assets/dist/js/pages/dashboard.js')}}"></script>
<!--Page Scripts(used by all page)-->
<script src="{{ asset('assets/dist/js/sidebar.js')}}"></script>
<script src="{{ asset('js/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
    @if ($errors->any())
        swal('Oops...', "{!! implode('', $errors->all(':message')) !!}", 'error')
    @endif

    @if (session()->has('success'))
        swal(
        'Success!',
        "{{ session()->get('message') }}",
        'success'
        )
    @endif
    @if (session()->has('message'))
        swal(
        'Success!',
        "{{ session()->get('message') }}",
        'success'
        )
    @endif
</script>
