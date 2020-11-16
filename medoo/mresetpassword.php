<?php
session_start();
include_once("testmedoo.php");




if (isset($_POST['Envoyer'])) {
    $emailConfirm = $_POST['emailConfirm'];
    if (!empty($emailConfirm)) {

        $verifEmail = $database->select("connexions", "login", [
            "login" => $emailConfirm,
            "essaieconn" => 'A'
        ]);


        if ($verifEmail) {
            $_SESSION['emailConfirm'] = $emailConfirm;
            $recup_code = "";
            for ($i = 0; $i < 8; $i++) {
                $recup_code .= mt_rand(0, 9);
            }
            $_SESSION['recup-code'] = $recup_code;
            $email_exist = $database->count("recuperations", "email", ["email" => $emailConfirm]);

            if ($email_exist = 1) {
                $database->update("recuperations", [
                    "email" => $emailConfirm,
                    "code" => $recup_code
                ]);
                echo "entrée dans la base de données";
            } else {
                $database->insert("recuperations", [
                    "email" => $emailConfirm,
                    "code" => $recup_code
                ]);
            }

            include 'msendemail.php';
            $to = $_POST['emailConfirm'];
            $subject = "test\r\n";
            $subject .= "MIME-Version: 1.0\r\n";
            $subject .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $body = 'votre code de recuperation est ' . $recup_code . ' test 2 <html><a href="http://localhost/medoo/mcodenewpassword.php">lien</a></html>';
            send_mail($to, $subject, $body);
            header("location: mcodenewpassword.php");




            echo "Email envoyé pour reinitialiser le mot de passe";
        } else {
            echo 'le Email ne existe pas dans la base de donées';
        }
    } else {
        $erreurEmail = "Entrez votre Email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mresetpassword.php</title>
</head>

<body>
    <h2>Réinitialiser le mot de passe</h2>
    <form action="mresetpassword.php" method="post">
        <label for="">Entrez votre E-mail : <input type="text" name="emailConfirm" id="">
            <input type="submit" value="Envoyer" name="Envoyer">
            <p><?php if (isset($erreurEmail)) {
                    echo $erreurEmail;
                } ?></p>
        </label>
    </form>
</body>

</html>