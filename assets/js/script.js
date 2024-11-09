window.addEventListener('DOMContentLoaded', (event) => {

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

  selectPokemonImg();

});