async function loadProducts(){
    try{
        let response = await fetch("produtos.php");
        if(!response.ok){
            throw new Error(response.statusText);
        }
        var products = await response.json();
    }
    catch(e){
        console.error(e);
        return;
    }
}

window.onload = function(){
    loadProducts();
}