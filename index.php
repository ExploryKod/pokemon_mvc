<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
use Pokemon\Factory\PDOFactory;
use Pokemon\Controllers\createPage;
use Pokemon\Controllers\Pokemons\ReadPokemons;
use Pokemon\Controllers\Pokemons\DeletePokemons;
use Pokemon\Controllers\Pokemons\UpdatePokemonsController;

$lang = "fr";
$pokemons = [];

try {

    $pdoConn = new PDOFactory(
        getenv('DB_HOST'),
        getenv('DB_PORT'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );

} catch (\Exception $e) {
  $errorMessage = $e->getMessage();

  echo "Database connection error: " . $errorMessage;
}

$mainController = new createPage();
$pokemons = new ReadPokemons($pdoConn);
$updatePokemon = new UpdatePokemonsController($pdoConn);
$deletePokemons = new DeletePokemons($pdoConn);

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
            $_SESSION['csrf_token'] = $mainController->generateCsrfToken();
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
                  "csrf_token" => $_SESSION['csrf_token'],
                  "pokemons" => $pokemons->getPokemons()
                ]
            ];

            $mainController->setPageData($pageData);
            break;
        case 'modify-pokemon':
            $_SESSION['csrf_token'] = $mainController->generateCsrfToken();
            $selectedPokemonId = $_GET['id'];
            $pageData = [
                "bodyId" => 'route-modify',
                "page_css_id" => 'modify-pokemon',
                "meta" => [
                    "page_title" => 'Pokemon MVC',
                    "page_description" => 'Refactoring to fit MVC architecture',
                ],
                "view" => 'views/modifyPokemon.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl || "localhost:8080",
                "data" => [
                    "csrf_token" => $_SESSION['csrf_token'],
                    "pokemon" => $pokemons->getPokemonById($selectedPokemonId)
                ]
            ];
            $mainController->setPageData($pageData);
            break;
        case 'update-pokemon':
            $updatePokemon->updatePokemon();
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
            if($_POST['id']) {
                $deletePokemons->deleteById();
            } else {
                header('Location: /?error="pokemon-no-id');
                exit();
            }
            break;
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




