function decodeHTMLEntity(symbol){
  const el = document.createElement('div')

  if(symbol && typeof symbol == 'string'){
    el.innerHTML = symbol
    symbol = el.textContent
    el.textContent = ''
  }
  
  return symbol
}