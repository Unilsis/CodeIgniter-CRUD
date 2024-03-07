
function modal_show() {
  setTimeout(() => {
    var md = document.querySelectorAll('.md');
    var modals = []

    // Ao iniciar o windows ele pega todas as modals
    for (let i = 0; i < md.length; i++) {
      if (md[i].dataset.toggle === 'modals') {
        modals.push(document.getElementById(md[i].dataset.target.split('#')[1]))
      }
    }

    // Quando o usuário clicar no botão, vai abrir a modal
    for (let i = 0; i < md.length; i++) {
      md[i].onclick = function () {
        modals[i].style.display = "block";
      }
    }

    // Quando o usuário clicar no botão <span> (x), vai fechar a modal
    for (let i = 0; i < modals.length; i++) {
      var close = modals[i].getElementsByClassName('md-close')
      for (let j = 0; j < close.length; j++) {
        close[j].onclick = function () {
          modals[i].style.display = "none";
        }
      }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = (ev) => {
      for (let i = 0; i < modals.length; i++) {
        if (ev.target === modals[i]) {
          if (modals[i].getAttribute('class').indexOf('modal-static') >= 0) {
          } else {
            modals[i].style.display = "none";
          }
        }
      }
    }
  }, 1000);
}

window.onload = (e)=>{
  modal_show()
}