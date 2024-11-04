<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}
?>

<main id="homepage" class="<?php echo $page_css_id ?? "" ?>">
    <section id="qui-sommes-nous" class="text-cards-horizon team-section">
        <div class="container">
            <div class="row mainRow">
                <div class="col-12">
                    <div class="pre-title pre-title--centered">Notre équipe de pokemons</div>
                    <div class="title els-text-lg title--centered">Des pokemons prêt à servir de guide</div>
                    <p class="els-text-lg text-center">Découvrez les tréfonds du MVC grâce à eux!</p>
                </div>
                <div class="col-12 text-cards-horizon__cardsWrapper">
                    <?php
                    if(!empty($data))
                        foreach($data["pokemons"] as $pokemon) { ?>
                            <div data-typebtn="team-btn" class="box modal-open-btn"
                                 data-title="<?php echo $pokemon->getName() ?>">
                                <div class="top-bar"></div>
                                <div class="content">
                                    <div class="image-wrapper"><img src="<?php echo 'public/img/pokemons/' . $pokemon->getImage() . '.png' ?? 'pikachu' . '.png'; ?>" alt="<?php echo $pokemonName ?? "pikachu"; ?>"></div>
                                    <p><?php echo $pokemon->getName() ?? "" ?></p>
                                  
                                </div>
                                <div class="box-footer">
                                    <p><?php echo $pokemon->getType() ?? "" ?></p>
                                </div>
                            </div>

                        <?php } ?>
                </div>
            </div>
        </div>
    </section>
  
</main>
