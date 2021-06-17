<?php
require("db.php");
require("config.php");
require("FNC/fnc_ChangeStudent.php");
require("FNC/fnc_AddStudent.php");

$selected = null;
$selectedtag = null;
$taginputerror = null;
$tagnotice = null;
$firstname = "";
$lastname = "";
$email = "";
$personal_email = "";
$studentcode = "";
$firstnameerror = null;
$lastnameerror = null;
$personal_emailerror = "";
$emailerror = "";
$studentcode_error = "";
$student_id = null;
$chosed = "";

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
    $student_id = $_POST["studentidinput"];
    if (empty($firstnameerror) and empty($lastnameerror) and empty($emailerror) and empty($personal_emailerror) and empty($studentcode_error)) {
        $studentnotice = updateStudent($firstname, $lastname, $email, $personal_email, $studentcode, $student_id);
    }
} else {
    if (isset($_GET["student_id"])) {
        $student_info = changeStudent($_GET["student_id"]);
        $studentcode = $student_info->studentcode;
        $firstname = $student_info->firstname;
        $lastname = $student_info->lastname;
        $email = $student_info->email;
        $personal_email = $student_info->personalemail;
        $student_id = $_GET["student_id"];
    } else {
        header("Location: Student.php");
    }
}

if (isset($_POST["tagsubmit"])) {
    if (!empty($_POST["tag_nameinput"])) {
        $tag_id = ($_POST["tag_nameinput"]);
    } else {
        $tag_nameerror = "Palun sisesta silt";
    }

    if (empty($tag_nameerror)) {
        $student_id = $_POST["studentidinput"];
        $tagnotice = addtag($student_id, $tag_id);
    }
}

require("Webpiece/Htmlheader.php");
echo "\n \t" . '<link rel="stylesheet" type="text/css" media="screen" href="Styles/studentsStyle.css">' . "\n";
require("Webpiece/Dropdown.php");
?>

<h2>Muuda tudengi infot</h2>

<div class="choose-tag student-forms">
    <form class="student-table" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Lisa silt: </label>
        <input type="hidden" name="studentidinput" value="<?php echo $student_id; ?>">
        <?php
        echo getTag($chosed);
        ?>
        <input name="tagsubmit" type="submit" value="Salvesta" id="form-submit-form">
    </form>
</div>
<div class="student-table">
    <form class="show-students" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="studentidinput" value="<?php echo $student_id; ?>">
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
        <input name="personsubmit" type="submit" id="tag-submit" value="Salvesta" id="form-submit-form">
</div>



<?php
require("Webpiece/Footer.php");
?>