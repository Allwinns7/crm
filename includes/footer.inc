<footer class="main-footer">
	<strong>Copyright &copy; <?php echo date('Y');?> <a href="#">Arima </a>.</strong> All rights reserved.
</footer>
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script>
	function messagesRead() {
		$.ajax({
          url: "./backend/messageupdate.php",
          success: function (data) {
            $('#msgcnt').html('');
          }
      });
	}
	function notificationRead() {
		$.ajax({
          url: "./backend/notificationupdate.php",
          success: function (data) {
            $('#ntfcnt').html('');
          }
      });
	}
</script>