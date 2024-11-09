<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

if($_SESSION['csrf_token'] !== $data['csrf_token']) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    exit();
}

if(!isset($_GET['id'])) {
    $pokemonId = "000";
    $pokemonName = "Nom du pokemon";
    $pokemonType = "Type du pokemon";
    $pokemonImage = "photo-camera";
    $pokemonExtension = "png";
    $availableImages = $data['availableImages'] ?? [];
    $dimensionWrapperImg = "w-24 h-24 rounded-full border border-1 border-purple-700";
    $dimensionImg = "w-14 h-14";
}

if(isset($_GET['id']) && ($_GET['id'] !== null && $_GET['id'] !== "")) {
    $pokemonId = $data['pokemon']->getId() ?? "000";
    $pokemonName = $data['pokemon']->getName() ?? "Nom du pokemon";
    $pokemonType = $data['pokemon']->getType()  ?? "Type du pokemon";
    $pokemonImage = $data['pokemon']->getImage() ?? "photo-camera";
    $pokemonExtension = $data['pokemon']->getExtension() ?? "png";
    $availableImages = $data['availableImages'] ?? [];
    $dimensionWrapperImg = "w-24 h-24 rounded-full";
    $dimensionImg = $data['pokemon']->getImage() ? "w-24 h-24 rounded-full" : "w-14 h-14";
} 

?>

<main id="homepage" class="<?php echo $page_css_id ?? "" ?> mx-auto min-h-screen max-w-screen-2xl">
    <section id="qui-sommes-nous" class="mx-auto container flex flex-col items-center justify-center">
            <div class="my-5 flex flex-col gap-3 items-center justify-center">
                <h1 class="text-xl font-bold text-center">Créer un nouveau Pokemon</h1>
            </div>
            <div class="mx-auto flex justify-between gap-24"> 
                <article id="pokemon-demo-card" class="group/card relative w-[350px] h-[350px] bg-white flex flex-col justify-center items-center 
                p-5 rounded-lg shadow-md transition-colors duration-300 ease-in hover:bg-yellow-500"
                    data-title="<?php echo  $pokemonName ?>">
                    <div class="top-bar absolute w-1/2 h-1 bg-blue-600 top-0 left-1/2 transform -translate-x-1/2 rounded-b-lg"></div>
                    <div class="content flex flex-col justify-center items-center">
                        <div class="image-wrapper <?= $dimensionWrapperImg ?> flex flex-col items-center justify-center">
                            <img src="<?php echo '/public/img/pokemons/' . $pokemonImage . '.' . $pokemonExtension  ?>"
                                alt="<?php echo $pokemonName ?? "placeholder"; ?>"
                                class="<?= $dimensionImg ?> overflow-hidden object-contain object-center">
                        </div>
                        <p id="pokemon-card-name" class="text-primary mt-2 mb-3 text-sm font-semibold"><?php echo $pokemonName ?? "" ?></p>
                    </div>
                    <div class="box-footer mt-1">
                        <p id="pokemon-card-type" class="text-center"><?php echo $pokemonType ?? "" ?></p>
                    </div>
                </article>
                <aside class="flex flex-col h-[350px]">
                    <form id="create-pokemon-form" class="max-w-[600px] flex flex-col h-full gap-4" method="post" action="/crud-create-pokemon">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>">
                        <div class="mb-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" name="pokemon-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input type="text" id="type" name="pokemon-type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-3 grow flex flex-col gap-3">
                            <label for="image-select">Choisir une des images disponibles:</label>
                            <select class="!text-purple-800 !bg-slate-200 !py-3 !px-2 rounded"  name="pokemon-image" id="image-select">
                                <?php foreach ($availableImages as $key => $value): ?>
                                <option class="!text-purple-800 !bg-slate-200 rounded" value="<?= $key ?>">
                                    <?= $value ?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="flex flex-col mb-2">
                            <button type="submit" name="create-pokemon"
                            class="block justify-center items-center px-5 py-3 border border-transparent text-sm 
                            font-medium text-white button w-full rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                                Créer
                            </button>
                        </div>
                    </form>
                </aside>
            </div>
    </section>
</main>


