const showUserFavoritesRecipesButton = document.querySelector('#js_user_show_favoriteRecipes_button');
const userFavoriteRecipes = document.querySelectorAll('.js_user_favoriteRecipes');

const showRecipesForUserButton = document.querySelector('#js_show_recipes_for_user_button');
const RecipesForUser = document.querySelectorAll('.js_recipes_for_user');

function listenEvents() {
    // if (showUserFavoritesRecipesButton > 0) {
    //     showUserFavoritesRecipesButton.addEventListener('click', showUserFavoriteRecipes);
    // }
    showUserFavoritesRecipesButton.addEventListener('click', showUserFavoriteRecipes);

    // if (showRecipesForUserButton > 0) {
    //     showRecipesForUserButton.addEventListener('click', showRecipesForUser);
    // }
    showRecipesForUserButton.addEventListener('click', showRecipesForUser);

};

function showUserFavoriteRecipes() {
    userFavoriteRecipes.forEach(recipe => {
        recipe.classList.toggle('hide');
        recipe.classList.toggle('show-flex');
    })
};

function showRecipesForUser() {
    RecipesForUser.forEach(recipe => {
        recipe.classList.toggle('hide');
        recipe.classList.toggle('show-flex');
    })
};

listenEvents();
