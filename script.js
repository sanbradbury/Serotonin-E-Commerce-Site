
//code to add quanitiy 
function increase() {
    var value = document.getElementById("value");
    var number = value.innerHTML;
    number++;
    value.innerHTML = number;
}

function decrease() {
    var value = document.getElementById("value");
    var number = value.innerHTML;
    number--;
    value.innerHTML = number >= 0 ? number : 0;
}

//code to select size
window.addEventListener('DOMContentLoaded', () => {
    const sizesContainer = document.querySelector('.sizes');
    const sizeItems = sizesContainer.querySelectorAll('.size');

    let selectedSize = '';

    sizeItems.forEach(sizeItem =>  {
        sizeItem.addEventListener('click', () => {
            sizeItems.forEach(item => {
                item.style.backgroundColor = '';
                item.style.color = '';
            });

            sizeItem.style.backgroundColor = 'black';
            sizeItem.style.color = 'white';
            selectedSize = sizeItem.textContent;
        });
    });


    const addToCartForm = document.getElementById('add-to-cart');
    const quantityInput = document.getElementById('value');

    addToCartForm.addEventListener('submit', e => {
        e.preventDefault();

        const quantity = parseInt(quantityInput.innerHTML);

        if (selectedSize && quantity > 0) {
            addToCartForm.elements.size.value = selectedSize;
            addToCartForm.elements.quantity.value = quantity;
            addToCartForm.submit();
        } else {
            alert('Please select a valid quantity');
        }
    });
});

//javascript to add total
window.addEventListener("DOMContentLoaded", () => {
    const totalPrices = Array.from(document.querySelectorAll(".cart-item h2")).map((priceElement)=> parseFloat(priceElement.textContent.replace("R", "")));
    const subtotal = totalPrices.reduce((sum, price) => sum + price, 0);

    const deliveryPrice = 250;
    const total = subtotal + deliveryPrice;

    document.getElementById("sub-total").textContent = "R" + subtotal.toFixed(2);
    document.getElementById("delivery-total").textContent = "R" + deliveryPrice.toFixed(2);
    document.getElementById("total-total").textContent = "R" + total.toFixed(2);

    const trashIcons = document.querySelectorAll(".cart-item .delete-icon");
  trashIcons.forEach(icon => {
    icon.addEventListener("click", removeCartItem);
  });

  function removeCartItem(event) {
    const icon = event.target;
    const productName = icon.dataset.product;
    const size = icon.dataset.size;
    const quantity = icon.dataset.quantity;

    // Make an AJAX request to remove_cart_item.php
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "remove_cart_item.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if (response === "success") {
            // Remove the cart item from the DOM
            const cartItem = icon.closest(".cart-item");
            cartItem.remove();

            // Recalculate the total
            const totalPrices = Array.from(document.querySelectorAll(".cart-item h2")).map(priceElement => parseFloat(priceElement.textContent.replace("R", "")));
            const subtotal = totalPrices.reduce((sum, price) => sum + price, 0);

            const deliveryPrice = 250;
            const total = subtotal + deliveryPrice;

            document.getElementById("sub-total").textContent = "R" + subtotal.toFixed(2);
            document.getElementById("delivery-total").textContent = "R" + deliveryPrice.toFixed(2);
            document.getElementById("total-total").textContent = "R" + total.toFixed(2);
          } else {
            console.error("Failed to remove cart item.");
          }
        } else {
          console.error("An error occurred while processing the request.");
        }
      }
    };

    // Send the request
    xhr.send(`prod_name=${productName}&size=${size}&quantity=${quantity}`);
  }


   
});

