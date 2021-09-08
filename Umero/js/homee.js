window.addEventListener('scroll', () => {
    const navH2 = document.querySelector('h2')
    const span = document.querySelector('span')
    navH2.style.marginLeft = 0.5 * window.scrollY + 'px'
    span.style.marginRight = 0.5 * window.scrollY + 'px'
})
function verificResponse() { 
    const form = document.getElementById('form')
    const btnTry = document.getElementById('btntry')
    const btnEnviar = document.getElementById('btnenviar')
    const response = document.querySelector('.verific')
    const resCorrect = document.querySelector('.resCorrect')
    const responseUser = document.querySelector('.value_resposta').value
    const responseCorrect = document.querySelector('.resposta').value
     if(responseUser === responseCorrect) {
         response.innerHTML = `<p style='color: #28a745'>Resposta correta</p>`
         btnEnviar.style.display = 'none'
         form.style.display = 'block'
         resCorrect.innerHTML = `Resposta correta: ${responseCorrect}`
    }else {
         response.innerHTML = `<p style='color: #dc3545'>Resposta Errada</p>`
         btnTry.style.display = 'block' 
         btnEnviar.style.display = 'none'            
    }
 }
 function retry() {
     document.getElementById('btntry').style.display = 'none'
     document.getElementById('btnenviar').style.display = 'block'
     const responseUser = document.querySelector('.value_resposta')
     responseUser.focus()
     responseUser.value = ''
 }
 function setEffectIconTada() {
     const bx_icon = document.querySelector('.bx-icon')
     bx_icon.setAttribute('animation','tada')
     bx_icon.addEventListener('mouseout', () => {
         bx_icon.setAttribute('animation','')
     })
 }