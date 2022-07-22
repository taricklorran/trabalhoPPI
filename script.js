function adicionarComentario() {
    openModal();
}


function openModal() {
    // document.getElementById("backdrop").style.display = "block"
    document.getElementById("idModalComentario").style.display = "block"
    document.getElementById("idModalComentario").classList.add("show")
}
function closeModal() {
    // document.getElementById("backdrop").style.display = "none"
    document.getElementById("idModalComentario").style.display = "none"
    document.getElementById("idModalComentario").classList.remove("show")
}

function salvarComentario() {
    Swal.fire({
        title: 'Deseja salvar comentário?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Salvar',
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire('Comentário salvo com sucesso!', '', 'success')
        }
      })
      
}

