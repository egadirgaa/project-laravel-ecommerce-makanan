    // Detect when the page is scrolled past 100vh
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > window.innerHeight / 2) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });

    // Mendapatkan elemen-elemen yang diperlukan
const themeToggle = document.getElementById("theme-toggle");
const body = document.getElementById("body");
const navbar = document.getElementById("navbar");
const sunIcon = document.getElementById("sun-icon");
const moonIcon = document.getElementById("moon-icon");

// Fungsi untuk toggle tema
themeToggle.addEventListener("click", () => {
    body.classList.toggle("dark");

    // Menampilkan ikon yang sesuai
    const isDark = body.classList.contains("dark");
    sunIcon.classList.toggle("hidden", isDark);
    moonIcon.classList.toggle("hidden", !isDark);

    // Simpan preferensi tema di localStorage
    localStorage.setItem("theme", isDark ? "dark" : "light");
});

// Menambahkan kelas shadow ke menu item jika scroll melebihi 50vh
window.addEventListener("scroll", () => {
    const scrollPosition = window.scrollY;
    const halfViewportHeight = window.innerHeight / 2;
    const menuItems = document.querySelectorAll('.group');

    menuItems.forEach(item => {
        if (scrollPosition > halfViewportHeight) {
            item.classList.add("shadow-lg");
        } else {
            item.classList.remove("shadow-lg");
        }
    });
});

// Mengatur tema berdasarkan preferensi yang tersimpan di localStorage
const savedTheme = localStorage.getItem("theme");
if (savedTheme === "dark") {
    body.classList.add("dark");
    sunIcon.classList.add("hidden");
    moonIcon.classList.remove("hidden");
} else {
    body.classList.remove("dark");
    sunIcon.classList.remove("hidden");
    moonIcon.classList.add("hidden");
}

// CSS tambahan untuk mendukung shadow putih pada menu item di dark mode
const style = document.createElement("style");
style.textContent = `
    .dark {
        background-color: #222e26;
        color: #f7fafc;
    }
    .dark #navbar {
        background-color: #222e26;
    }
    .dark .bg-white {
        background-color: #222e26 !important;
    }
    .dark .text-[#393939] {
        color: #f7fafc !important;
    }
    .dark .text-[#707070] {
        color: #a0aec0 !important;
    }
    .dark .text-[#069C54] {
        color: #48bb78 !important;
    }
    .dark .bg-[#069C54] {
        background-color: #48bb78 !important;
    }

    /* Menu item shadow effect */
    .dark .group {
        transition: box-shadow 0.3s ease-in-out;
    }

    .dark .group {
        box-shadow: 0 0px 5px rgba(255, 255, 255, 0.2);
    }

    /* Shadow color adjustment for light and dark modes */
    .group {
        box-shadow: 0 0px 5px rgba(100, 100, 100, 0.1);
    }
`;
document.head.appendChild(style);

// ScrollReveal
ScrollReveal().reveal('.reveal', {
    origin:'top',
    distance: '30px',
    duration: 800,
    reset: false
});