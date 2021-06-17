<?php
require("../../config.php");
require("FNC/fnc_user.php");
require("FNC/fnc_common.php");

$firstname = "";
$lastname = "";
$email = "";

$firstnameerror = "";
$lastnameerror = "";
$emailerror = "";
$passworderror = "";
$passwordsecondaryerror = "";

$notice = "";

if (isset($_POST["usersubmit"])) {

    if (empty($_POST["firstnameinput"])) {
        $firstnameerror .= "Eesnimi sisestamata!";
    } else {
        $firstname = test_input($_POST["firstnameinput"]);
    }

    if (empty($_POST["lastnameinput"])) {
        $lastnameerror .= "Perekonnanimi sisestamata!";
    } else {
        $lastname = test_input($_POST["lastnameinput"]);
    }

    if (empty($_POST["emailinput"])) {
        $emailerror .= "E-mail sisestamata!";
    } else {
        $email = test_input($_POST["emailinput"]);
    }
}
if (empty($_POST["passwordinput"])) {
    $passworderror .= "Parool sisestamata!";
} else {
    if (strlen($_POST["passwordinput"]) < 8) {
        $passworderror .= " Parool liiga lühike!";
    }
}
if (empty($_POST["passwordsecondaryinput"])) {
    $passwordsecondaryerror .= "Teine parool sisestamata!";
} else {
    if ($_POST["passwordsecondaryinput"] != $_POST["passwordinput"]) {
        $passwordsecondaryerror .= "Sisestatud salasõnad ei klapi!";
    }

    if (empty($firstnameerror) and empty($lastnameerror) and empty($emailerror) and empty($passworderror) and empty($confirmpassworderror)) {
        $result = signup($firstname, $lastname, $email, $_POST["passwordinput"]);
        //$notice = "Kõik korras!";
        if ($result == "ok") {
            $firstname = "";
            $lastname = "";
            $email = "";
            $notice = "Kasutaja loomine õnnestus!";
        } else {
            $notice = "Kahjuks tekkis tehniline viga:" . $result;
        }
    }
}


?>
<!DOCTYPE html>
<html lang="et">

<head>
    <title>New User</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="Styles/style.css">
</head>

<body>
        <main id="main-holder">
            <div class="head-photo">
                <img src="media/head-logo.png" alt="head-logo">
            </div>
            <h2 id="login-header">Loo uus kasutaja!</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="firstnameinput" id="firstnameinput" class="login-form-field" placeholder="Nimi:" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
                <br>
                <input type="text" name="lastnameinput" id="lastnameinput" class="login-form-field" placeholder="Perekonnanimi:" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
                <br>
                <input type="email" name="emailinput" id="emailinput" class="login-form-field" placeholder="E-mail:" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
                <br>
                <input type="password" name="passwordinput" id="passwordinput" class="login-form-field" placeholder="Parool(8 märki):">
                <br>
                <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" class="login-form-field" placeholder="Parooli kinnitus:">
                <br>
                <input type="submit" name="usersubmit" value="Loo kasutajakonto" id="login-form-submit">
                <br>
                <a href="Login.php">Tagasi!</a>
            </form>
            <div class="head-photo">
                <img src="media/TLU_logo.jpg" alt="footer-logo">
            </div>
        </main>
</body>

</html>