const registrationDone = document.getElementById('js_registration_done');
console.log('le fichier fonctionne');

if (registrationDone) {
    console.log('la boucle if fonctionne');
    setTimeout(() => {
        console.log('la boucle setTimeout fonctionne');
        registrationDone.classList.add('hide')
        console.log('le problème doit venir de la classe hide');
    }, 3000);
}