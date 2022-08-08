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
    const btnCadastro = document.querySelector("#btnCadastro");
    btnCadastro.onclick = sendForm;
  }