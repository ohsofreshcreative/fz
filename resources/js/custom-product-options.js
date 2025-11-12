document.addEventListener('DOMContentLoaded', () => {
  const optionsWrapper = document.getElementById('custom-product-options-wrapper');
  if (!optionsWrapper) {
    return;
  }

  const priceElement = document.querySelector('.price .woocommerce-Price-amount');
  const basePrice = parseFloat(optionsWrapper.dataset.productPrice);
  const radioButtons = document.querySelectorAll('input[name="custom_product_option"]');

  const updatePrice = () => {
    let selectedOptionPrice = 0;
    const selectedRadio = document.querySelector('input[name="custom_product_option"]:checked');
    if (selectedRadio) {
      selectedOptionPrice = parseFloat(selectedRadio.value);
    }

    const newPrice = basePrice + selectedOptionPrice;

    if (priceElement) {
      const currencySymbol = priceElement.querySelector('.woocommerce-Price-currencySymbol').outerHTML;
      const formattedPrice = newPrice.toFixed(2).replace('.', ',');
      priceElement.innerHTML = `${formattedPrice}${currencySymbol}`;
    }
  };

  radioButtons.forEach(radio => {
    radio.addEventListener('change', updatePrice);
  });
  
  updatePrice();
});

