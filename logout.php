<?php
session_start();

// $_SESSION['id'] = '';
// $_SESSION['username'] = '';
// $_SESSION['role'] = '';

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['role']);

session_unset();
session_destroy();
header('Location:index.php');
