<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

if($_SESSION['csrf_token'] !== $data['csrf_token']) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    exit();
}

if($_GET['id'] !== null && $_GET['id'] !== "") {
    $pokemonId = $data['pokemon']->getId();
    $pokemonName = $data['pokemon']->getName();
    $pokemonType = $data['pokemon']->getType();
    $pokemonDescription = $data['pokemon']->getDescription();
    $pokemonImage = $data['pokemon']->getImage();
    $availableImages = $data['availableImages'] ?? [];
} else {
    header('Location: /?message=pokemon_not_found');
    exit();
}

?>

<main class="<?php echo $page_css_id ?? "" ?> mx-auto min-h-screen max-w-screen-2xl">
    <section class="mx-auto container flex flex-col items-center justify-center">
            <div class="my-5 flex flex-col gap-3 items-center justify-center">
                <h1 class="my-5 text-xl font-bold text-center"><?= $pokemonName ?></h1>
            </div>
            <div class="mx-auto flex justify-between gap-24 p-3"> 
                <article class="group/card relative max-w-[75%] min-h-[350px] bg-white flex flex-col justify-between items-center 
                p-5 rounded-lg border border-2 border-purple-700 transition-colors duration-300 ease-in hover:bg-yellow-500">
                    <div class="flex flex items-center justify-center top-bar absolute w-1/2 bg-purple-600 top-0 left-1/2 transform -translate-x-1/2 rounded-b-lg">
                        <p class="text-white text-center mt-2 mb-3 text-sm font-semibold">
                            <?php echo $pokemonName ?? "Aucun nom" ?>
                        </p>
                    </div>
                    <div class="pt-10 content flex flex-col justify-center items-center">
                        <div class="w-[350px] h-auto flex items-center justify-center">
                            <img src="<?php echo 'public/img/pokemons/' . $pokemonImage . '.png' ?? 'pikachu' . '.png'; ?>"
                                alt="<?php echo $pokemonName ?? "pikachu"; ?>"
                                class="w-full object-contain object-center">
                        </div>
                    </div>
                    <div class="box-footer mt-3 flex flex-col gap-5">
                        <p class="text-center"><?php echo $pokemonType ?? "Aucun type" ?></p>
                        <p class="text-lg text-gray-600"><?= $pokemonDescription ?? "Aucune description" ?></p>
                    </div>
                </article>
            </div>
    </section>
</main>


