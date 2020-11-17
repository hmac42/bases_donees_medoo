<?php
session_start();
include_once("testmedoo.php");
$codetoken = null;
$recup_code = null;

if (isset($_POST['Envoyer'])) {

    if (!empty($_POST['codeReinit']) || !empty($_POST['passwordConfirm']) || !empty($_POST['passwordConfirm1'])) {
        $codeReinit = $_POST['codeReinit'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $passwordConfirm1 = $_POST['passwordConfirm1'];

        $codeVerif = $database->count("recuperations", "code", ["code" => $codeReinit]);
        if ($codeVerif >= 1) {
            $codetoken = isset($_GET["codetoken"]);
            $recup_code = isset($_GET["recup_code"]);
            echo $recup_code."  ".$codetoken; 


            // je suis reste la, cette partie du code ne marche pas


            
            /*if ($passwordConfirm == $passwordConfirm1) {
                $options = ['cost' => 12,];
                $condMDP = '/^(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)/';
                $reinitPasswordCrypt = password_hash($_POST['passwordConfirm'], PASSWORD_BCRYPT, $options);
                $verifEmail = $database->select("recuperations", "email", ["code" =>  $recup_code]);
                    var_dump($verifEmail);
            } else {
                # code...
            }*/
        } else {
            echo "code pas bon";
        }
    } else {
        echo "les champs sont vides";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mnewpassword</title>
</head>

<body>
    <form action="mnewpassword.php?recup_code=<?= $recup_code ?>&codetoken=<?= $codetoken ?>" method="post">
        <p><label for="">Entrez le code de reinitialisation : <input type="text" name="codeReinit"></p></label>
        <p><label for="">Entrez votre nouveau mot de passe : <input type="text" name="passwordConfirm" id=""></p>
        <p><label for="">Confirmez votre mot de passe : <input type="text" name="passwordConfirm1" id=""></p>
        <p><input type="submit" value="Envoyer" name="Envoyer"></p>
    </form>
</body>

</html>