window.onload = () => {
    const filtersForm = document.querySelectorAll('#filters_form');
    const filtersButton = document.querySelector('#js_filters_button');

    filtersButton.addEventListener('click', () => {
        filtersForm[0].classList.toggle('hide');
        filtersForm[0].classList.toggle('show-flex');
    });

    document.querySelectorAll('#filters_form input').forEach(input => {
        input.addEventListener('change', () => {

            const data = new FormData(filtersForm[0]);

            const Params = new URLSearchParams(data);

            const url = new URL(window.location.href);

            fetch(url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    'x-requested-with': 'XMLHttpRequest'
                }
            }).then(response => response.json()
            ).then(data => {
                const filteredRecipes = document.querySelector('#filtered_recipes');
                filteredRecipes.innerHTML = data.content;

                // Permet de mettre à jour l'url à chaque case cochée
                history.pushState({}, null, url.pathname + "?" + Params.toString());
            }).catch(error => alert(error));
        });
    });
}




