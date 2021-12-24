<?php

require_once '../vendor/autoload.php';

use LaJoie\modules\Auth;

session_start();

Auth::guard();

if ($_SESSION['adminId']) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
