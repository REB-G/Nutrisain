const navBar = document.querySelector('#js_header_container_nav');
const navBtn = document.querySelector('.header__container--btn i');
const burger = document.querySelector('.header__container--btn');
const adminLink = document.querySelector('#js_admin_link');
const headerContainer = document.querySelector('#js_header_container');
const headerLogo = document.querySelector('#js_header_logo');

if (adminLink) {
    burger.classList.add('show');
    headerLogo.classList.add('header__admin-container--logo');
    headerLogo.classList.remove('header__container--logo');
    headerContainer.classList.add('header__admin-container');
    headerContainer.classList.remove('header__container');
    navBar.classList.add('header__admin-container--nav');
    navBar.classList.remove('header__container--nav');
    navBar.classList.add('hide');
    navBar.classList.remove('nav-active');
    navBtn.classList.remove('fa-times');
    navBtn.classList.add('fa-bars');
    navBtn.addEventListener('click', function() {
        navBar.classList.toggle('hide');
        toggleNav();
    });
}

function toggleNav() {
    navBtn.classList.toggle('fa-bars');
    navBtn.classList.toggle('fa-times');
    navBar.classList.toggle('header__container--nav');
    navBar.classList.toggle('nav-active');
}

navBtn.addEventListener('click', function() {
    toggleNav();
});