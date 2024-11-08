<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';

use Pokemon\Controllers\createPage;
use Pokemon\Controllers\Pokemons\ReadPokemons;

$lang = "fr";
$pokemons = [];

try {




} catch (\Exception $e) {
  $errorMessage = $e->getMessage();

  echo "Database connection error: " . $errorMessage;
}

$mainController = new createPage();
$pokemons = new ReadPokemons();

try {
    if (empty($_GET['page'])) {
        $page = '';
    } else {
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    $siteUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

    switch ($page) {
        case '':
            $pageData = [
                "bodyId" => 'route-home',
                "page_css_id" => 'page-home',
                "meta" => [
                    "page_title" => 'Pokemon MVC',
                    "page_description" => 'Refactoring to fit MVC architecture',
                ],
                "view" => 'views/home.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl || "localhost:8080",
                "data" => [
                  "pokemons" => $pokemons->getPokemons()
                ]
            ];

            $mainController->setPageData($pageData);
            break;
        case 'legal':
            $pageData = [
                "bodyId" => $page,
                "page_css_id" => 'page-legal',
                "meta" => [
                    "page_title" => 'Mentions légales - Pokemon MVC',
                    "page_description" => 'Mentions légales du site web Pokemon MVC',
                ],
                "view" => 'views/legal.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl
            ];
            $mainController->setPageData($pageData);
            break;
        case 'credits':
            $pageData = [
                "bodyId" => $page,
                "page_css_id" => 'page-credit',
                "meta" => [
                    "page_title" => 'Crédits - Pokemon MVC',
                    "page_description" => 'Crédits du site web Pokemon MVC',
                ],
                "view" => 'views/credit.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl
            ];
            $mainController->setPageData($pageData);
            break;
        case 'delete-pokemon':
            if($GET['id']) {
                $pokemonId = filter_var($GET['id'], FILTER_SANITIZE_NUMBER_INT);
                $pokemonsManager->deletePokemon($pokemonId);
                header('Location: /?success=pokemon-deleted');
                exit();
            }
        default:
            throw new Exception("La page n'existe pas");
    }

} catch (Exception $e) {
    $pageData = [
        "bodyId" => 'route-error',
        "page_css_id" => 'page-error',
        "meta" => [
            "page_title" => "Erreur 404 - Pokemon MVC",
            "page_description" => 'Pokemon MVC - erreur 404',
        ],
        "view" => 'views/error.view.php',
        "template" => "views/templates/template.php",
        "siteUrl" => $siteUrl,
        "data" => [
            "css-footer" => "els-footer--fixed",
            "message" => $e->getMessage()
        ]
    ];
    $mainController->pageError($pageData);
}




