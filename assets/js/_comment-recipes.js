const commentForms = document.querySelectorAll('.js_comment_form');
const addCommentButtons = document.querySelectorAll('.js_comment_recipe_button');
const showCommentsRecipeButton = document.querySelectorAll('.js_show_comments_recipe');

// Fonction pour écouter les événements sur chaque formulaire de commentaire.
function listenEvents() {
    showCommentsRecipeButton.forEach((button, index) => {
        button.addEventListener('click', () => showCommentsRecipe(index));
    });

    addCommentButtons.forEach((button, index) => {
        button.addEventListener('click', () => showCommentForm(index));
    });
    commentForms.forEach((form, index) => {
        form.addEventListener('submit', (event) => submitComment(event, index));
    });
}

function showCommentsRecipe(index) {
    const commentSection = showCommentsRecipeButton[index].parentNode.querySelector('.js_comments_recipe');
    commentSection.classList.toggle('hide');
    commentSection.classList.toggle('show-flex');
}

// Méthode pour afficher le formulaire d'ajout de commentaire spécifique à la recette.
function showCommentForm(index) {
    commentForms[index].classList.toggle('hide');
    commentForms[index].classList.toggle('show');
}

function submitComment(event, index) {
    event.preventDefault();
    const formData = new FormData(commentForms[index]);
    backCall(formData, index);
}

// Fonction pour envoyer les données du formulaire en AJAX.
function backCall(dataToSend, index) {
    const recipeId = commentForms[index].dataset.recipeId;
    dataToSend.append('recipeId', recipeId);

    const userId = commentForms[index].dataset.userId;
    dataToSend.append('userId', userId);

    const userName = commentForms[index].dataset.userName;
    dataToSend.append('userName', userName);

    const userFirstname = commentForms[index].dataset.userFirstname;
    dataToSend.append('userFirstname', userFirstname);

    fetch('https://nutrisain.studio/commentsApi', {
        method: "POST",
        body: dataToSend})
    .then((response) => response.json())
    .then((data) => {
        if (data.status === 'ok') {
            commentForms[index].classList.remove('show');
            commentForms[index].classList.add('hide');
            commentForms[index].reset();
        }
        else if (data.status === 'nok') {
            alert(data.message);
        }
    })
    .catch(error => alert(error));
}

listenEvents();
