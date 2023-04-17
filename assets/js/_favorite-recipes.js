const favorites = document.querySelectorAll(".js_favorite_recipe");

favorites.forEach((favorite) => {
    console.log("favorite vaut : " + favorite)
    favorite.addEventListener("click", (event) => {
        const userId = favorite.dataset.userId;
        console.log("userId vaut : " + userId)

        const recipeId = favorite.dataset.recipeId;
        console.log("recipeId vaut : " + recipeId)

        let action = '';

        const icon = favorite.querySelector('i');

        if (icon.classList.contains("fa-regular")) {
            action = "add";
        } else if (icon.classList.contains("fa-solid")) {
            action = "remove";
        }

        fetch("https://127.0.0.1:8000/API", {
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
                console.log("data.content vaut : " + data.content);

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
