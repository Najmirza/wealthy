<?php
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['admin_user_id']);
unset($_SESSION['admin_password']);
?>
<script>
	window.top.location.href="index";
</script>