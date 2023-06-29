function createCloneElement(el, target){
  if(!el || !target) return
  
  const clone = el.cloneNode(true)

  el.remove()
  target.appendChild(clone)
}