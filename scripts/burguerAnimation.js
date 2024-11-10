document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navContainer = document.querySelector('.nav-container');
    menuToggle.addEventListener('click', function() {
        navContainer.classList.toggle('active');
    });
});
