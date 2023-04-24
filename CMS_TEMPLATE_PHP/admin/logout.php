<?php
require 'includes/header.php';

$session->logout();
redirect("login.php");