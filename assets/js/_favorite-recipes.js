export function addFavoriteListeners() {
    const favorites = document.querySelectorAll(".js_favorite_recipe");
    favorites.forEach((favorite) => {

        favorite.addEventListener("click", (event) => {
            const userId = favorite.dataset.userId;

            const recipeId = favorite.dataset.recipeId;

            let action = '';

            const icon = favorite.querySelector('i');

            if (icon.classList.contains("fa-regular")) {
                action = "add";
            } else if (icon.classList.contains("fa-solid")) {
                action = "remove";
            }

            fetch("https://nutrisain.studio/favorisApi", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    user_id: userId,
                    recipe_id: recipeId,
                    action: action,
                }),
            })
            .then (response => response.json())
            .then((data) => {
                if (data.content === 'ok') {
                    if (icon.classList.contains("fa-regular")) {
                        icon.classList.toggle("fa-regular");
                        icon.classList.toggle("fa-solid");
                    } else if (icon.classList.contains("fa-solid")) {
                        icon.classList.toggle("fa-solid");
                        icon.classList.toggle("fa-regular");
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => alert(error));
        });
    });
}

addFavoriteListeners();
