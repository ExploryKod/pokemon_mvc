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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> 
    <link rel="stylesheet" href='/assets/output.css' >
</head>
<body class="<?php echo $bodyId ?? "no-page" ?>">
<?php require_once(__DIR__ . '/partials/header.php'); ?>
<?= $page_content ?? "Aucun contenu de page trouvé" ?>
<?php require_once(__DIR__ . '/partials/footer.php'); ?>
<script src="assets/lib/jquery/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="module" src="/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
   
    function getQueryParam(param) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    }

    const messageAlerts = [
        { 'pokemon-deleted': 'Pokemon bien effacé.' }
    ];

    function getMessageForKey(key) {
      const alert = messageAlerts.find(alertObj => alertObj.hasOwnProperty(key));
      return alert ? alert[key] : null;
    }

    const successMessageKey = getQueryParam('success');
    const successMessage = getMessageForKey(successMessageKey);
    if (successMessage) {
      Toastify({
        text: successMessage,  
        duration: 3000,
        gravity: "top",
        position: "right",
        style: {
          background: "linear-gradient(to right, #00b09b, #96c93d)",  
        },
      }).showToast();
    }

    const errorMessageKey = getQueryParam('error');
    const errorMessage = getMessageForKey(errorMessageKey);
    if (errorMessage) {
      Toastify({
        text: errorMessage,  
        duration: 3000,
        gravity: "top",
        position: "right",
        style: {
          background: "linear-gradient(to right, #ff5f6d, #ffc371)",  
        },
      }).showToast();
    }

    if (successMessage || errorMessage) {
      const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
      window.history.replaceState({ path: newUrl }, '', newUrl);
    }
</script>

</body>
</html>
