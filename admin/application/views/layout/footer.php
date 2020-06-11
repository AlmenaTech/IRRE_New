<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/common/js/jquery/jquery-3.5.1.js"></script>
 
<!-- Bootstrap 4 -->
 
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/common/js/bootstrap/propper.min.js"></script>
<script src="assets/common/js/bootstrap/bootstrap.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->

<?php foreach($this->js_foot as $js){ ?> 
    <script src="<?php echo $js; ?>"></script>
  <?php } ?>
</body>
</html>