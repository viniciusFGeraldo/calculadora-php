var operador = document.querySelector("#operador");
var inputNum2 = document.querySelector("#num2");
var labelNum2 = document.querySelector("#labelnum2");

if(operador.value == "fatorial"){
    inputNum2.value = '';
    labelNum2.style.visibility = "hidden";
    inputNum2.style.visibility = "hidden";
    
}else{
    labelNum2.style.visibility = "";
    inputNum2.style.visibility = "";
}

if(operador.value == "potencia"){
    labelNum2.textContent = 'Potência';
}else{
    labelNum2.textContent = 'Número 2';
}

operador.addEventListener("change", function(){
    if(operador.value == "fatorial"){ 
        inputNum2.value = '';
        labelNum2.style.visibility = "hidden";
        inputNum2.style.visibility = "hidden";
        
    }else{
        labelNum2.style.visibility = "";
        inputNum2.style.visibility = "";
    }

    if(operador.value == "potencia"){
        labelNum2.textContent = 'Potência';
    }else{
        labelNum2.textContent = 'Número 2';
    }
});