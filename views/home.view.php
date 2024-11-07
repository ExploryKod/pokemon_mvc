<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
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
                <div class="relative w-[350px] h-[350px] bg-white flex flex-col justify-center items-center p-5 rounded-lg shadow-md transition-colors duration-300 ease-in hover:bg-yellow-500"
                    data-title="<?php echo $pokemon->getName() ?>">
                    <div class="top-bar absolute w-1/2 h-1 bg-blue-600 top-0 left-1/2 transform -translate-x-1/2 rounded-b-lg"></div>
                    <div class="content flex flex-col justify-center items-center">
                        <div class="image-wrapper">
                            <img src="<?php echo 'public/img/pokemons/' . $pokemon->getImage() . '.png' ?? 'pikachu' . '.png'; ?>"
                                alt="<?php echo $pokemonName ?? "pikachu"; ?>"
                                class="w-24 h-24 rounded-full object-cover object-top">
                        </div>
                        <p class="text-primary mt-2 mb-3 text-sm font-semibold"><?php echo $pokemon->getName() ?? "" ?></p>
                    </div>
                    <div class="box-footer mt-1">
                        <p class="text-center"><?php echo $pokemon->getType() ?? "" ?></p>
                    </div>
                </div>

                    <?php } ?>
            </div>
    </section>
</main>
