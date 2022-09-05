<?php
define('ROOT', dirname(__DIR__)); // how to unclude it in ConfigRoutes class?
class ConfigRoutes
{
    public const ROOT = ROOT;  
    const CONFIG = self::ROOT . '/config/';
    const ROUTES = self::ROOT . '/routes/';
    const STORAGE = self::ROOT . '/storage/';
    const VIEWS = self::ROOT . '/views/';
    const APP = self::ROOT . '/app/';
    const CLASSES = self::APP . 'Classes/';
    const ACTIONS = self::APP . 'Actions/';
}
?>