<footer class="sticky-footer text-<?php echo $font; ?> bg-<?php echo $barcolor; ?>">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © <?php echo $empresa." ".date('Y'); ?> </span>
          </div>
        </div>
</footer>
<?php  include "modal/modal_calculadora.php"; ?>
<?php  include "modal/modal_seguridad.php"; ?>
</div>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap-notify.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<script src="js/js_calculador.js"></script>
<script src="js/js_segurity.js"></script>
<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js">  </script>

<script> $(document).ready(function () {

$('#wrapper').on('click', function () {
    $("body").removeClass( "sidebar-toggled" );
    $(".sidebar").addClass( "toggled" );
});

}); </script>

</body>


</html>
