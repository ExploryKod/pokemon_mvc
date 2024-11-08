<?php
namespace Pokemon\Controllers;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

class createPage
{
    // PUBLIC METHODS
    /**
     * Génère la data pour une page standard du site
     * @method setPage
     * @param array $pageData
     * @param array $headerLinks
     * @param array $footerLinks
     * @param array $assets
     * @return void
     */
    public function setPageData(array $pageData): void
    {
        $data_page = [
            "bodyId" => $pageData["bodyId"],
            "page_css_id" => $pageData["page_css_id"] ?? "",
            "page_description" => $pageData["meta"]["page_description"] ?? "",
            "page_title" => $pageData["meta"]["page_title"] ?? "",
            "view" => $pageData['view'],
            "template" => $pageData['template'],
            "data" => $pageData['data'] ?? [],
            "siteUrl" => $pageData['siteUrl'] ?? ""
        ];

        $this->generatePage($data_page);
    }

    public function pageError(array $pageData)
    {
        $data_page = [
            "bodyId" => $pageData["bodyId"],
            "page_css_id" => $pageData["page_css_id"],
            "page_description" => $pageData["meta"]["page_description"],
            "page_title" => $pageData["meta"]["page_title"],
            "view" => $pageData['view'],
            "template" => $pageData['template'],
            "messageError" => "Erreur 404",
            "data" => $pageData['data'] ?? []
        ];
        $this->generatePage($data_page);
    }

    private function generatePage(array $data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    public function generateCsrfToken()
    {
        return bin2hex(random_bytes(32));
    }
}
