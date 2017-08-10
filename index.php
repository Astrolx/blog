<?php
session_start();
include 'boot/Psr4Autoload.php';
include 'boot/Start.php';
include 'boot/alias.php';
$config = include 'config/config.php';
Start::router();

























