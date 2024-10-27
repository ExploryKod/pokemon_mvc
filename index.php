<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
use Els\Factory\DatabaseFactory;
use Els\Manager\PokemonPdoManager;
use Els\Controllers\viewControllers\createPage;

$lang = "fr";
$pokemons = [];
try {
   
    $conn = new DatabaseFactory(
        getenv('DB_HOST'),
        getenv('DB_PORT'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );
  
  $pokemonsManager = new PokemonPdoManager($conn);
  $pokemons = $pokemonsManager->getPokemons();
 

} catch (\Exception $e) {
  $errorMessage = $e->getMessage();
 
  echo "Database connection error: " . $errorMessage;
}

$mainController = new createPage();

try {
    if (empty($_GET['page'])) {
        $page = '';
    } else {
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    //$siteUrl = getenv("ELS_SITE_URL") ?? "https://els-togo.ddev.site:8443";
    $siteUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];

    switch ($page) {
        case '':
            $pageData = [
                "bodyId" => 'route-home',
                "page_css_id" => 'page-home',
                "meta" => [
                    "page_title" => 'Association ELS-Togo',
                    "page_description" => 'Site web de els-Togo',
                ],
                "view" => 'views/home.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl || "localhost:7000",
                "data" => [
                  "pokemons" => $pokemons
                ]
            ];

            $mainController->setPageData($pageData);
            break;
        case 'legal':
            $pageData = [
                "bodyId" => $page,
                "page_css_id" => 'page-legal',
                "meta" => [
                    "page_title" => 'Mentions légales - Association ELS-Togo',
                    "page_description" => 'Mentions légales du site web de els-Togo',
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
                    "page_title" => 'Crédits - Association ELS-Togo',
                    "page_description" => 'Crédits du site web de els-Togo',
                ],
                "view" => 'views/credit.view.php',
                "template" => "views/templates/template.php",
                "siteUrl" => $siteUrl
            ];
            $mainController->setPageData($pageData);
            break;
        default:
            throw new Exception("La page n'existe pas");
    }

} catch (Exception $e) {
    $pageData = [
        "bodyId" => 'route-error',
        "page_css_id" => 'page-error',
        "meta" => [
            "page_title" => "Erreur 404 - Els Togo",
            "page_description" => 'Els-Togo - erreur 404',
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




// $servername = getenv('DB_HOST');
// $username = getenv('DB_USER');
// $password = getenv('DB_PASSWORD');
// $dbname = getenv('DB_NAME');
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// // Fetch data from database
// $sql = "SELECT id, name, type FROM pokemons";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // Output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "<h2>" . $row["name"]. "</h2><p>" . $row["type"] . "</p>";
//   }
// } else {
//   echo "0 results";
// }

// $conn->close();

