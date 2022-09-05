<?php
require_once ConfigRoutes::CLASSES . 'Shortener.php';
$shortner = new Shortener($_POST['url'], session_id());

if ($shortner->getPingStatus()) {
    do {
        $shortner->createShortUri();
    } while ($dbLinks->getLinkIndex($shortner->shortUri));
    $dbLinks->addLink($shortner->url, $shortner->shortUri, $shortner->createdBy);
    $newLink = TRUE;
    require ConfigRoutes::VIEWS . 'index.phtml';
} else {
    $invalidLinkSubmitted = TRUE;
    require ConfigRoutes::VIEWS . 'index.phtml';
}
?>