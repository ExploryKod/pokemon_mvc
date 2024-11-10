<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
use Pokemon\Factory\PDOFactory;
use Pokemon\Controllers\createPage;
use Pokemon\Controllers\Pokemons\ReadPokemonsController;
use Pokemon\Controllers\Pokemons\DeletePokemonsController;
use Pokemon\Controllers\Pokemons\UpdatePokemonsController;
use Pokemon\Controllers\Pokemons\CreatePokemonController;

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

$availableImages = [
    "pikachu" => "Pikachu", 
    "bulbizarre" => "Bulbizarre", 
    "carapuce" => "Carapuce", 
    "florizarre" => "Florizarre",
    "dracaufeu" => "Dracaufeu",
    "evoli" => "Evoli",
    "octillery" => "Octillery",
    "papilusion" => "Papilusion",
    "pikachu" => "Pikachu",
    "pyroli" => "Piroli",
    "sabelette" => "Sabelette",
    "tyranocif" => "Tyranocif"
];

$mainController = new createPage();
$pokemons = new ReadPokemonsController($pdoConn);
$updatePokemon = new UpdatePokemonsController($pdoConn);
$deletePokemons = new DeletePokemonsController($pdoConn);
$createPokemon = new CreatePokemonController($pdoConn);

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
        case 'create-pokemon':
            $_SESSION['csrf_token'] = $mainController->generateCsrfToken();
            $selectedPokemonId = $_GET['id'] ?? "";
            $pageData = [
                "bodyId" => 'route-create',
                "page_css_id" => 'create-pokemon',
                "meta" => [
                    "page_title" => 'Pokemon MVC',
                    "page_description" => 'Refactoring to fit MVC architecture',
                ],
                "view" => 'views/pokemons/createPokemon.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl || "localhost:8080",
                "data" => [
                    "csrf_token" => $_SESSION['csrf_token'],
                    "availableImages" => $availableImages,
                    "pokemon" => $pokemons->getPokemonById(intval($selectedPokemonId))
                ]
            ];
            $mainController->setPageData($pageData);
            break;
        case 'crud-create-pokemon':
            $createPokemon->createNewPokemon();
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
                "view" => 'views/pokemons/modifyPokemon.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl || "localhost:8080",
                "data" => [
                    "csrf_token" => $_SESSION['csrf_token'],
                    "pokemon" => $pokemons->getPokemonById(intval($selectedPokemonId)),
                    "availableImages" => $availableImages
                ]
            ];
            $mainController->setPageData($pageData);
            break;
        case 'crud-modify-pokemon':
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
            $deletePokemons->deletePokemonById();
            break;
        case 'pokemon-description':
            $selectedPokemonId = $_GET['id'];
            $pageData = [
                "bodyId" => $page,
                "page_css_id" => 'page-description',
                "meta" => [
                    "page_title" => 'Description - Pokemon MVC',
                    "page_description" => 'Descripton du Pokemon',
                ],
                "data" => [
                    "csrf_token" => $_SESSION['csrf_token'],
                    "pokemon" => $pokemons->getPokemonById(intval($selectedPokemonId)),
                    "availableImages" => $availableImages
                ],
                "view" => 'views/pokemons/description.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl
            ];
            $mainController->setPageData($pageData);
        default:
            throw new Exception("La page n'existe pas");
    }

} catch (Exception $e) {
    $pageData = [
        "bodyId" => 'route-error',
        "page_css_id" => 'page-error',
        "meta" => [
            "page_title" => "Erreur - Pokemon MVC",
            "page_description" => 'Pokemon MVC - erreur 404',
        ],
        "view" => 'views/error.view.php',
        "template" => "views/templates/template.php",
        "siteUrl" => $siteUrl,
        "data" => [
            "css-footer" => "els-footer--fixed",
            "message" => $e->getMessage(),
            "type" => "404"
        ]
    ];
    $mainController->pageError($pageData);
}




