const userShowFavoriteRecipesButton = document.querySelectorAll('.js_user_show_favoriteRecipes_button');
const userFavoriteRecipes = document.querySelectorAll('.js_user_favoriteRecipes');

// Fonction pour écouter l'évènement du clic sur le boutton.
function listenEvents() {
    userShowFavoriteRecipesButton.forEach((button, index) => {
        button.addEventListener('click', () => showUserFavoriteRecipes(index));
    });
}

// Méthode pour afficher le formulaire d'ajout de commentaire spécifique à la recette.
function showUserFavoriteRecipes(index) {
    userFavoriteRecipes[index].classList.toggle('hide');
    userFavoriteRecipes[index].classList.toggle('show');
}

listenEvents();
