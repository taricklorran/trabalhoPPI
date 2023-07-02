document.addEventListener('DOMContentLoaded', function() {

    const botao = document.querySelector("aside>button");
    const div = document.querySelector("aside>div");
    botao.onclick = () => div.style.visibility = 'visible';

});
