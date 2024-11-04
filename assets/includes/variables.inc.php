<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', true, 403);
    die();
}
define('IS_VITE_DEVELOPMENT', true);
define('VITE_SERVER', 'https://pokemon.ddev.site:5173');

define('DIST_FOLDER', 'build');
define('DIST_PATH', DIST_FOLDER);

define('LANG', isset($_GET['lang']) ? $_GET['lang'] : 'fr');
define('__ROOT__', dirname(dirname(__FILE__)));

/*
 * ================================
 *  Get le fichier de traduction
 */
$translationFilePath = realpath(__DIR__) . '/../../assets/lang/' . LANG . '.json';
$translationsObject = [];
if (file_exists($translationFilePath)) {
    $translationsObject = file_get_contents($translationFilePath);
    $translationsObject = json_decode($translationsObject, true);
}

define('TRANSLATIONS', serialize($translationsObject));