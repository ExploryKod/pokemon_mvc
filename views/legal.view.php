<?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
} ?>
<main class="min-h-screen mx-auto">
<div className="mx-auto px-5 container">
      <div className="mx-auto max-w-[800px] bg-white shadow-md mx-auto my-5 p-6 rounded-lg max-w-4xl">
        <h1 className="mb-4 font-bold text-3xl text-gray-800">Fausses Mentions Légales</h1>

        <section className="mb-6">
          <h2 className="mb-2 font-semibold text-gray-700 text-xl">Éditeur du site</h2>
          <p className="text-gray-600">
            <strong>MVC Pokemon</strong>, société de présentation des pokemon avec une architecture MVC, est une société SAS au capital social de 0 euros, dont le siège social est situé au
            <span className="inline not-italic">nulle part</span>.
            <br />Elle est immatriculée au Registre du Commerce et des Sociétés de nulle part sous le numéro 000000.
          </p>
          <p className="mt-2 text-gray-600">
            Téléphone : <a href="tel:+0000870078" className="text-blue-500 hover:underline">+00 00 87 00 78</a>
          </p>
        </section>

        <section className="mb-6">
          <h2 className="mb-2 font-semibold text-gray-700 text-xl">Directeur de la publication</h2>
          <p className="text-gray-600">Amaury Franssen et Nassim Aissaoui</p>
          <a href="mailto:">pokemon-fake@yuamail.com</a>
        </section>

        <section className="mb-6">
          <h2 className="mb-2 font-semibold text-gray-700 text-xl">Hébergement</h2>
          <p className="text-gray-600">
            Ce site n'est hébergé null part à ce stade
          </p>
        </section>

        <section class="mb-6">
          <h2 class="mb-2 font-semibold text-gray-700 text-xl">Garantie et sécurité</h2>
          <p class="text-gray-600">
            Le contenu de ce site est édité sous réserve d’erreurs techniques et/ou typographiques, avec des photos non contractuelles.
            <br />La société ne saurait être tenue responsable quant à l’exactitude des informations mises à disposition des utilisateurs accédant au site.
            <br />En outre,  les éditeurs ne peuvent garantir que son fonctionnement sera exempt d’interruptions ou d’erreurs.
          </p>
        </section>

      </div>
    </div>
</main>
