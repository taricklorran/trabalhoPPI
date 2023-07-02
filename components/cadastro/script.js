function sendForm(){
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "cadastro.php");
    xhr.onload = function(){
        if(xhr.status != 200){
            console.error("Falha inesperada: " +xhr.responseText);
            return;
        }
        
        try{
            var response = JSON.parse(xhr.responseText);
        }
        catch(e){
            console.error("String JSON inválido: " +xhr.responseText);
            return;
        }

        if(response.success){
            window.location = response.detail;
        }
        else{
            document.querySelector("#failMsg").style.display = 'block';
            document.querySelector("#failMsg").textContent = response.detail;
        }
    }
    xhr.onerror = function(){
        console.error("Erro de rede - requisição não finalizada.")
    };

    const form = document.querySelector("#formCadastro");
    xhr.send(new FormData(form));
    
}

window.onload = function () {
    preencherDropDownCategoria();
    const btnCadastro = document.querySelector("#btnCadastro");
    btnCadastro.onclick = sendForm;
  }


  function buscaEndereco() {
    let cep = document.querySelector("#cep").value;

    if (cep.length != 9) return;      
    let form = document.querySelector("form");
    
    fetch("busca-endereco.php?cep=" + cep)
      .then(response => {
        if (!response.ok) {
          throw new Error(response.status);
        }

        return response.json();
      })
      .then(endereco => {
        form.rua.value = endereco.rua;
        form.bairro.value = endereco.bairro;
        form.cidade.value = endereco.cidade;
      })
      .catch(error => {

        form.reset();
        console.error('Falha inesperada: ' + error);
      });
  }

  function preencherDropDownCategoria(){
    // povoa dropdown de categorias    
      fetch("busca-categoria.php")
        .then(response => {
          if (!response.ok) {
            throw new Error(response.status);
          }

          return response.json();
        })
        .then(categorias => {          
          categorias.forEach((x) => {
            let option = document.createElement("option");
            option.text = x.nome;
            option.value = x.id;

            var select = document.getElementById("categoria");
            select.appendChild(option);
          });
        })
        .catch(error => {
  
          form.reset();
          console.error('Falha inesperada: ' + error);
        });
  }