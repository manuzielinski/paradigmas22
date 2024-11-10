document.getElementById("priceFilter").addEventListener("change", function() {
    const cardsContainer = document.querySelector(".container");
    const cards = Array.from(cardsContainer.children);
    const selectedValue = this.value;
    cardsContainer.classList.add("fade-out");
    setTimeout(() => {
        cards.sort((a, b) => {
            const priceA = parseInt(a.getAttribute("data-price"));
            const priceB = parseInt(b.getAttribute("data-price"));

            return selectedValue === "lowToHigh" ? priceA - priceB : priceB - priceA;
        });

        cardsContainer.innerHTML = "";
        cards.forEach(card => cardsContainer.appendChild(card));
        cardsContainer.classList.remove("fade-out");
        cardsContainer.classList.add("fade-in");

        setTimeout(() => {
            cardsContainer.classList.remove("fade-in");
        }, 300);
    }, 300); 
});
