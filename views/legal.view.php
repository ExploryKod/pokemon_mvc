<?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
} ?>
<main class="min-h-screen mx-auto max-w-[1200px]">
  <div class="mx-auto px-5 container">
      <div class="mx-auto max-w-[800px] bg-white shadow-md mx-auto p-6 rounded-lg max-w-4xl">
        <h1 class="mb-4 font-bold text-3xl text-gray-800">Mentions Légales</h1>

        <section class="my-5">
          <h2 class="mb-5 font-semibold text-gray-700 text-xl">Éditeur du site</h2>
          <p>Amaury Franssen, dans le cadre d'un examen pour l' 
            <a class="text-purple-500 hover:underline" href="https://www.ynov.com/formations/informatique?_gl=1*7rx19r*_up*MQ..&gclid=Cj0KCQiA0MG5BhD1ARIsAEcZtwRwT8iLb0JAZ7UAaUPGeDUTUGz8Fb8fPlYavBZCOTa-vaJAFo9OSusaAnLpEALw_wcB">école Ynov</a> - France</p>
          <p class="mt-2 text-gray-600">
            <strong>Email</strong> : <a href="mailto:amaury.franssen@ynov.com" class="text-purple-500 hover:underline">amaury.franssen@ynov.com</a>
          </p>
        </section>

        <section class="my-5">
          <h2 class="mb-2 font-semibold text-gray-700 text-xl">Directeur de la publication</h2>
          <p class="text-gray-600">Amaury Franssen </p>
          <a class="text-purple-500 hover:underline" href="mailto:amaury.franssen@ynov.com">amaury.franssen@ynov.com</a>
        </section>

        <section class="my-5">
          <h2 class="mb-2 font-semibold text-gray-700 text-xl">Hébergement</h2>
          <p class="text-gray-600">
            Ce site est hébergé par la société <a class="text-purple-500 hover:underline" href="https://render.com">Render.com</a>.
          </p>
          <p><strong>Adresse :</strong> Address: 525 Brannan Street Ste 300 San Francisco CA 94107.</p>
          <p><strong>Téléphone (US):</strong>  <a href="tel:+4153198186">415-319-8186</a>
          <p><strong>Email :</strong> <a class="text-purple-500 hover:underline" href="mailto:legal@render.com">legal@render.com</a>
        </section>

        <section class="my-5">
          <h2 class="mb-2 font-semibold text-gray-700 text-xl">Garantie et sécurité</h2>
          <p class="text-gray-600">
            Le contenu de ce site est édité sous réserve d’erreurs techniques et/ou typographiques, avec des photos non contractuelles.
            <br />L'éditeur ne saurait être tenu responsable quant à l’exactitude des informations mises à disposition des utilisateurs accédant au site.
            <br />En outre,  l'éditeur ne peut garantir que son fonctionnement sera exempt d’interruptions ou d’erreurs.
          </p>
        </section>
        <section class="my-5">
          <h2 class="mb-2 font-semibold text-gray-700 text-xl">Droit applicable et attribution de juridiction :</h2>
          <p class="text-gray-600">
          Tout litige en relation avec l’utilisation de ce site web est soumis au droit français. 
          <br />Il est fait attribution exclusive de juridiction aux tribunaux compétents de Paris.
          </p>
        </section>
      </div>
    </div>
</main>
