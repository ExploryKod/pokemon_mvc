<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}

if($_SESSION['csrf_token'] !== $data['csrf_token']) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    exit();
}

?>

<main id="homepage" class="<?php echo $page_css_id ?? "" ?> mx-auto min-h-screen max-w-screen-2xl">
    <section id="qui-sommes-nous" class="mx-auto container flex flex-col items-center justify-center">
            <div class="my-5 flex flex-col gap-3 items-center justify-center">
                <h1 class="text-xl font-bold text-center">Notre équipe de pokemons</h1>
                <p class="text-lg text-center">Des pokemons prêt à servir de guide</p>
            </div>
            <div class="mx-auto flex flex-wrap justify-center gap-5">
            <?php if(!empty($data)) foreach($data["pokemons"] as $pokemon) { ?>
                <div class="group/card relative w-[350px] h-[350px] bg-purple-100 flex flex-col justify-center items-center 
                p-5 rounded-lg shadow-md transition-colors duration-300 ease-in hover:bg-yellow-500"
                    data-title="<?php echo $pokemon->getName() ?>">
                    <div class="top-bar absolute w-1/2 h-1 bg-purple-700 top-0 left-1/2 transform -translate-x-1/2 rounded-b-lg"></div>
                    <div class="content flex flex-col justify-center items-center">
                        <div class="image-wrapper">
                            <img src="<?php echo 'public/img/pokemons/' . $pokemon->getImage() . '.png' ?? 'pikachu' . '.png'; ?>"
                                alt="<?php echo $pokemonName ?? "pikachu"; ?>"
                                class="w-24 h-24 bg-purple-200 border border-2 p-2 border-purple-700 rounded-full group-hover/card:border-white  group-hover/card:bg-white  object-contain object-center">
                        </div>
                        <p class="text-primary mt-2 mb-3 text-sm font-semibold"><?php echo $pokemon->getName() ?? "" ?></p>
                    </div>
                    <div class="box-footer mt-1">
                        <p class="text-center"><?php echo $pokemon->getType() ?? "" ?></p>
                        <div class="my-4 w-full flex gap-5 items-center justify-center">
                            <form class="flex flex-col items-center justify-center" action="/delete-pokemon?id=<?= $pokemon->getId() ?>" method="POST">
                                <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token'] ?>">
                                <input type="hidden" name="id" value="<?php echo $pokemon->getId() ?>">
                                <input type="hidden" name="pokemon-name" value="<?php echo $pokemon->getName() ?>">
                                <button class="inline border-none bg-transparent p-0" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                        fill="none" stroke="currentColor" stroke-width="2" 
                                        stroke-linecap="round" stroke-linejoin="round" 
                                        class="lucide lucide-trash-2 group-hover/card:text-white text-red-700 group-hover/card:hover:text-gray-800 ">
                                        <path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                        <line x1="10" x2="10" y1="11" y2="17"/>
                                        <line x1="14" x2="14" y1="11" y2="17"/>
                                    </svg>
                                </button>
                            </form>
                            <a href="/modify-pokemon?id=<?php echo $pokemon->getId() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="group-hover/card:text-white text-blue-600  group-hover/card:hover:text-gray-800 lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
             
                    <?php } ?>
            </div>
    </section>
</main>
