<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        
        session_start();

        if (isset($_GET['num1']) && isset($_GET['operador']) && isset($_GET['num2'])) {

            $num1 = $_GET['num1'];
            $operador = $_GET['operador'];
            $num2 = $_GET['num2'];

            if((($num1 != "") && ($num2 != "")) || (($num1 != "") && ($operador == "fatorial"))){
                $_SESSION['resultadoPegado'] = "";
                $_SESSION['memoria'] = "";


                switch ($operador) {
                    case "adicao":
                        $result = $num1 + $num2;
                        $_SESSION['resultado'] = "$num1 + $num2 = $result";
                        break;
    
                    case "subtracao":
                        $result = $num1 - $num2;
                        $_SESSION['resultado'] = "$num1 - $num2 = $result";
                        break;
    
                    case "multiplicacao":
                        $result = $num1 * $num2;
                        $_SESSION['resultado'] = "$num1 * $num2 = $result";
                        break;
    
                    case "divisao":
                        if ($num2 != 0) {
                            $result = $num1 / $num2;
                            $_SESSION['resultado'] = "$num1 / $num2 = $result";
                        } else {
                            $_SESSION['resultado'] = "Erro: Divisão por zero!";
                        }
                        break;
    
                    case "fatorial":
                        $result = 1;

                        for ($i = 1; $i <= $num1; $i++) {
                            $result *= $i;
                        }
    
                        $_SESSION['resultado'] = "$num1 ! = $result ";
                        break;
    
                    case "potencia":
                        $result = pow($num1, $num2);
                        $_SESSION['resultado'] = "$num1 ^ $num2 = $result";
                        break;
    
                    default:
                    $_SESSION['resultado'] = "Operador invalido";
                }
            }else{
                $_SESSION['resultado'] = "Preencha todos os campos";
            }   
            
        }else{
            $_SESSION['resultado'] = "";
        }

    ?>
</head>

<body class="bg-dark">
    <main class="m-3">
        <form action="" method="get" >
            <fieldset>
                <legend class="bg-white rounded ps-3">
                    <h1 class="fs-3">Calculadora PHP</h1>
                </legend>
                <div class="d-flex flex-row">                    

                    <div class="input-group d-flex flex-row me-4">
                        <label class="input-group-text" id="basic-addon1" for="num1">Número 1</label>
                        <input type="number" name="num1" id="num1" class="form-control" placeholder="Número" aria-label="Número" aria-describedby="basic-addon1"
                        value="<?php
                            if(isset($_GET['num1'])){
                                echo $_GET['num1'];
                            }
                        ?>"
                        >
                    </div>
                    <select name="operador" id="operador"  class="form-select-sm me-4">
                        <option <?php
                            if(!isset($_GET['operador'] ) || $_GET['operador'] == ''){
                                echo "selected";
                            }
                        ?>>Operação</option>

                        <option value="adicao" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'adicao'){
                                    echo "selected";
                                }
                        ?>>Adição (+)</option>

                        <option value="subtracao" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'subtracao'){
                                    echo "selected";
                                }
                        ?>>Subtração (-)</option>

                        <option value="multiplicacao" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'multiplicacao'){
                                    echo "selected";
                                }
                        ?>>Multiplicação (*)</option>

                        <option value="divisao" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'divisao'){
                                    echo "selected";
                                }
                        ?>>Divisão (/)</option>

                        <option value="fatorial" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'fatorial'){
                                    echo "selected";
                                }
                        ?>>Fatorial (n!)</option>

                        <option value="potencia" <?php
                                if(isset($_GET['operador'] ) && $_GET['operador'] == 'potencia'){
                                    echo "selected";
                                }
                        ?>>Potência (^)</option>
                    </select>

                    <div class="input-group d-flex flex-row" id="divNum2">
                        <label class="input-group-text" id="labelnum2" for="num2">Número 2</label>
                        <input type="number" name="num2" id="num2" class="form-control" placeholder="Número" aria-label="Número" aria-describedby="basic-addon1"
                        value="<?php
                            if(isset($_GET['num2'])){
                                echo $_GET['num2'];
                            }
                        ?>"
                        >
                    </div>

                </div>

                <button type="submit" class="btn btn-outline-success mt-2 mb-3">Calcular</button>
            </fieldset>

            <fieldset disabled>
                <div class="input-group flex-nowrap mb-3" >
                    <label class="input-group-text" id="addon-wrapping" for="disabledTextInput">Resultado</label>
                    <input type="text" class="form-control" placeholder="Resultado" aria-label="Resultado" aria-describedby="addon-wrapping" id="disabledTextInput"
                        value="<?php
                            if(isset($_SESSION['resultadoPegado']) && $_SESSION['resultadoPegado'] != ""){
                                echo $_SESSION['resultadoPegado'];
                            }else if(isset($_GET['visualizarMemoria']) && ($_GET['visualizarMemoria']) != ""){
                                echo $_SESSION['memoria'];
                            }else{
                                    echo isset($_SESSION['resultado']) ? $_SESSION['resultado'] : '';
                            }
                        ?>"
                    >
                </div>
            </fieldset>
        </form>

        <form action="./dados.php" method="post">

            <fieldset>
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="submit" name="salvar" class="btn btn-outline-warning">Salvar</button>
                    <button type="submit" name="pegar_valores" class="btn btn-outline-secondary">Pegar Valores</button>
                    <button type="submit" name="memoria" class="btn btn-outline-primary">M</button>
                    <button type="submit" name="apagar_historico" class="btn btn-outline-danger">Apagar histórico</button>
                </div>
            </fieldset>

        </form>

        <h2 class="bg-white rounded ps-3 mt-3 fs-3">Histórico</h2>

        <ul  class="bg-white rounded ps-3 mt-3 list-group">
            <?php
                if (!isset($_SESSION['resultados'])) {
                    $_SESSION['resultados'] = array();
                }

                foreach ($_SESSION['resultados'] as $valor) {
                    echo "<li class='list-group-item'>$valor</li>";
                }
            ?>
        </ul>
    </main>
</body>

<script src="./index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>