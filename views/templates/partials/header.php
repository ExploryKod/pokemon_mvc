<header class="mainHeader fixed top-0 left-0 right-0 z-[500] bg-purple-700 shadow-lg text-center transition-all duration-300 ease-in-out" style="height: var(--header-height); padding: var(--header-padding);">
    <div class="container mx-auto max-w-[1200px]">
        <div class="flex items-center h-full">
            <!-- Logo Section -->
            <div class="logo h-full mr-12 px-0" style="padding: var(--header-logo-padding);">
                <a href="/#homepage" data-hash="#homepage">
                    <img class="h-[80px] w-auto" src="/public/img/logo.svg" alt="Logo pokemon mvc">
                </a>
            </div>
            <!-- Navigation Section -->
            <nav class="flex-1 hidden lg:flex">
                <div class="flex items-center justify-between w-full">
                    <!-- Header Menu -->
                    <ul class="flex flex-row gap-8 lg:flex-row lg:space-x-8 p-0 m-0 list-none">
                        <li class="menu__nav-item">
                            <a href="/#homepage" 
                               class="text-white linear-anim-link linear-color-light  transition-all duration-50">
                                Nos pokemons
                            </a>
                        </li>
                    </ul>
                    <!-- Call-to-Action Button -->
                    <div class="ml-5">
                        <a href="/create-pokemon" class="py-2 px-4 bg-white text-purple-700 font-bold rounded hover:bg-yellow-500 hover:text-white transition">
                            Créer un pokemon
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Burger Menu for Mobile -->
            <div class="col-auto lg:hidden">
                <button class="burger-menu__button flex p-0 bg-transparent border-0 cursor-pointer" aria-label="Menu">
                    <svg viewBox="0 0 100 100" class="h-10 w-10">
                        <path class="line line1 transition-all duration-500 ease-in-out" d="M 20,29 H 80 C 80,29 94.5,28.8 94.5,66.7 94.5,78 90.97,81.67 85.26,81.67 79.55,81.67 75,75 75,75 L 25,25"></path>
                        <path class="line line2 transition-all duration-500 ease-in-out" d="M 20,50 H 80"></path>
                        <path class="line line3 transition-all duration-500 ease-in-out" d="M 20,71 H 80 C 80,71 94.5,71.2 94.5,33.3 94.5,22 90.97,18.33 85.26,18.33 79.55,18.33 75,25 75,25 L 25,75"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
