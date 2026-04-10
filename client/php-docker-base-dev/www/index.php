<?php
session_start();

function cleanString($value) : string {
    return htmlspecialchars(trim($value));
}

include_once "bdd/functions.php";

$notification = NULL;

$account = isset($_SESSION["mail"]) ? $_SESSION["mail"] : FALSE;

if (isset($_POST["origin"])){
    foreach ($_POST as $key => $value) {
        if (is_string($value)) {
            $_POST[$key] = cleanString($value);
        }
    }
    if ($_POST["origin"] == "demand") {
        $clientData = search_data("user",["id"],["email"=>$account]);
        $created = create_data("demande_client",[
            "client_id"=>$clientData["id"],
            "objet"=>$_POST["body"],
            "type_prestation"=>$_POST["prestation"],
            "creneau_souhaite"=>$_POST["time"]
        ]);

        if ($created) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $notification = "Une erreur est survenue lors de l'envois de votre demande, veillez réessayer";
        }
    } elseif ($_POST["origin"] == "signIn") {
        $connected = search_data("user",["password"],["email"=>$_POST["email"]]);

        if ($connected && $connected["password"] === $_POST["password"]) {
            $_SESSION["mail"] = $_POST["email"];
            if (isset($_POST["remember"])) {
                setcookie("email",$_POST["email"],time()+34560000);
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $notification = "Email ou mot de passe incorrects";
        }

    } elseif ($_POST["origin"] == "signUp") {
        $created = create_data("user",[
            "prenom"=>$_POST["firstName"],
            "nom"=>$_POST["lastName"],
            "email"=>$_POST["email"],
            "telephone"=>$_POST["phone"],
            "password"=>$_POST["password"],
            "roles"=>'["ROLE_CLIENT"]',
            "is_verified"=>"0"
        ]);

        if ($created) {
            $_SESSION["mail"] = $_POST["email"];
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $notification = "Une erreur est survenue lors de l'envois de votre inscription, veillez réessayer";
        }
    } elseif ($_POST["origin"] == "signOut") {
        unset($_SESSION["mail"]);
        if (isset($_COOKIE["mail"])) { unset($_COOKIE["mail"]);}
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$page = trim($requestUri, "/");
$pageExists = file_exists("pages/$page.php");
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ProConnect</title>
        <link rel="stylesheet" href="assets/css/styles.css"/>
        <link rel="stylesheet" href="assets/css/<?=$pageExists ? $page : "home"?>.css"/>
    </head>
    <body>

        <?php if ($notification) : ?>
            <div class="notification"><p><?=$notification?></p></div>
        <?php endif; ?>

        <?php include ($pageExists ? "pages/$page.php" : "pages/home.php");?>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>ProConnect</h3>
                    <p>Solutions de gestion professionnelles</p>
                </div>
                <!-- ajout d'un lien vers les conditions d'utilisation -->
                <a href="user_notice" class="footer-link">Conditions d'utilisation</a>
                <p class="footer-copyright">© 2026 ProConnect</p>
            </div>
        </footer>
    </body>
</html>