addEventListener('DOMContentLoaded', () => {
  const noticesError = document.querySelector('.woocommerce-notices-error')
  
  if(noticesError == null || typeof noticesError == 'undefined' || !noticesError){
    createElement(document.querySelector('.woocommerce-notices-wrapper'), 'ul', 'woocommerce-notices-error')
  }

  createCloneElement(document.getElementById('payment'), document.getElementById('checkout-buttons-contener'))
  createCloneElement(document.getElementById('no-available-payment-error'), document.querySelector('.woocommerce-notices-error'))
  createCloneElement(document.getElementById('form-coupon-contener'), document.querySelector('.woocommerce-checkout-review-order-info-coupon'))
  
  errorsScript()
})

function errorsScript(){
  let errors = document.querySelectorAll('.close-tag')
  if(!errors) return

  errors.forEach(error => {
    error.addEventListener('click', () => {
      const parent = error.parentNode

      parent.style.display = 'none'
    })
  })
}