<?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die();
}
?>
<footer class="bg-teal-500 text-white text-sm p-2.5">
    <div class="container mx-auto max-w-[1200px]">
        <div class="mainRow flex flex-col-reverse lg:flex-row gap-y-5 lg:justify-between lg:items-center">
            <div class="text-center lg:text-left">
                <span>&copy;</span> Amaury Franssen - 2024 Pokemon MVC - Evaluation Ynov
            </div>
            <div>
                <ul class="footer-list flex flex-col items-center sm:flex-row gap-5 list-none p-0">
                    <li class="text-xs modal-open-btn"><a href="/legal">Mentions légales</a></li>
                    <li class="text-xs modal-open-btn"><a href="/credits">Crédits</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
