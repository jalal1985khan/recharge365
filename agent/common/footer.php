<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../styles/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../styles/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Sparkline -->
<script src="../styles/plugins/sparklines/sparkline.js"></script>


<!-- daterangepicker -->
<script src="../styles/plugins/moment/moment.min.js"></script>
<script src="../styles/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../styles/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../styles/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../styles/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../styles/dist/js/adminlte.js"></script>



<script src="../styles/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../styles/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="../styles/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../styles/plugins/toastr/toastr.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    <?php
   /**********************index.php**/
   if(isset($_SESSION['msg'])){
?>
    Toast.fire({
        icon: '<?php echo $_SESSION['type'];?>',
        title: '<?php echo $_SESSION['msg'];?>'
      }) 
<?php
 unset($_SESSION['msg']);
 unset($_SESSION['type']);//if user refresh index.php after 1st time it will not see the message
   }
?>
   
  });

 
</script>
</body>

</html>