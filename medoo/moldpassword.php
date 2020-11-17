<?php
session_start();
include_once("testmedoo.php");




$reinitPassword = isset($_POST['passwordConfirm']);
$reinitPassword1 = isset($_POST['passwordConfirm1']);

if (isset($_POST['Envoyer1'])) {

    if ($reinitPassword = $reinitPassword1) {
        $options = ['cost' => 12,];
        $condMDP = '/^(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)/';
        $reinitPasswordCrypt = password_hash($_POST['passwordConfirm'], PASSWORD_BCRYPT, $options);
       

        $verifEmail = $database->select("recuperations", "email", ["code" => $_GET["section"]]);
       var_dump($verifEmail) ;
        /*if ($verifEmail === true) {
            
            $database->delete("recuperations", ["AND" => ["code" => $codeReinit]]);
            
            echo "mot de passe reinitialisé";
        }else{echo"pas bon";}*/
        
    } else {
        echo "mot de passe passe n'est pas bon!";
    }
} else {
    echo "remplissez les cases!";
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mnewpassword.php</title>
</head>

<body>
    <form action="mnewpassword.php" method="post">
        <p><label for="">Entrez votre nouveau mot de passe : <input type="text" name="passwordConfirm" id=""></p>
        <p><label for="">Confirmez votre mot de passe : <input type="text" name="passwordConfirm1" id=""></p>
        <input type="submit" value="Envoyer" name="Envoyer1">
    </form>
</body>

</html>