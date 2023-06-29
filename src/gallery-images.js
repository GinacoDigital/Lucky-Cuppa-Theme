addEventListener('DOMContentLoaded', () => {
  const galleryImages = document.querySelectorAll('.product-section-images-gallery__image img')
  const mainImage = document.querySelector('.product-section-images__image img')
  
  galleryImages.forEach(img => {
    img.addEventListener('click', () => {
      const src = img.src

      if(src == mainImage.src) return
      mainImage.src = src
    })
  })
})