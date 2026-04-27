import './bootstrap';

const menuButton = document.querySelector('[data-mobile-menu-button]');
const menu = document.querySelector('[data-mobile-menu]');

if (menuButton && menu) {
    menuButton.addEventListener('click', () => {
        const isHidden = menu.classList.contains('hidden');
        menu.classList.toggle('hidden', !isHidden);
        menuButton.setAttribute('aria-expanded', String(isHidden));
    });
}
