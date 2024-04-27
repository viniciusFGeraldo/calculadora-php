<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    
    <form method="get" action="">
        <legend>Calculadora PHP</legend>

        <fieldset>
            <label for="num1">Numero 1</label>
            <input type="text" name="num1" id="num1" placeholder="Digite o primeiro número" required>

            <label for="operator"></label>
            <select name="operator" id="operator">
                <option value="" ></option>
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>

            <label for="num2">Numero 2</label>
            <input type="text" name="num2" id="num2" placeholder="Digite o segundo número" required>
            <br>

            <button type="submit">Calcular</button>
        </fieldset>
    </form>

    <br> <br>

    <form action="" method="post">
        <legend>Resultado</legend>
        <fieldset>
            <input type="text" name="Expressao" id="Expressao"
            value = <?php
                $num1 = 0;
                $num2 = 0;
                $operator = "";
                $resultado = 0;
                $stringFinal = "";

                foreach ($_GET as $key => $get) {
                    switch ($key) {
                        case 'num1':
                            $num1 = $get;
                            break;

                        case 'num2':
                            $num2 = $get;
                            break;

                        case 'operator':
                            $operator = $get;
                            break;
                        
                        default:
                            break;
                    }
                }

                switch ($operator) {
                    case 'add':
                        $resultado = $num1 + $num2;
                        $operator = "+";
                        break;

                    case 'subtract':
                        $resultado = $num1 - $num2;
                        $operator = "-";
                        break;

                    case 'multiply':
                        $resultado = $num1 * $num2;
                        $operator = "*";
                        break;

                    case 'divide':
                        $resultado = $num1 / $num2;
                        $operator = "-";
                        break;
                    
                    default:
                        
                        break;
                }
                
                if($operator == ""){
                    echo "'operador invalido'";
                }else{
                    echo "'$num1 $operator $num2 = $resultado'";
                }


            ?>
            >
            <div>
                <button>Salvar</button>
                <button>Pegar Valores</button>
                <button>M</button>
                <button>Apagar Relatório</button>
            </div>

            <div>
                <h1>Histórico</h1>
                <textarea name="historico" id="historico" cols="30" rows="10"></textarea>
            </div>
            

        </fieldset>
    </form>

    

    <?php

    if(isset($_POST['submit'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operator = $_POST['operator'];

        
        if(is_numeric($num1) && is_numeric($num2)) {
            switch($operator) {
                case "add":
                    $result = $num1 + $num2;
                    break;
                case "subtract":
                    $result = $num1 - $num2;
                    break;
                case "multiply":
                    $result = $num1 * $num2;
                    break;
                case "divide":
                    if($num2 == 0) {
                        echo "Não é possível dividir por zero!";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    echo "Operador inválido!";
            }
            
            echo "<p>Resultado: $result</p>";
        } else {
            echo "Por favor, insira números válidos!";
        }
    }
    ?>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>

