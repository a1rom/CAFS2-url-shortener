<?php
$index = $dbLinks->getLinkIndex($uri);
if ($index !== FALSE) {
    $dbLinks->clicked($index);
    header('Location: ' . $dbLinks->db[$index]['original_link']);
    unset($dbLinks); // is this necessary?, and do I neet to remove the session?
    die;
} else {
    $noLink = TRUE;
    require ConfigRoutes::VIEWS . 'index.phtml';
}
?>