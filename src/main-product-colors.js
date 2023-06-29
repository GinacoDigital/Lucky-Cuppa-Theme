addEventListener('DOMContentLoaded', () => {
  const activeColor = document.querySelector('#main-gallery-active__color')
  const colors = document.querySelectorAll('.main-gallery__color')
  const img = document.querySelector('.main-gallery__image')

  colors.forEach(color => {
    color.addEventListener('click', () => {
      const id = color.getAttribute('data-id')
      if(activeColor.getAttribute('data-id') == id) return

      const src = color.getAttribute('data-image')
      const alt = color.getAttribute('data-name')
      const href = color.getAttribute('data-link')
      const colorName = color.getAttribute('data-color')
      const rgb = color.getAttribute('data-rgb')

      color.style.backgroundColor = `rgb(${rgb})`

      activeColor.setAttribute('data-id', id)
      activeColor.textContent = colorName

      img.parentNode.setAttribute('href', href)
      
      img.setAttribute('alt', alt)
      img.src = src
    })
  })
})