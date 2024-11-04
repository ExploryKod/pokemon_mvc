<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('HTTP/1.0 403 Forbidden', TRUE, 403);
die();
} 

    $hostname = $_SERVER['DDEV_HOSTNAME'];
    $viteClient = $_SERVER['DDEV_HOSTNAME'] ? "https://{$hostname}:5173/@vite/client" : "";
    $viteEntry = $_SERVER['DDEV_HOSTNAME'] ? "https://{$hostname}:5173/src/assets/main.js" : "";
    
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

    <?php vite_enqueue_script('assets/js/app.js', true); ?>
    <link rel="stylesheet" href='/assets/output.css' >
</head>
<body class="<?php echo $bodyId ?? "no-page" ?>">
<?php require_once(__DIR__ . '/partials/header.php'); ?>
<?= $page_content ?? "Aucun contenu de page trouvé" ?>
<?php require_once(__DIR__ . '/partials/footer.php'); ?>
</body>
</html>
