<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        session_start();

        if (!isset($_SESSION['resultados'])) {
            $_SESSION['resultados'] = array();
        }

        if (isset($_GET['num1']) && isset($_GET['operador']) && isset($_GET['num2'])) {

            $num1 = $_GET['num1'];
            $operador = $_GET['operador'];
            $num2 = $_GET['num2'];

            if((($num1 != "") && ($num2 != "")) || (($num1 != "") && ($operador == "fatorial"))){
                switch ($operador) {
                    case "adicao":
                        $result = $num1 + $num2;
                        $_SESSION['resultadoAtual'] = "$num1 + $num2 = $result";
                        break;
    
                    case "subtracao":
                        $result = $num1 - $num2;
                        $_SESSION['resultadoAtual'] = "$num1 - $num2 = $result";
                        break;
    
                    case "multiplicacao":
                        $result = $num1 * $num2;
                        $_SESSION['resultadoAtual'] = "$num1 * $num2 = $result";
                        break;
    
                    case "divisao":
                        if ($num2 != 0) {
                            $result = $num1 / $num2;
                            $_SESSION['resultadoAtual'] = "$num1 / $num2 = $result";
                        } else {
                            $_SESSION['resultadoAtual'] = "Erro: Divisão por zero!";
                        }
                        break;
    
                    case "fatorial":
                        $result = 1;

                        for ($i = 1; $i <= $num1; $i++) {
                            $result *= $i;
                        }
    
                        $_SESSION['resultadoAtual'] = "$num1! é $result ";
                        break;
    
                    case "potencia":
                        $result = pow($num1, $num2);
                        $_SESSION['resultadoAtual'] = "$num1 ^ $num2 = $result";
                        break;
    
                    default:
                        $_SESSION['resultadoAtual'] = "Operador invalido";
                }
            }else{
                $_SESSION['resultadoAtual'] = "Preencha todos os campos";
            }   
            
        }else{
            $_SESSION['resultadoAtual'] = "";
        }

    ?>
</head>

<body>
    <form action="" method="get">
        <fieldset>
            <legend>
                <h1>Calculadora PHP</h1>
            </legend>
            <div style="display:flex; ">
                <label for="num1">Número 1</label>
                <input type="number" name="num1" id="num1">

                <select name="operador" id="operador" style="margin-left: 5px;">
                    <option value=""></option>
                    <option value="adicao">Adição (+)</option>
                    <option value="subtracao">Subtração (-)</option>
                    <option value="multiplicacao">Multiplicação (*)</option>
                    <option value="divisao">Divisão (/)</option>
                    <option value="fatorial">Fatorial (n!)</option>
                    <option value="potencia">Potência (^)</option>
                </select>

                <div id="num2" style="margin-left: 5px;">
                    <label for="num2" id="labelnum2">Número 2</label>
                    <input type="number" name="num2" id="num2">
                </div>

            </div>

            <br><br>

            <button type="submit">Calcular</button><br><br>
            

            <input type="text" name="resultadoAtual" id="resultadoAtual" style="width: 100%;" value=
            "<?php
                    echo isset($_SESSION['resultadoAtual']) ? $_SESSION['resultadoAtual'] : '';
                
            ?>"><br><br>

            

        </fieldset>
    </form>

    <form action="" method="post">

        <fieldset>
            <button type="submit" name="salvar">Salvar</button><br><br>
            <button type="submit" name="pegar_valores">Pegar Valores</button>
            <button type="submit" name="apagar_historico" value="true">Apagar histórico</button>

        </fieldset>

    </form>

    <ul style="list-style-type: none; padding: 0;">
        <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['resultados'])) {
                if (isset($_POST['pegar_valores']) && $_POST['pegar_valores'] == 'true' && !empty($_SESSION['resultados'])) {
                    end($_SESSION['resultados']);
                    echo isset($_SESSION['resultadoAtual']) ? current($_SESSION['resultados']) : '';
                }
                if (isset($_POST['apagar_historico']) && $_POST['apagar_historico'] == 'true') {
                    $_SESSION['resultados'] = array();
                } else {
                    if (isset($_POST['salvar'])) {
                        $_SESSION['resultados'][] = $_SESSION['resultadoAtual'];
                        $_SESSION['resultadoAtual'] = '';
                    }
                }
                foreach ($_SESSION['resultados'] as $valor) {
                    echo "<li>$valor</li>";
                }
            }
        ?>
    </ul>

</body>

<script src="./index.js"></script>

</html>