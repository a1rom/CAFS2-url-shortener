<?php
require_once ConfigRoutes::CLASSES . 'DbLinks.php';
$dbLinks = new DbLinks();
$uri = $_SERVER['REQUEST_URI'];
if ($uri === '/') {
    require ConfigRoutes::VIEWS . 'index.phtml';
} else if ($uri === '/shorten' && $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['url'])) {
    $submitCache->appendCache(time(), session_id());
    if ($submitCache->countSessionSubmissions(session_id()) > 10) {
        $tooManySubmissions = TRUE;
        require ConfigRoutes::VIEWS . 'index.phtml';
    } else {
        require ConfigRoutes::ACTIONS . 'shortener.php';
    }
} else {
    require ConfigRoutes::ACTIONS . 'forwarder.php';
}
?>