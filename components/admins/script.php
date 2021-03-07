
<?php
    $level_footer = '';
?>
<!-- jQuery -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'jquery/jquery.min.js'?>></script>
<!-- jQuery UI 1.11.4 -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'jquery-ui/jquery-ui.min.js'?>></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'bootstrap/js/bootstrap.bundle.min.js'?>></script>
<!-- ChartJS -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'chart.js/Chart.min.js'?>></script>
<!-- Sparkline -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'sparklines/sparkline.js'?>></script>
<!-- JQVMap -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'jqvmap/jquery.vmap.min.js'?>></script>
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'jqvmap/maps/jquery.vmap.usa.js'?>></script>
<!-- jQuery Knob Chart -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'jquery-knob/jquery.knob.min.js'?>></script>
<!-- daterangepicker -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'moment/moment.min.js'?>></script>
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'daterangepicker/daterangepicker.js'?>></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'?>></script>
<!-- Summernote -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'summernote/summernote-bs4.min.js'?>></script>
<!-- overlayScrollbars -->
<script src=<?php echo $level_footer._DIR_['PLUGINS']['ADMINS'].'overlayScrollbars/js/jquery.overlayScrollbars.min.js'?>></script>
<!-- AdminLTE App -->
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'adminlte.js'?>></script>
<!-- AdminLTE for demo purposes -->
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'demo.js'?>></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'pages/dashboard.js'?>></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote();
    height: 120,
    
    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'loai_san_pham.js'?>></script>
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'san_pham.js'?>></script>
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'custom_image.js'?>></script>
<script src=<?php echo $level_footer._DIR_['JS']['ADMINS'].'admin.js'?>></script>

</body>
</html>