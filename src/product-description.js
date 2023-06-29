addEventListener('DOMContentLoaded', () => {
  const desc = document.querySelector('#product-description')
  const children = desc.children
  
  if(children.length <= 1) return

  for(let i=1; i<children.length; i++){
    children[i].classList.add('hide')
  }

  const span = document.createElement('span')
  span.classList.add('text-black', 'td-underline', 'mt-1', 'pointer')
  span.textContent = 'Read More...'

  desc.appendChild(span)

  span.addEventListener('click', (e) => {
    e.target.style.display = 'none'

    Array.from(children).forEach(el => {
      el.classList.remove('hide')
    })
  })
})