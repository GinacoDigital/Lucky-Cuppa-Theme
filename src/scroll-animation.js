addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('header, section')
  const arrSections = []
  let possibleChange = true

  sections.forEach(section => {
    if(section.id == '') return

    arrSections.push({id: section.id})
  })
  
  let actSection = 0
  if(sessionStorage.getItem('actSection') != null) actSection = sessionStorage.getItem('actSection')
  sessionStorage.setItem('actSection', actSection)

  const path = location.origin + location.pathname
  location.href = `${path}#${arrSections[actSection].id}`

  let lastScrollTop = scrollY
  let scrollUp = false

  addEventListener('mousewheel', (e) => {
    e.wheelDeltaY > 0 ? scrollUp = true : scrollUp = false

    changeSection({
      isScrollUp: scrollUp
    })
  })

  function checkScrollingInterval(){
    lastScrollTop > scrollY ? scrollUp = true : scrollUp = false

    if(lastScrollTop == scrollY){
      possibleChange = true
      clearInterval(scrollingInterval)
      return
    }
    lastScrollTop = scrollY
  }

  const keys = {
    up: false,
    down: false
  }
  addEventListener('keydown', (e) => {
    switch(e.key){
      case 'w':
      case 'ArrowUp':
        if(keys.up) break

        keys.up = true
        changeSection({
          isScrollUp: true
        })

        break
      case 's':
      case 'ArrowDown':
        if(keys.down) break

        keys.down = true
        changeSection({
          isScrollUp: false
        })

        break
    }
  })

  addEventListener('keyup', (e) => {
    switch(e.key){
      case 'w':
        keys.up = false
        break
      case 's':
        keys.down = false
        break
    }
  })

  let scrollingInterval
  function changeSection({isScrollUp}){
    if(!possibleChange) return
    possibleChange = false

    if(isScrollUp) actSection--
    else actSection++

    if(!isScrollUp && actSection == 1) actSection++

    if(actSection <= -1) actSection = 0
    else if(actSection >= arrSections.length) actSection = arrSections.length - 1
    sessionStorage.setItem('actSection', actSection)

    const el = document.getElementById(arrSections[actSection].id)

    location.href = `${path}#${arrSections[actSection].id}`

    scrollingInterval = setInterval(checkScrollingInterval, 50)
    
    scrollAnimation(el, `${arrSections[actSection].id}-animation`)

    return false
  }

  function scrollAnimation(el, className){
    el.classList.add(className)
    // setTimeout(() => {
    //   el.classList.remove(className)
    // }, 1000)
  }
})