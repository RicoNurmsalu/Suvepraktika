<?php
require("db.php");
require("config.php");
$otsing = '';
if (isset($_REQUEST["otsing"])) {
    $otsing = $_REQUEST["otsing"];
}

$sql = "SELECT student.firstname, student.lastname, GROUP_CONCAT(CONCAT(tag.tag_color, '-', tag.tag_name)) AS TagName FROM student JOIN student_tag ON student.student_id = student_tag.student_id JOIN tag ON tag.tag_id = student_tag.tag_id GROUP BY firstname, lastname HAVING TagName like '%$otsing%'";
if (isset($_REQUEST["tag_nameinput"])) {
    $sql = "SELECT student.firstname, student.lastname, GROUP_CONCAT(CONCAT(tag.tag_color, '-', tag.tag_name)) AS TagName FROM student JOIN student_tag ON student.student_id = student_tag.student_id JOIN tag ON tag.tag_id = $_REQUEST[tag_nameinput] GROUP BY firstname, lastname";
}
$result = mysqli_query($conn, $sql);

require("Webpiece/Htmlheader.php");
echo "\n \t" . '<link rel="stylesheet" type="text/css" media="screen" href="Styles/studentsStyle.css">' . "\n";
require("Webpiece/Dropdown.php");
?>

<h2>Tudengitele kuuluvad sildid</h2>

<div class="tags-search">
    <form action="GetTag.php" method="GET">
        Search: <input type="text" name="otsing">
        <input type="submit" name="submit" value="Submit">
    </form>
</div>
<div class="student-tags-table"></div>
<form name="frmstudents" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div style="width:500px;">
        <div class="message"><?php if (isset($message)) {
                                    echo $message;
                                } ?></div>
        <div align="right" style="padding-bottom:5px;"><a href="Student.php" class="link"><img alt='List' title='List' src='media/list.png' width='15px' height='15px' /> Tudengid</a></div>
        <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
            <tr class="listheader">
                <td>Eesnimi</td>
                <td>Perenimi</td>
                <td>Silt</td>
            </tr>


            <?php

            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                if ($i % 2 == 0)
                    $classname = "evenRow";
                else
                    $classname = "oddRow";

            ?>

                <tr class="<?php if (isset($classname)) echo $classname; ?>">

                    <td><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td>

                        <?php
                        $m = explode(",", $row["TagName"]);
                        foreach ($m as $rida) {
                            $paar = explode("-", $rida);
                            echo "<span style='background-color: $paar[0]'>$paar[1]</span>";
                        }
                        ?>

                    </td>

                </tr>

            <?php
                $i++;
            }
            ?>

        </table>
    </div>
</form>


<?php
require("Webpiece/Footer.php");
?>