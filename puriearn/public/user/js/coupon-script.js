function generateCouponCode(event) {
  event.preventDefault(); // Prevent form submission
  var planSelect = document.getElementById('plan-select');
  var planId = planSelect.value;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'generate_coupon_code.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          showPopup(response.couponCode);
        } else {
          showPopupError(response.message);
        }
      } else {
        var errorMessage = 'Error: ' + xhr.status + ' - ' + xhr.statusText;
        showPopupError(errorMessage);
      }
    }
  };
  xhr.send('planId=' + encodeURIComponent(planId));
}


function showPopup(couponCode) {
  var popup = document.getElementById('popup');
  var couponCodeInput = document.getElementById('coupon-code-input');

  couponCodeInput.value = couponCode;
  popup.style.display = 'block';
}

function showPopupError(errorMessage) {
  var errorContainer = document.getElementById('error-container');
  var couponInput = document.getElementById('coupon-code-input');
  var copyButton = document.querySelector('#popup button');
  var closeBtn = document.querySelector('#popup .close-button');

  // Set the error message as the text content of the error container
  errorContainer.textContent = errorMessage;

  // Hide the coupon input and copy button
  couponInput.style.display = 'none';
  copyButton.style.display = 'none';

  // Make the error container and the popup visible
  errorContainer.style.display = 'block';
  closeBtn.style.display = 'block'; // Show the close button
  var popup = document.getElementById('popup');
  popup.style.display = 'block';
}


function closePopup() {
  var popup = document.getElementById('popup');
  popup.style.display = 'none';
  window.location = 'coupons.php';
}


function copyToClipboard() {
  var couponCodeInput = document.getElementById('coupon-code-input');
  couponCodeInput.select();
  couponCodeInput.setSelectionRange(0, 99999); // For mobile devices

  document.execCommand('copy');
  alert('Coupon code copied to clipboard!');
  window.location = 'coupons.php';

}
