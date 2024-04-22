<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
</head>
<body>
    <h2>Calculadora PHP</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="num1" placeholder="Digite o primeiro número" required>
        <select name="operator">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="text" name="num2" placeholder="Digite o segundo número" required>
        <button type="submit" name="submit">Calcular</button>
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
</html>

