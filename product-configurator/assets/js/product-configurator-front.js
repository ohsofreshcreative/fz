document.addEventListener('DOMContentLoaded', () => {
  if (typeof productOptions === 'undefined' || !document.body.classList.contains('single-product')) {
    return;
  }
  const form = document.querySelector('form.cart');
  if (!form) return;

  const priceContainer = document.querySelector('p.price span.woocommerce-Price-amount.amount');
  const summaryItemsList = document.getElementById('configurator-summary-items');
  const summaryTotalSpan = document.getElementById('configurator-summary-total');
  const fixedAccommodationOptions = document.querySelector('#fixed-accommodation-options');
  const roommateField = document.getElementById('roommate-field-wrapper');
  const addToCartButton = form.querySelector('button[name="add-to-cart"]');

  if (!priceContainer || !summaryItemsList || !summaryTotalSpan || !addToCartButton) return;
  
  let hasAttemptedSubmit = false;
  const basePrice = parseFloat(productOptions.basePrice);
  if (isNaN(basePrice)) return;

  const validationMessage = document.createElement('div');
  validationMessage.className = 'configurator-validation-message';
  validationMessage.style.display = 'none';
  addToCartButton.parentNode.insertBefore(validationMessage, addToCartButton);

  const formatPrice = (price) => {
    return price.toLocaleString('pl-PL', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }) + '&nbsp;' + productOptions.currencySymbol;
  };

  const updateSummary = () => {
    let totalOptionsPrice = 0;
    summaryItemsList.innerHTML = '';

    const baseProductItem = document.createElement('li');
    baseProductItem.innerHTML = `<span class="item-label">${productOptions.productName}</span><span class="item-price">${formatPrice(basePrice)}</span>`;
    summaryItemsList.appendChild(baseProductItem);

    const selectedOptions = form.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked');

    selectedOptions.forEach(option => {
      const parentParagraph = option.closest('p, div');
      if (parentParagraph && parentParagraph.offsetParent !== null) {
        const price = parseFloat(option.dataset.price);
        const label = option.nextElementSibling.childNodes[0].textContent.trim();
        
        if (!isNaN(price)) {
          totalOptionsPrice += price;
          if (price > 0 || label) {
            const listItem = document.createElement('li');
            listItem.innerHTML = `<span class="item-label">${label}</span><span class="item-price">${formatPrice(price)}</span>`;
            summaryItemsList.appendChild(listItem);
          }
        }
      }
    });

    const newPrice = basePrice + totalOptionsPrice;
    const newPriceHtml = `<bdi>${formatPrice(newPrice)}</bdi>`;
    priceContainer.innerHTML = newPriceHtml;
    summaryTotalSpan.innerHTML = formatPrice(newPrice);
  };

  const toggleFixedAccommodation = () => {
    const selectedRegistration = form.querySelector('input[name="registration_option"]:checked');

    if (fixedAccommodationOptions) {
        if (selectedRegistration && selectedRegistration.value === 'option2') {
            fixedAccommodationOptions.style.display = 'contents';
        } else {
            fixedAccommodationOptions.style.display = 'none';
            if(roommateField) roommateField.style.display = 'none';
            const accommodationRadios = fixedAccommodationOptions.querySelectorAll('input[name="accommodation_option"]');
            accommodationRadios.forEach(radio => radio.checked = false);
        }
    }
    
    setTimeout(updateSummary, 10);
  };

  const toggleRoommateField = () => {
    const selectedAccommodation = form.querySelector('input[name="accommodation_option"]:checked');
    const isFixedAccommodationVisible = fixedAccommodationOptions && fixedAccommodationOptions.style.display !== 'none';

    if (roommateField && selectedAccommodation && isFixedAccommodationVisible && selectedAccommodation.value === 'option1') {
      roommateField.style.display = 'block';
    } else if (roommateField) {
      roommateField.style.display = 'none';
    }
  };

  const validateForm = () => {
    let isValid = true;
    
    document.querySelectorAll('.registration-options-wrapper h3.configurator-error').forEach(header => {
        header.classList.remove('configurator-error');
    });
    validationMessage.style.display = 'none';

    const registrationSelected = form.querySelector('input[name="registration_option"]:checked');
    if (!registrationSelected) {
      isValid = false;
      const registrationHeader = document.querySelector('input[name="registration_option"]')?.closest('.registration-options-wrapper').querySelector('h3');
      if (registrationHeader) registrationHeader.classList.add('configurator-error');
    }

    const accommodationVisible = fixedAccommodationOptions && fixedAccommodationOptions.style.display !== 'none';
    if (accommodationVisible) {
      const accommodationSelected = form.querySelector('input[name="accommodation_option"]:checked');
      if (!accommodationSelected) {
        isValid = false;
        const accommodationHeader = document.querySelector('input[name="accommodation_option"]')?.closest('.registration-options-wrapper').querySelector('h3');
        if (accommodationHeader) accommodationHeader.classList.add('configurator-error');
      }
    }

    if (!isValid) {
      validationMessage.textContent = 'Proszę wybrać wszystkie obowiązkowe opcje.';
      validationMessage.style.display = 'block';
    }

    return isValid;
  };

  form.addEventListener('submit', (event) => {
    hasAttemptedSubmit = true;
    if (!validateForm()) {
      event.preventDefault();
    }
  });

  form.addEventListener('change', (event) => {
    const target = event.target;
    if (target.name === 'registration_option') {
      toggleFixedAccommodation();
      toggleRoommateField();
    } else if (target.name === 'accommodation_option') {
      toggleRoommateField();
      updateSummary();
    } else if (target.type === 'checkbox' || target.id === 'roommate_name') {
      updateSummary();
    }
    
    if (hasAttemptedSubmit) {
      validateForm();
    }
  });

  toggleFixedAccommodation();
  toggleRoommateField();
  updateSummary();
});