// landingAnimation()

// function landingAnimation(){
//   const arr = []
//   const elements = document.querySelectorAll('.promise-load')
//   Array.from(elements).forEach(el => {
//     arr[arr.length] = {
//       el,
//       py: el.offsetTop,
//       height: el.clientHeight,
//       showed: false
//     }
//   })

//   const elementAnimation = (el) => {
//     if(el.showed || (el.py > scrollY+innerHeight || el.py + el.height < scrollY)) return

//     el.el.classList.add('loading-animation')
//     el.showed = true
//   }

//   arr.forEach(el => {
//     elementAnimation(el)
//   })

//   addEventListener('scroll', () => {
//     arr.forEach(el => {
//       elementAnimation(el)
//     })
//   })
// }