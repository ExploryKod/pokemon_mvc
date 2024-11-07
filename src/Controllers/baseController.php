<?php
namespace Pokemon\Controllers;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}
use Pokemon\Factory\DatabaseFactory;

abstract class BaseController
{
    protected ?DatabaseFactory $connection = null;

    /**
     * @param string $action
     * @param array $params
     */
    public function __construct()
    {
        $this->connection = new DatabaseFactory(
            getenv('DB_HOST'),
            getenv('DB_PORT'),
            getenv('DB_DATABASE'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD')
        );
    }

    /**
     * Get the site URL
     * @return string
     */
    protected function getSiteUrl(): string 
    {
        return (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    }

    /**
     * Get the database connection
     * @return DatabaseFactory|null
     */
    protected function getConnection(): ?DatabaseFactory 
    {
        return $this->connection;
    }

    /**
     * @param string $view
     * @param array $args
     * @param string $title
     * @return void
     */
    protected function render(string $view, array $args = [], string $title = "Document", array $styleLinks = [], array $styleScripts = [])
    {
        $header = dirname(__DIR__, 2) . '/views/header.php';
        $view = dirname(__DIR__, 2) . '/views/' . $view;
        $base = dirname(__DIR__, 2) . '/views/base.php';
        $styleLink = [];
        $relativePublicLink = [];
        $relativePublicScript = [];
        
        if(!empty($styleLinks)) {
            foreach($styleLinks as $link) {
                $absoluteLink = dirname(__DIR__,2) . $link;
                $relativeLink = $link;
                $styleLink[] = $absoluteLink;
                $relativePublicLink[] = $relativeLink;
            }
        }

        if(!empty($styleScripts)) {
            foreach($styleScripts as $script) {
                $absoluteScript = dirname(__DIR__,2) . $script;
                $relativeScript = $script;
                $styleLink[] = $absoluteScript;
                $relativePublicScript[] = $relativeScript;
            }
        }

        ob_start();
        foreach ($args as $key => $value) {
            ${$key} = $value;
        }

        unset($args);
        $profilePage = ['',''];
        $connexion = ['Se connecter','/login'];
        if(!empty($_SESSION['userId'])) {
            $connexion[0] = 'Se déconnecter';
            $connexion[1] = '/deconnect';
            $profilePage = ['Mon espace', '/profile'];
        }
        
        require_once $header;
        require_once $view;
        $_pageContent = ob_get_clean();
        $_pageTitle = $title;
        $_pageStyleLinks = $styleLink;
        $_pageRelativeLinks = $relativePublicLink;
        $_pageRelativeScripts = $relativePublicScript;
        require_once $base;
        exit();
    }
}