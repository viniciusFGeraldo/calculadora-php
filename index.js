var operador = document.querySelector("#operador");
var num2 = document.querySelector("#num2");
var labelNum2 = document.querySelector("#labelnum2");

if(operador.value == "fatorial"){
    num2.value = '';
    num2.style.display = "none";
    
}else{
    num2.style.display = "block";
}

operador.addEventListener("change", function(){
    if(operador.value == "fatorial"){ 
        num2.value = '';
        num2.style.display = "none";
        
    }else{
        num2.style.display = "block";
    }

    if(operador.value == "potencia"){
        labelNum2.textContent = 'Potência';
    }else{
        labelNum2.textContent = 'Número 2';
    }
});