window.onload = () => {
    console.log('hello, je suis dans le onload');

    const filtersForm = document.querySelectorAll('#filters_form');

    document.querySelectorAll('#filters_form input').forEach(input => {
        input.addEventListener('change', () => {
            console.log('hello, je suis dans le addEventListener');

            const data = new FormData(filtersForm[0]);
            console.log('data vaut = ' + data);

            const Params = new URLSearchParams(data);
            console.log('prarams vaut : ' + Params);

            //form.forEach((value, key) => {
            //    form.append(key, value);
            //});

            const url = new URL(window.location.href);
            console.log('url vaut' + url);

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




