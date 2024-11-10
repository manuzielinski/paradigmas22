function showPopup() {
    const popup = document.getElementById('reviewPopup');
    popup.style.display = 'block';
    setTimeout(() => {
        popup.classList.add('show');
    }, 10);
}

document.getElementById('closePopup').onclick = function() {
    const popup = document.getElementById('reviewPopup');
    popup.classList.remove('show');
    setTimeout(() => {
        popup.style.display = 'none';
    }, 500);
}

window.onclick = function(event) {
    const popup = document.getElementById('reviewPopup');
    if (event.target === popup) {
        popup.classList.remove('show');
        setTimeout(() => {
            popup.style.display = 'none';
        }, 500);
    }
}

window.onload = function() {
    setTimeout(function() {
        showPopup();
    }, 2900);
}
