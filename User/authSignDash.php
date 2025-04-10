<?php
session_start();
unset($_SESSION['user_member_id']);
unset($_SESSION['member_user_id']);
unset($_SESSION['member_password']); ?>
<script>
	window.top.location.href="LoginAuth";
</script>