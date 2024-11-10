document.addEventListener("DOMContentLoaded", function () {
    const newsItems = document.querySelectorAll('.news-item');
    newsItems.forEach((item, index) => {
        setTimeout(() => {
            item.classList.add('show');
        }, index * 300);
    });
    
});

