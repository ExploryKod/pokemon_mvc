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
    $pokemonImage = $data['pokemon']->getImage();
    $availableImages = $data['availableImages'] ?? [];
} else {
    header('Location: /?message=pokemon_not_found');
    exit();
}

?>

<main id="homepage" class="<?php echo $page_css_id ?? "" ?> mx-auto min-h-screen max-w-screen-2xl">
    <section id="qui-sommes-nous" class="mx-auto container flex flex-col items-center justify-center">
            <div class="my-5 flex flex-col gap-3 items-center justify-center">
                <h1 class="text-xl font-bold text-center">Modifier <?= $pokemonName ?></h1>
            </div>
            <div class="mx-auto flex justify-between gap-24"> 
                <article class="group/card relative w-[350px] h-[350px] bg-white flex flex-col justify-center items-center 
                p-5 rounded-lg shadow-md transition-colors duration-300 ease-in hover:bg-yellow-500"
                    data-title="<?php echo  $pokemonName ?>">
                    <div class="top-bar absolute w-1/2 h-1 bg-blue-600 top-0 left-1/2 transform -translate-x-1/2 rounded-b-lg"></div>
                    <div class="content flex flex-col justify-center items-center">
                        <div class="image-wrapper">
                            <img src="<?php echo 'public/img/pokemons/' . $pokemonImage . '.png' ?? 'pikachu' . '.png'; ?>"
                                alt="<?php echo $pokemonName ?? "pikachu"; ?>"
                                class="w-24 h-24 rounded-full object-cover object-top">
                        </div>
                        <p class="text-primary mt-2 mb-3 text-sm font-semibold"><?php echo $pokemonName ?? "" ?></p>
                    </div>
                    <div class="box-footer mt-1">
                        <p class="text-center"><?php echo $pokemonType ?? "" ?></p>
                    </div>
                </article>
                <aside class="flex flex-col h-[350px]">
                    <form class="max-w-[600px] flex flex-col h-full gap-4" method="post" action="/crud-modify-pokemon">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>">
                        <input type="hidden" name="pokemon-id" value="<?php echo $pokemonId ?>">
                        <div class="mb-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" name="pokemon-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $pokemonName?? ""?>">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input type="text" id="type" name="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $pokemonType?? ""?>">
                        </div>
                        <!-- <div class="mb-3 grow flex flex-col gap-3">
                            <label for="image-select">Choisir une des images disponibles:</label>
                            <select class="!text-purple-800 !bg-slate-200 !py-3 !px-2 rounded"  name="image" id="image-select">
                                <?php foreach ($availableImages as $key => $value): ?>
                                <option class="!text-purple-800 !bg-slate-200 rounded" value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach;?>
                            </select>
                        </div> -->
                        <div class="flex flex-col mb-2">
                            <button type="submit" name="update-pokemon"
                            class="block justify-center items-center px-5 py-3 border border-transparent text-sm 
                            font-medium text-white button w-full rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                                Modifier
                            </button>
                        </div>
                    </form>
                </aside>
            </div>
    </section>
</main>


