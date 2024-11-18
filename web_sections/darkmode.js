document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;
    const mainNavbar = document.querySelector('.navbar-main');
    const secondaryNavbar = document.querySelector('.navbar-secondary');
    const componentCards = document.querySelectorAll('.component-card');
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-button');
    const icon = document.querySelector('.icon');
    const switchBtn = document.getElementById('switchBtn');
    
    // Check system preference initially
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
    const isDarkModeEnabled = localStorage.getItem('dark-mode') === 'enabled' || 
                             (localStorage.getItem('dark-mode') === null && prefersDark.matches);

    if (isDarkModeEnabled) toggleDarkMode(true);

    // Listen for system dark mode changes
    prefersDark.addEventListener('change', (e) => {
        if (localStorage.getItem('dark-mode') === null) {
            toggleDarkMode(e.matches);
        }
    });

    switchBtn.onclick = () => toggleDarkMode(body.classList.toggle('dark-mode'));

    function toggleDarkMode(enable) {
        document.documentElement.classList.toggle('dark-theme', enable);
        
        [body, mainNavbar, secondaryNavbar].forEach(el => 
            el.classList.toggle('dark-mode', enable)
        );

        componentCards.forEach(card => card.classList.toggle('dark-mode', enable));
        searchInput.classList.toggle('dark-mode', enable);
        searchButton.classList.toggle('dark-mode', enable);

        // Update icon
        icon.classList.toggle('bi-moon', !enable);
        icon.classList.toggle('bi-brightness-high', enable);
        icon.style.color = enable ? 'var(--text-primary)' : 'var(--text-primary)';

        localStorage.setItem('dark-mode', enable ? 'enabled' : 'disabled');
    }
});