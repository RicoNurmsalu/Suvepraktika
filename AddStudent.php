<?php
require("Session/session.php");
require("FNC/fnc_AddStudent.php");
require("config.php");
require("con.php");

$inputerror = "";
$firstname = "";
$lastname = "";
$email = "";
$personal_email = "";
$message = "";
$studentnotice = null;
$studentcode = null;

$studentcode_error = null;
$firstnameerror = null;
$lastnameerror = null;
$personal_emailerror = "";
$emailerror = "";

///loeb tudengi andmed vormist
if (isset($_POST["personsubmit"])) {
    if (!empty($_POST["firstnameinput"])) {
        $firstname .= ($_POST["firstnameinput"]);
    } else {
        $firstnameerror = "Palun sisesta eesnimi!";
    }
    if (!empty($_POST["lastnameinput"])) {
        $lastname .= ($_POST["lastnameinput"]);
    } else {
        $lastnameerror = "Palun sisesta perekonnanimi!";
    }

    if (!empty($_POST["emailinput"])) {
        $email .= ($_POST["emailinput"]);
    } else {
        $emailerror = "Palun sisesta kooliemail!";
    }

    if (!empty($_POST["personal_emailinput"])) {
        $personal_email .= ($_POST["personal_emailinput"]);
    } else {
        $personal_emailerror = "Palun sisesta personaalne email!";
    }

    if (!empty($_POST["uliopilaskoodinput"])) {
        $studentcode .= ($_POST["uliopilaskoodinput"]);
    } else {
        $studentcode_error = "Sisesta üliõpilaskood";
    }

    if (empty($firstnameerror) and empty($lastnameerror) and empty($emailerror) and empty($personal_emailerror) and empty($uliopilaskooderror)) {
        $studentnotice = addNewStudent($firstname, $lastname, $email, $personal_email, $studentcode);
    }
}
//lõpp

//// loeb failist andmed andmebaasi

if (isset($_POST["filesubmit"])) {
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sql = "INSERT into student (`uliopilaskood`, `firstname`, `lastname`, `email`, `personal_email`) values('$emapData[0]','$emapData[2]','$emapData[1]','$emapData[6]','$emapData[8]')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "<script type=\"text/javascript\">
                        alert(\"Palun sisesta CSV fail.\");
                        window.location = \"AddStudent.php\"
                    </script>";
            }
        }
        fclose($file);
        echo "<script type=\"text/javascript\">
						alert(\"Andmed on edukalt üles laetud.\");
						window.location = \"AddStudent.php\"
					</script>";

        mysqli_close($con);
    }
}

//////lõpp
require("Webpiece/Htmlheader.php");
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen" href="Styles/addStudentStyle.css">'."\n";
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen and (max-width: 1070px)" href="Styles/addStudentStyleNarrow.css">'."\n";
require("Webpiece/Dropdown.php");
?>

        <div class="forms-container">
            <div class="insert-form form-item">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h2>Lisa tudeng:</h2>
                    <br>
                    <input name="firstnameinput" id="firstnameinput" type="text" placeholder="Eesnimi:" class="form-field" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
                    <br>
                    <input name="lastnameinput" id="lastnameinput" type="text" placeholder="Perekonnanimi:" class="form-field" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
                    <br>
                    <input name="emailinput" id="emailinput" type="email" placeholder="Kooli e-mail:" class="form-field" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
                    <br>
                    <input name="personal_emailinput" id="personal_emailinput" type="email" placeholder="Isiklik e-mail:" class="form-field" value="<?php echo $personal_email; ?>"><span><?php echo $personal_emailerror; ?></span>
                    <br>
                    <input name="uliopilaskoodinput" id="uliopilaskoodinput" type="text" placeholder="Üliõpilaskood:" class="form-field" value="<?php echo $studentcode; ?>"><span><?php echo $studentcode_error; ?></span>
                    <br>
                    <input name="personsubmit" type="submit" value="Salvesta" id="form-submit-form">
                    <span><?php echo $firstnameerror . " " . $lastnameerror . " " . $emailerror . " " . $personal_emailerror . " " . $studentcode_error; ?></span>
                    <p><?php echo $studentnotice; ?></p>
                </form>
                <!--<div class="vl"></div>-->
            </div>
            <div class="insert-file form-item">
                <form enctype="multipart/form-data" method="post" action="addStudent.php">
                    <h2>Lisa tudeng failist:</h2>
                    <br>
                    <div class="form-group">
                        <label for="form-choose">Vali fail</label>
                        <input name="file" type="file" class="form-control" id="form-choose">
                    </div>
                    <div class="form-group">
                        <?php echo $message; ?>
                    </div>
                    <br>
                    <input type="submit" name="filesubmit" class="btn btn-primary" id="form-submit-file" value="Lae üles">
                </form>
            </div>
        </div>
        <?php
    require("Webpiece/Footer.php");
    ?>