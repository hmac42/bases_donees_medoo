<?php
session_start();
include_once("testmedoo.php");


if (isset($_POST['Envoyer'])) {
   
    if (!empty($_POST['codeReinit'])) {
        $codeReinit = $_POST['codeReinit'];
        $codeVerif = $database->count("recuperations", "code", ["code" => $codeReinit]);
        if ($codeVerif = 1) {
           
            header("location: mnewpassword.php");
        } else {
            echo "code pas bon";
        }
    } else {
        echo "entrez le code";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="mcodenewpassword.php" method="post">
        <label for="">Entrez le code de reinitialisation : <input type="text" name="codeReinit">
            <input type="submit" value="Envoyer" name="Envoyer">
        </label>
    </form>
</body>

</html>