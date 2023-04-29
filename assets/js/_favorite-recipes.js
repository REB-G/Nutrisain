
export function addFavoriteListeners() {
    const favorites = document.querySelectorAll(".js_favorite_recipe");
    console.log("favorites", favorites)
    console.log('ligne 5 ok', favorites)
    favorites.forEach((favorite) => {
        console.log('ligne 7, favorite', favorite)

        favorite.addEventListener("click", (event) => {
            console.log('ligne 10')
            const userId = favorite.dataset.userId;

            const recipeId = favorite.dataset.recipeId;

            let action = '';

            const icon = favorite.querySelector('i');

            if (icon.classList.contains("fa-regular")) {
                action = "add";
            } else if (icon.classList.contains("fa-solid")) {
                action = "remove";
            }

            fetch("https://127.0.0.1:8000/favorisApi", {
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
