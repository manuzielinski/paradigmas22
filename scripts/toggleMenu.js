document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navContainer = document.querySelector('.nav-container');
    
    menuToggle.addEventListener('click', function(event) {
        navContainer.classList.toggle('active');
        navContainer.style.transition = "transform 0.3s ease-out, opacity 0.3s ease-out";

        if (navContainer.classList.contains('active')) {
            navContainer.style.transform = "translateX(0)";
            navContainer.style.opacity = "1";
        } else {
            navContainer.style.transform = "translateX(-100%)";
            navContainer.style.opacity = "0";
        }
        
        event.stopPropagation();
    });

    window.addEventListener('click', function(event) {
        const menuToggle = document.querySelector('.menu-toggle');

        if (!navContainer.contains(event.target) && !menuToggle.contains(event.target)) {
            navContainer.classList.remove('active');
            navContainer.style.transform = "translateX(-100%)";
            navContainer.style.opacity = "0";
        }
    });
});
