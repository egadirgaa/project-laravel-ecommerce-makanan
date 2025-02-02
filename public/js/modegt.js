document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    // Mode default
    if (localStorage.getItem('theme') === 'dark') {
        html.classList.add('dark');
        themeIcon.classList.replace('bx-sun', 'bx-moon');
    }

    // Toggle mode gelap/terang
    themeToggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        if (html.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            themeIcon.classList.replace('bx-sun', 'bx-moon');
        } else {
            localStorage.setItem('theme', 'light');
            themeIcon.classList.replace('bx-moon', 'bx-sun');
        }
    });
});