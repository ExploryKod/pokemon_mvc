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
                            <a href="/modify-pokemon?id=<?php echo $pokemon->getId() ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                class="group-hover/card:text-white text-blue-600  group-hover/card:hover:text-gray-800 lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                </svg>
                            </a>

                        <!-- begin flowbite modal -->  
             
                        <button data-modal-target="pokemon-delete-modal-<?= $pokemon->getId() ?>" 
                        data-modal-toggle="pokemon-delete-modal-<?= $pokemon->getId() ?>"
                        class="block bg-transparent border-none" type="button">
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

                        <div id="pokemon-delete-modal-<?= $pokemon->getId() ?>" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="pokemon-delete-modal-<?= $pokemon->getId() ?>">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Voulez-vous vraiment supprimer <?= $pokemon->getName() ?> ?</h3>
                                        
                                        <div class="flex gap-4 items-center justify-center">
                                            <form class="flex flex-col items-center justify-center" action="/delete-pokemon?id=<?= $pokemon->getId() ?>" method="POST">
                                                <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token'] ?>">
                                                <input type="hidden" name="id" value="<?php echo $pokemon->getId() ?>">
                                                <input type="hidden" name="pokemon-name" value="<?php echo $pokemon->getName() ?>">
                                                <button data-modal-hide="pokemon-delete-modal-<?= $pokemon->getId() ?>" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Supprimer <?= $pokemon->getName() ?>
                                                </button>
                                            </form>
                                        
                                            <button data-modal-hide="pokemon-delete-modal-<?= $pokemon->getId() ?>" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- end modal-->

                        </div>
                    </div>
                </div>
             
                    <?php } ?>
            </div>
    </section>
</main>
