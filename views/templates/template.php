<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('HTTP/1.0 403 Forbidden', TRUE, 403);
die();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=yes" />
    <meta name="description" content="<?= $page_description ?? "" ?>">
    <title><?= $page_title ?? "" ?></title>
    <link rel="icon" type="image/png" href="/favicon-48x48.png" sizes="48x48" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MyWebSite" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href='/assets/output.css' >
</head>
<body class="<?php echo $bodyId ?? "no-page" ?>">
<?php require_once(__DIR__ . '/partials/header.php'); ?>
<?= $page_content ?? "Aucun contenu de page trouvé" ?>
<?php require_once(__DIR__ . '/partials/footer.php'); ?>
<script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="/assets/js/variables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script type="module" src="/assets/js/script.js"></script>
<script type="text/javascript" src="/assets/js/components/menuBurger.js"></script>
<script type="text/javascript" src="/assets/js/components/scroll.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="/assets/js/components/toastify.js"></script>

</body>
</html>
