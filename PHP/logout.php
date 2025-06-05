<?php
session_start();
session_destroy();
header('Location: ' . BASE_URL . 'view/login.php');
exit;
