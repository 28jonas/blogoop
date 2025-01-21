<?php
require_once('includes/header.php');

if(!$session -> is_signed_in()){
    header('Location: login.php');
}

require_once('includes/sidebar.php');
require_once('includes/content-top.php');
require_once('includes/content.php');
require_once('includes/widget.php');
require_once('includes/footer.php');
?>
