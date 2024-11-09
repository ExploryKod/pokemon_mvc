<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
header('HTTP/1.0 403 Forbidden', TRUE, 403);
die();
}
?>

<main class="max-w-[1200px] container flex flex-col gap-3 min-h-screen mx-auto">
    <div class="flex flex-col gap-3" style="margin-top: 10px">
        <div class="pt-5 mx-auto">
            <h1 class="text-lg font-bold text-center">Images utilisées sur le site </h1>
        </div>
    </div>
    <div class="px-5 flex  flex-col gap-3">
        <div class="flex flex-col gap-3">
            <h2  class="text-lg font-bold">Images des pokemons</h2>
            <p class="text-sm">Ces images libre de droit proviennent de 
                <a class="text-sm hover:underline no-underline !text-purple-800 !font-bold" href="https://www.stickpng.com/cat/games/pokemon?page=1">ce site</a>
            <div class="flex flex-col gap-3">
                <h2 class="text-lg font-bold">Icones</h2>
                <div class="flex flex-col gap-2">
                    <p class="text-sm">Icone de camera agissant en tant que placeholder des images</p>
                    <p class="text-sm"><strong>Auteur et licence</strong> : image de Google sous licence Apache</p>
                    <a class="text-sm hover:underline no-underline !text-purple-800 !font-bold" href="https://fonts.google.com/icons">Consulter ici la source</a>
                </div>
            </div>
        
        </div>
    </div>
</main>
