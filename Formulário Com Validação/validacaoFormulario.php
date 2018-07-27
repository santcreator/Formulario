<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulários PHP 5 - Valide E-mail e URL</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

    <?php
        $nameErr = $emailErr = $genderErr = $websiteErr = "";
        $name = $email = $gender = $comment = $website = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Seu nome por favor";
            } else {
                $name = test_input($_POST["name"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Apenas Letras são permetidas";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Seu email por favor";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Email invalido";
                }
            }

            if (empty($_POST["website"])) {
                $website = "";
            } else {
                $website = test_input($_POST["website"]);
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/¨=~_|]/i",$website)) {
                    $websiteErr = "URL Invalido";
                }
            }

            if (empty($_POST["comment"])) {
                $comment = "";
            } else {
                $comment = test_input($_POST["comment"]);
            }

            if (empty($_POST["gender"])) {
                $genderErr = "Gender is resquired";
            } else {
                $gender = test_input($_POST["gender"]);
            }
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <fieldset>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name" id="name">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            E-mail: <input type="email" name="email" id="email">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            Website: <input type="text" name="website" id="website">
            <span class="error"><?php echo $websiteErr;?></span>
            <br><br>
            Comment: <textarea name="comment" id="comment" cols="40" rows="5"></textarea>
            <br><br>
            Gender:
            <input type="radio" name="gender" id="gender" value="female">Female
            <input type="radio" name="gender" id="gender" value="male">Male
            <input type="radio" name="gender" id="gender" value="other">Other
            <span class="error">* <?php echo $genderErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <?php
        echo "<h1>Seus dados são:</h1>";
        echo $name;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $website;
        echo "<br>";
        echo $comment;
        echo "<br>";
        echo $gender;
    ?>
</body>
</html>
