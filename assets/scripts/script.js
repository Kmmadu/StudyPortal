function toggleMenu() {
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = headerRight.style.display === 'flex' ? 'none' : 'flex';
}

document.addEventListener('DOMContentLoaded', function() {
    const mediaQuery = window.matchMedia('(max-width: 768px)');
    const headerRight = document.querySelector('.header-right');
    headerRight.style.display = mediaQuery.matches ? 'none' : 'flex';
    mediaQuery.addListener(function(e) {
        headerRight.style.display = e.matches ? 'none' : 'flex';
    });
});
