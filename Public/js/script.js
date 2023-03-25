var menuBtn = document.querySelector('.icon-menu');
var menu = document.querySelector('.menu');

menuBtn.addEventListener('click', function () {
    if (menu.style.display === 'none') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
});

function hideMenu() {
    if (window.innerWidth > 767) {
        document.querySelector('nav .menu').style.display = 'none';
    }
}

window.addEventListener('resize', hideMenu);

document.querySelector('.hamburger').addEventListener('click', function () {
    document.querySelector('nav .menu').style.display = 'block';
});

document.querySelector('.close').addEventListener('click', function () {
    document.querySelector('nav .menu').style.display = 'none';
});