 <!-- js for datatables only -->
 <script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
 <script src="{{ url('/template') }}/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="{{ url('/template') }}/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="{{ url('/template') }}/assets/js/page/datatables.js"></script>
     <!-- ======= -->
    <!-- ======= -->
{{-- <script src="{{ url('/template') }}/assets/js/main.js"></script>
<script>
    Main.init()
</script> --}}
<script>
    DataTable.init()
</script>
<script src="{{ url('/template') }}/plugins/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="{{ url('/template') }}/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>

    <!-- js for this page only -->
<script src="{{ url('/template') }}/plugins/chart.js/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ url('/template') }}/assets/js/page/index.js"></script>



<!-- js for select only -->
<script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/template') }}/plugins/select2/dist/js/select2.min.js"></script>
    <!-- ======= -->

      <!-- js for datapicker only -->
<script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/template') }}/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
    }).on('changeDate', function (e) {
        console.log(e.target.value);
    });

</script>
    <!-- ======= -->


    <!-- js for element only -->
<script src="{{ url('/template') }}/assets/js/page/element-ui.js"></script>
<!-- ======= -->
<script src="{{ url('/template') }}/assets/js/main.js"></script>
<script>
    Main.init()
</script>
 <!-- js for alert only -->
 <script src="{{ url('/template') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
 <script src="{{ url('/template') }}/plugins/izitoast/dist/js/iziToast.min.js"></script>
 <script src="{{ url('/template') }}/assets/js/page/alert.js"></script>
     <!-- ======= -->

     {{-- <script src="{{ url('/template') }}/plugins/jquery/dist/jquery.min.js"></script>
     <script src="{{ url('/template') }}/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
     <script src="{{ url('/template') }}/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
     <script src="{{ url('/template') }}/assets/js/page/datatables.js"></script> --}}
         <!-- ======= -->


