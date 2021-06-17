<?php
require("Session/Session.class.php");
SessionManager::sessionStart("OOP", 0, "/~anna/", "greeny.cs.tlu.ee");
require("config.php");
require("FNC/fnc_user.php");
require("FNC/fnc_common.php");

$email = "";
$password = "";

$emailerror = "";
$passworderror = "";
$notice = "";

if (isset($_POST["userdatasubmit"])) {

    if (empty($_POST["emailinput"])) {
        $emailerror .= "E-mail sisestamata!";
    } else {
        $email = test_input($_POST["emailinput"]);
    }
    if (!empty($_POST['emailinput'])) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            echo ("$email sobib!");
        } else {
            echo ("$email ei ole sobiv meiliaadress!");
        }
    }

    if (empty($_POST["passwordinput"])) {
        $passworderror .= "Parool sisestamata!";
    } else {
        if (strlen($_POST["passwordinput"]) < 8) {
            $passworderror .= " Parool liiga lühike!";
        }
    }
    if (empty($emailerror) and empty($passworderror)) {
        $result = signin($email, $_POST["passwordinput"]);
        //$notice = "Kõik korras!";
    }
}
?>
<!DOCTYPE html>
<html lang="et">

<head>
    <title>Log in page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="Styles/style.css">
</head>

<body>
        <main id="main-holder">
            <div class="head-photo">
                <img src="media/head-logo.png" alt="head-logo">
            </div>
            <h2 id="login-header">Tere tulemast!</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="emailinput" id="emailinput" class="login-form-field" placeholder="E-mail:" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
            <br>
            <input type="password" name="passwordinput" id="passwordinput" class="login-form-field" placeholder="Parool:"><span><?php echo $passworderror; ?></span>
            <br>
            <input type="submit" name="userdatasubmit" value="Logi sisse!" id="login-form-submit"><span><?php echo $notice; ?></span>
            <br>
            <a href="NewUser.php">Loo kasutaja!</a>
            </form>
            <div class="head-photo">
                <img src="media/TLU_logo.jpg" alt="footer-logo">
            </div>
        </main>
</body>

</html>