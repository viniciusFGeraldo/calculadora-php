<?php
    session_start();
    $sair = true;

    if (!isset($_SESSION['resultados'])) {
        $_SESSION['resultados'] = array();
    }else if (isset($_POST['pegar_valores']) && !empty($_SESSION['resultados'])) {
        $sair = false;

        end($_SESSION['resultados']);
        $resultado = explode(" ", current($_SESSION['resultados']));

        retornarValor($_SESSION['resultados'], "pegar", $resultado);
    }else if (isset($_POST['apagar_historico'])) {
        $_SESSION['resultados'] = array();
    } else if(isset($_POST['memoria'])){
        if(!isset($_SESSION['clique']) || $_SESSION['clique'] == 1){
            if(isset($_SESSION['resultadoPegado']) && $_SESSION['resultadoPegado'] != ""){
                $_SESSION['memoria'] = isset($_SESSION['resultadoPegado']) ? $_SESSION['resultadoPegado'] : '';
            }else{                
                $_SESSION['memoria'] = isset($_SESSION['resultado']) ? $_SESSION['resultado'] : '';
            }  

            $_SESSION['clique'] = 2;
        }else{
            $_SESSION['clique'] = 1;
            $_SESSION['resultado'] = "";
            $_SESSION['resultadoPegado'] = "";

            retornarValor($_SESSION['memoria'], "memoria", "");
            $sair = false;
        }
        
    }else {
        if (isset($_POST['salvar'])) {

            echo $_SESSION['resultado'] == "";
            if(isset($_SESSION['resultado']) && $_SESSION['resultado'] != "Preencha todos os campos" && $_SESSION['resultado'] != "Operador invalido" && $_SESSION['resultado'] != ""){
                array_push($_SESSION['resultados'], $_SESSION['resultado']);
                $_SESSION['resultado'] = '';
            }else if(isset($_SESSION['resultadoPegado']) && $_SESSION['resultadoPegado'] != ""){
                array_push($_SESSION['resultados'], $_SESSION['resultadoPegado']);
                $_SESSION['resultadoPegado'] = '';
            }
        }
    }

    if($sair){
        header("Location: ./Calculadora.php");
    }




    function retornarValor($variavel, $tipo, $resultado){

        if($tipo == "memoria"){
            $resultado = explode(" ", $variavel);
        }

        var_dump(current($_SESSION['resultados']));
        
        $operador = "";

        switch ($resultado[1]) {
            case "+":
                $operador = "adicao";
                
                break;

            case "-":
                $operador = "subtracao";
                break;

            case "*":
                $operador = "multiplicacao";
                break;

            case "/":
                $operador = "divisao";
                break;

            case "!":
                $operador = "fatorial";
                break;

            case "^":
                $operador = "potencia";
                break;

            default:
                $operador = "";
                break;
        }

        if($variavel == "Preencha todos os campos" || $variavel == "Operador invalido" || $variavel == ""){
            header("Location: ./Calculadora.php");
        }else{
            header("Location: ./Calculadora.php?num1=$resultado[0]&operador=$operador&num2=$resultado[2]");
        }

    }
    
    
?>