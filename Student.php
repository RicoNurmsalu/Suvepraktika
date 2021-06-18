<?php
//require("Session/session.php");
require("config.php");
require("FNC/fnc_table.php");
require("FNC/fnc_AddStudent.php");
require("FNC/fnc_DeleteTag.php");

$sortby = 0;
$sortorder = 0;
$chosed = "";


if (isset($_POST["delete-student"])) {
    deleteStudent($_POST["delete-student"]);
}


if(isset($_POST["tag_nameinput"])){
    header("Location: GetTag.php");
}

require("Webpiece/Htmlheader.php");
echo "\n \t" . '<link rel="stylesheet" type="text/css" media="screen" href="Styles/studentsStyle.css">' . "\n";
require("Webpiece/Dropdown.php");
?>

<h2>Tudengid</h2>
<div class="student-search student-forms-student">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        Otsing: <input type="text" name="search">
        <input type="submit" name="submit-search" value="Submit">
    </form>
</div>
<br>
<div class="choose-tag student-forms-student">
    <form action="GetTag.php" method="GET">
        <label>Vali silt: </label>
        <?php
        echo getTag($chosed);
        ?>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<br>
<div class="student-table">
    <form class="students" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        if (isset($_GET["sortby"]) and isset($_GET["sortorder"])) {
            if ($_GET["sortby"] == 1) {
                $genresortby = $_GET["sortby"];
            }
            if ($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2) {
                $genresortorder = $_GET["sortorder"];
            }
        }
        if(isset($_POST["submit-search"]) and !empty($_POST["search"])){
            echo searchStudent($sortby, $sortorder, $_POST["search"]);
        } else {
            echo readStudentsTable($sortby, $sortorder);
        }
        ?>
    </form>
</div>

<?php
require("Webpiece/Footer.php");
?>