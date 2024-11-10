
const selectPokemonImg = () => {
  const pokemonNameInput = document.querySelector('#create-pokemon-form #name');
  const pokemonTypeInput = document.querySelector('#create-pokemon-form #type');
  const pokemonImgSelect = document.querySelector('#create-pokemon-form #image-select'); 

  const pokemonImg = document.querySelector('.image-wrapper img'); 
  const pokemonTypeText = document.querySelector('#pokemon-demo-card #pokemon-card-type');
  const pokemonNameText = document.querySelector("#pokemon-demo-card #pokemon-card-name");
  
  pokemonImgSelect.addEventListener('change', () => {
    const selectedValue = pokemonImgSelect.value; 
    pokemonImg.src = '/public/img/pokemons/' + selectedValue + '.png';
  });

  pokemonNameInput.addEventListener('input', () => {
    const selectedNameValue = pokemonNameInput.value; 
    pokemonNameText.textContent = selectedNameValue;
  });

  pokemonTypeInput.addEventListener('input', () => {
    const selectedTypeValue = pokemonTypeInput.value; 
    pokemonTypeText.textContent = selectedTypeValue;
  });
};

const putScrollbarSizeInCSSVariables = () => {
  let timeout = false
  const delay = 250
  window.addEventListener('resize', () => {
    clearTimeout(timeout)
    timeout = setTimeout(() => {
      document.documentElement.style.setProperty('--scrollbarsize', `${window.innerWidth - document.documentElement.clientWidth}px`)
    }, delay)
  })
  setTimeout(() => {
    document.documentElement.style.setProperty('--scrollbarsize', `${window.innerWidth - document.documentElement.clientWidth}px`)
  }, 0)
}

const minWidth = (value) => {
  return window.matchMedia(`(min-width: ${variables.breakpoints[value]})`).matches
}

const goToPokemonPage = () => {
  
  document.addEventListener('click', (e) => {
    
    if (e.target.closest('[id^="pokemon-delete-modal-"]')) {
      return;
    }

    if (e.target.closest('a[href^="/modify-pokemon"]')) {
      return;
    }

    if (e.target.closest('[data-modal-target^="pokemon-delete-modal-"]')) {
      return;
    }

    const card = e.target.closest('.pokemon-card');
    if (card) {
      const dataId = card.dataset.id;
      if (dataId) {
        window.location.href = `pokemon-description?id=${dataId}`;
      }
    }
  });
};

window.addEventListener('DOMContentLoaded', (event) => {
  const createPokemonPage = document.querySelector('.route-create');
  const homePage = document.querySelector('.route-home');

  if(homePage) {
    goToPokemonPage()
  }

  if (createPokemonPage) {
    selectPokemonImg();
  }
  putScrollbarSizeInCSSVariables()
  minWidth()
});