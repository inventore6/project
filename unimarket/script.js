function toggleMenu() {
    const menu = document.getElementById('userDropdown');
    if (menu) {
        menu.classList.toggle('active');
    }
}

// Chiudi il menu se clicchi fuori
window.addEventListener('click', function (e) {
    const menu = document.getElementById('userDropdown');
    const avatar = document.querySelector('.user-avatar');
    const nome = document.querySelector('.nome');

    if (menu && avatar && nome) {
        if (!menu.contains(e.target) && !avatar.contains(e.target) && !nome.contains(e.target)) {
            menu.classList.remove('active');
        }
    }
});