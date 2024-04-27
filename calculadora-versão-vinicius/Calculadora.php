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

    $num1 = $_POST['num1'];
    $operador = $_POST['operador'];
    $num2 = $_POST['num2'];

    if(isset($_POST['num1']) && isset($_POST['operador']) && isset($_POST['num2'])){
        switch($operador) {
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
                $inicial1 = 1;
                $inicial2 = 1;
                for ($i = 1; $i <= $num1; $i++) {
                    $inicial1 *= $i;
                }
                for ($i = 1; $i <= $num2; $i++) {
                    $inicial2 *= $i;
                }

                $_SESSION['resultadoAtual'] = "n! do 1° número é $inicial1 e do 2° número é $inicial2";
                break;
            case "potencia":
                $result = pow($num1,$num2);
                $_SESSION['resultadoAtual'] = "$num1 ^ $num2 = $result";
                break;
            default:
            $_SESSION['resultadoAtual'] = "Operador comido";
        }
    }
    
    ?>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <div>
                <h1>Calculadora PHP</h1>
            </div>
            <label for="num1">Número 1</label>
            <input type="number" name="num1" id="num1">

            <select name="operador">
                <option value=""></option>
                <option value="adicao">Adição (+)</option>
                <option value="subtracao">Subtração (-)</option>
                <option value="multiplicacao">Multiplicação (*)</option>
                <option value="divisao">Divisão (/)</option>
                <option value="fatorial">Fatorial (n!)</option>
                <option value="potencia">Potência (^)</option>
            </select>

            <label for="num2">Número 2</label>
            <input type="number" name="num2" id="num2"><br><br>

            <button type="submit">Calcular</button><br><br>
            
            <input type="text" name="resultadoAtual" id="resultadoAtual" style="width: 100%;"
                value="<?php 
                    echo isset($_SESSION['resultadoAtual']) ? $_SESSION['resultadoAtual'] : '';
                    if(!empty($_SESSION['salvar'])){
                        echo $_SESSION['resultadoAtual'] = '';
                    }
                ?>"><br><br>
                
        </fieldset>
    </form>
    <form action="" method="post">
        <button type="submit" name="salvar">Salvar</button><br><br>
        <button type="submit" name="pegar_valores">Pegar Valores</button>
        <button type="submit" name="apagar_historico" value="true">Apagar histórico</button>
        <ul style="list-style-type: none; padding: 0;">
            <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['resultados'])) {
                    if(isset($_POST['pegar_valores']) && $_POST['pegar_valores'] == 'true' && !empty($_SESSION['resultados'])){
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
</form>



</body>

</html>