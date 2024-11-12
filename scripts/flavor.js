const flavorButtons = document.querySelectorAll('.flavor-btn');
const selectedFlavor = document.getElementById('selectedFlavor');
const quantityInput = document.getElementById('quantity');
const purchaseStatus = document.getElementById('purchaseStatus');
const buyButton = document.getElementById('buyButton');
const purchaseForm = document.getElementById('purchaseForm'); // Referencia al formulario

let flavorSeleccionado = '';

flavorButtons.forEach(button => {
    button.addEventListener('click', function () {
        flavorSeleccionado = this.getAttribute('data-flavor');
        selectedFlavor.textContent = `Has seleccionado: ${flavorSeleccionado}`;
        purchaseStatus.textContent = '';
    });
});

buyButton.addEventListener('click', function (event) {
    event.preventDefault(); // Prevenir el comportamiento por defecto del botón
    const cantidadComprar = parseInt(quantityInput.value);

    if (flavorSeleccionado === '') {
        purchaseStatus.textContent = 'Por favor, selecciona un sabor.';
        purchaseStatus.style.color = 'red';
    } else if (cantidadComprar <= 0) {
        purchaseStatus.textContent = 'La cantidad debe ser mayor que cero.';
        purchaseStatus.style.color = 'red';
    } else {
        document.getElementById('selectedFlavorInput').value = flavorSeleccionado; 

        purchaseStatus.textContent = `Redireccionando...`;
        purchaseStatus.style.color = 'green';

        purchaseForm.submit();
    }
});
