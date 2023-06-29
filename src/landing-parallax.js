// landingParallax()

// function landingParallax(){
//   const arr = []
//   const elements = document.querySelectorAll('.parallax')
//   const container = document.querySelector('.parallax-container')
  
//   elements.forEach(el => {
//     arr[arr.length] = {
//       el: el,
//       py: container.offsetTop,
//       height: container.clientHeight
//     }
//   })

//   let lastScrollTop = scrollY
//   let scrollUp = false
//   let translateY = 0

//   addEventListener('scroll', () => {
//     let scrollTop = scrollY
    
//     lastScrollTop <= scrollTop ? scrollUp = false : scrollUp = true
//     lastScrollTop = scrollTop

//     scrollTop ? translateY -= 10 : translateY += 10

//     arr.forEach(el => {
//       if(el.py > scrollY+innerHeight || el.py + el.height < scrollY) return

//       const target = el.el

//       const translate = getComputedStyle(target)['translate'].split(' ')
//       if(translate.length < 4) translate.push('0px')
//       let translateY = translate.slice(translate.length-1, translate.length).join(' ')
//       let translateX = translate.join(' ').replace(translateY, '')

//       let factor = -3

//       if(scrollUp) factor *= -1
//       translateY = parseFloat(translateY) + factor

//       target.style.translate = `${translateX} ${translateY}px`
//     })
//   })
// }


// --------------
// const sections = document.querySelectorAll('section')
// const sectionsArr = []

// const maxRotateX = 35;

// addEventListener('scroll', parallaxFunciton)
// parallaxFunciton()

// console.dir(window)
// addEventListener('click', () => {
//   window.scrollY += 100
// })

// function parallaxFunciton(){
//   let pageMid = scrollY + innerHeight / 2
//   sections.forEach(section => {
//     let sectionMid = (section.offsetTop + section.clientHeight / 2)
//     let dif = pageMid - sectionMid

//     console.log(dif)
//   })
// }