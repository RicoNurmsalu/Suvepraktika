<?php
require("Session/session.php");
require("Webpiece/Htmlheader.php");
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen" href="Styles/mainpageStyle.css">'."\n";
require("Webpiece/Dropdown.php");
?>

<div class="buttons">
    <div class="center-top">
        <a href="StudentPayment.php" class="button">Halda maksevõlgnevusega tudengeid</a>
    </div>
    <br>
    <div class="center-bottom">
        <a href="StudentVacation.php" class="bottom_btn">Halda akadeemilisel puhkusel viibivaid tudengeid</a>
    </div>
</div>
<?php
require("Webpiece/Footer.php");
?>
