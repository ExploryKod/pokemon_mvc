<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('HTTP/1.0 403 Forbidden', TRUE, 403);
die();
}
?>

<main class="container flex flex-col gap-3 min-h-screen mx-auto">
    <div class="flex flex-col gap-3">
        <div class="mx-auto">
            <h1 class="text-lg font-bold text-center">Images utilisées sur le site </h1>
        </div>
    </div>
    <div class="px-5 flex  flex-col gap-3">
        <div class="flex flex-col gap-3">
            <h2 class="text-lg">Images des pokemons</h2>
            <p>Ces images libre de droit proviennent de <a class="underline text-blue-600 hover:text-red-800" href="https://www.stickpng.com/cat/games/pokemon?page=1">Ce site</a>
        </div>
    </div>
</main>
