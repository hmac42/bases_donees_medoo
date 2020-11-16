<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mlogin.php</title>
</head>

<body>


    <?php
    session_start();
    include_once("testmedoo.php");




    if (isset($_POST["envoyer"])) {
        $login = $_POST["login"];
        $password = $_POST["Password"];
        $date = date("d-m-y H:i");
        if (!empty($_POST["Login"]) || !empty($_POST["Password"])) {
            $verifEmail = $database->count("utilisateurs", "email", ["email" => $login]);

            if ($verifEmail = 1) {
                $user = $database->select("utilisateurs", ["email" => $login]);
                $hash = $user["motDePasse"];

                if (password_verify($password, $hash)) {
                    $database->insert(
                        "connexions",
                        [
                            "login" => $login,
                            "motDePasse" => $password,
                            "date" => $date
                        ]
                    );
                    header("location: mhome.php");
                    $_SESSION['login'] = $login;
                    echo "connecte";
                    //echo $user;
                // $_SESSION['id'] = $user['id'];


            } else {
                $essaieConn = "A";

                $countConn = $database->count("connexions", "login", ["login" => $login]);

                echo $countConn . "<br>";
                if ($countConn >= 4) {

                    echo "vous devez attendre 30 sec";
                    $motDePasseOublie = '<a href="mresetpassword.php">Mot de passe oublié</a>';
                } else {

                    $database->insert(
                        "connexions",
                        [
                            "login" => $login,
                            "essaieConn" => $essaieConn,
                            "date" => $date
                        ]
                    );
                    echo "Mot de passe inexistant ou pas conforme!";
                }
            }
        } else {
            echo "L'identifiant n'existe pas!";
        }
    } else {
        echo "Remplissez les cases";
    }
 }

    ?>
    <form action="mlogin.php" method="post">
        <p>Identifiant :<input type="email" name="login"></p>
        <p>Mot de passe :<input type="text" name="Password"></P>
        <input type="submit" value="Envoyer" name="envoyer">
    </form>
    <?php if (isset($motDePasseOublie)) {
        echo $motDePasseOublie;
    } ?>

</body>

</html>