<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator">
        <h2>calculator</h2>
        <form action="<?php echo htmlspecialchars( $_SERVER["PHP_SELF"])?>" method="post">
            <input type="number" name="num01" placeholder="first number">
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="mutiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num02" placeholder="second number">
            <button>Calculate</button>
        </form>

        <?php
        // Grab data from input
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num01=filter_input(INPUT_POST,"num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num02=filter_input(INPUT_POST,"num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator=htmlspecialchars($_POST["operator"]);
       
        // error handlers
        $error=false;

        if(empty($num01) || empty($num02) || empty($operator)){
            echo "<p class='error'>Fill in all fields!</p>";
            $error=true;

        }
        
        if(!is_numeric($num01)|| !is_numeric($num02)){
            echo "<p class='error'>only write numbers!</p>";
            $error=true;
        }

        // calculate the numbers if no errors
        if(!$error){
            $value=0;
            switch ($operator) {
                case 'add':
                    $value=$num01 + $num02;
                    break;
               case 'subtract':
                    $value=$num01 - $num02;
                    break;
                case 'mutiply':
                    $value=$num01 * $num02;
                     break;
                     
                case 'divide':
                    if ($num02 != 0) {
                        $value = $num01 / $num02;
                    } else {
                        echo "<p class='error'>Cannot divide by zero!</p>";
                        $error = true;
                    }
                     break;

                default:
                echo "<p class='error'>sorry, something went wrong. please try again!</p>";
                $error = true;
                    break;
            }
            echo "<h3 class='result'>Result =" ." ". $value . "</h3>";
        }
    }
        ?>
    </div>
</body>
</html>