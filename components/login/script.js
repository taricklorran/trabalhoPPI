function enviarForm(){
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "login.php");
    xhr.onload = function(){
        if(xhr.status != 200){
            console.error("Falha inesperada: " +xhr.responseText);
            return;
        }

        try{
            var response = JSON.parse(xhr.responseText);
        }
        catch(e){
            console.error("String JSON inválida: " +xhr.responseText);
            return;
        }

        if(response.success){
            window.location = response.detail;
        }
        else{
            document.querySelector("#loginFailMsg").style.display = 'block';
            form.senha.value = "";
            form.senha.focus();
        }
    }

    xhr.onerror = function(){
        console.error("Erro de rede - requisição não finalizada.");
    };

    const form = document.querySelector("#formLogin");
    xhr.send(new FormData(form));
}

window.onload = function(){
    const btnLogin = document.querySelector("#btnLogin");
    btnLogin.onclick = enviarForm;

}