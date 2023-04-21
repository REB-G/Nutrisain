const userShowFavoriteRecipesButton = document.querySelector('#js_user_show_favoriteRecipes_button');
const userFavoriteRecipes = document.querySelectorAll('.js_user_favoriteRecipes');

// Fonction pour écouter l'évènement du clic sur le boutton.
function listenEvents() {
    userShowFavoriteRecipesButton.addEventListener('click', showUserFavoriteRecipes);
};

// Méthode pour afficher le formulaire d'ajout de commentaire spécifique à la recette.
function showUserFavoriteRecipes() {
    userFavoriteRecipes.forEach(recipe => {
        recipe.classList.toggle('hide');
        recipe.classList.toggle('show');
    })
};

listenEvents();
