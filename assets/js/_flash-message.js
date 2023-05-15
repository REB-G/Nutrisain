const registrationDone = document.getElementById('js_registration_done');

if (registrationDone) {
    setTimeout(() => {
        registrationDone.classList.add('hide')
    }, 3000);
}

const messageElement = document.getElementById('js_user-profil_updated');

if (messageElement) {
    setTimeout(() => {
        messageElement.classList.add('hide')
    }, 3000);
}
