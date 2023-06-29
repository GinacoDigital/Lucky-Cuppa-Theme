function createElement(parent, tag, className){
  if(!parent || !tag) return
  
  const el = document.createElement(tag)
  if(className) el.classList.add(className)
  
  parent.appendChild(el)
}