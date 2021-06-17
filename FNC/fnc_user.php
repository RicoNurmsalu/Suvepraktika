<?php
$database = "if20_pille_suvepraktika";

function signup($firstname, $lastname, $email, $password)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES(?,?,?,?)");
    echo $conn->error;
    //krüpteerime parooli
    $options = ["cost" => 12];
    $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $pwdhash);
    if ($stmt->execute()) {
        $notice = "ok";
    } else {
        $notice = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function signin($email, $password)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    echo $conn->error;
    $stmt->bind_param("s", $email);
    $stmt->bind_result($passwordfromdb);
    if ($stmt->execute()) {
        //andmepaasi päring õnnestus
        if ($stmt->fetch()) {
            if (password_verify($password, $passwordfromdb)) {
                //mis kõik teha kui saigi õige parooli, sisselogimine:
                $notice = "Olete sisseloginud!";
                $stmt->close();
                $_SESSION["userid"] = 1;
                header("Location: Mainpage.php");
                exit();
            } else {
                $notice = "Vale salasõna!";
            }
        } else {
            $notice = " Sellist kasutajat (" . $email . ") kahjuks pole!";
        }
    } else {
        $notice = "Sisselogimisel tekkis tehniline viga: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
