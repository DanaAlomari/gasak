<script src="{{ asset('dashboard_files/assets/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('dashboard_files/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('dashboard_files/assets/plugins/jekyll-search.min.js') }}"></script>



<script src="{{ asset('dashboard_files/assets/plugins/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('dashboard_files/assets/plugins/charts/Chart.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>




{{-- <script src="{{ asset('resources/dashboard_files/assets/plugins/toastr/toastr.min.js') }}"></script> --}}

{{-- Extra JS : --}}
@yield('admin_javascript')
<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('dashboard_files/assets/js/sleek.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $('select').selectpicker();

    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
</body>

</html>
