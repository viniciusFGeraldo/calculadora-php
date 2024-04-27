<?php
    session_start();
    $sair = true;

    if (!isset($_SESSION['resultados'])) {
        $_SESSION['resultados'] = array();
    }else
        if (isset($_POST['pegar_valores']) && !empty($_SESSION['resultados'])) {
        end($_SESSION['resultados']);
        $_SESSION['resultadoPegado'] = current($_SESSION['resultados']);
    }else
        if (isset($_POST['apagar_historico'])) {
        $_SESSION['resultados'] = array();
    } else if(isset($_POST['memoria'])){
        if(!isset($_SESSION['clique']) || $_SESSION['clique'] == 1){
            if(isset($_SESSION['resultadoPegado']) && $_SESSION['resultadoPegado'] != ""){
                $_SESSION['memoria'] = $_SESSION['resultadoPegado'];
            }else{
                
                $_SESSION['memoria'] = isset($_SESSION['resultado']) ? $_SESSION['resultado'] : '';
            }  

            $_SESSION['clique'] = 2;
        }else{
            $_SESSION['clique'] = 1;
            $_SESSION['resultado'] = "";
            $_SESSION['resultadoPegado'] = "";
            header("Location: ./Calculadora.php?visualizarMemoria=true");
            $sair = false;
        }
        
    }else {
        if (isset($_POST['salvar'])) {
            if($_SESSION['resultado'] != ''){
                array_push($_SESSION['resultados'], $_SESSION['resultado']);
                $_SESSION['resultado'] = '';
            }else if(isset($_SESSION['resultadoPegado'])){
                array_push($_SESSION['resultados'], $_SESSION['resultadoPegado']);
                $_SESSION['resultadoPegado'] = '';
            }
        }
    }

    if($sair){
        header("Location: ./Calculadora.php");
    }
    
    
?>