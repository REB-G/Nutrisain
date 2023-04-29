const messageElement = document.getElementById('js_user-profil_updated');

if (messageElement) {
    setTimeout(() => {
        messageElement.classList.add('hide')
    }, 3000);
}