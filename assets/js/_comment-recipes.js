export function listenEventsCommentRecipes() {
    const commentForms = document.querySelectorAll('.js_comment_form');
    const addCommentButtons = document.querySelectorAll('.js_comment_recipe_button');
    const showCommentsRecipeButton = document.querySelectorAll('.js_show_comments_recipe');

    if (showCommentsRecipeButton.length > 0) {
        showCommentsRecipeButton.forEach((button, index) => {
            button.addEventListener('click', () => showCommentsRecipe(index));
        });
    }

    if (addCommentButtons.length > 0) {
        addCommentButtons.forEach((button, index) => {
            button.addEventListener('click', () => showCommentForm(index));
        });
    }

    if (commentForms.length > 0) {
        commentForms.forEach((form, index) => {
            form.addEventListener('submit', (event) => submitComment(event, index));
        });
    }
}

function showCommentsRecipe(index) {
    const showCommentsRecipeButton = document.querySelectorAll('.js_show_comments_recipe');
    const commentSection = showCommentsRecipeButton[index].parentNode.querySelector('.js_comments_recipe');
    commentSection.classList.toggle('hide');
    commentSection.classList.toggle('show-flex');
}

function showCommentForm(index) {
    const commentForms = document.querySelectorAll('.js_comment_form');
    commentForms[index].classList.toggle('hide');
    commentForms[index].classList.toggle('show');
}

function submitComment(event, index) {
    const commentForms = document.querySelectorAll('.js_comment_form');
    event.preventDefault();
    const formData = new FormData(commentForms[index]);
    backCall(formData, index);
}

function backCall(dataToSend, index) {
    const commentForms = document.querySelectorAll('.js_comment_form');

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

listenEventsCommentRecipes();
