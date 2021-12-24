<?php
require_once '../vendor/autoload.php';
use LaJoie\modules\Auth;

session_start();

Auth::logout();

header('Location: login.php');
