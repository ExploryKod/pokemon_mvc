<?php
namespace Pokemon\Controllers;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

use Pokemon\Manager\PokemonPdoManager;

class HomeController extends BaseController {

    public function index(): void {

        $pokemonsManager = new PokemonPdoManager($this->getConnection());
        $pokemons = $pokemonsManager->getPokemons();
    
        $pageData = [
            "bodyId" => 'route-home',
            "page_css_id" => 'page-home',
            "meta" => [
                "page_title" => 'Association ELS-Togo',
                "page_description" => 'Site web de els-Togo',
            ],
            "view" => 'views/home.view.php',
            "template" => "views/templates/template.php",
            "siteUrl" => $this->getSiteUrl(),
            "data" => [
                "pokemons" => $pokemons
            ]
        ];

        $this->render('home.view.php', $pageData);
    }
}