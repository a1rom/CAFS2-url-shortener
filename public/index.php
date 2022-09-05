<?php
session_start();
ob_start();
require_once '../config/config.php';
try {
    require_once ConfigRoutes::APP . 'helpers.php';
    require_once ConfigRoutes::CLASSES . 'UserSubmitCache.php';
    $submitCache = new UserSubmitCache();
    require ConfigRoutes::ROUTES . 'router.php';
    ob_end_flush();
} catch (Exception $e) {
    ob_end_clean();
    echo 'Caught Exception: <br>' .  $e->getCode() . ' ' . $e->getMessage();
}
?>