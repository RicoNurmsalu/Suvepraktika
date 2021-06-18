<?php
//require("Session/session.php");
require("config.php");
require("FNC/fnc_table.php");

require("Webpiece/Htmlheader.php");
echo "\n \t" . '<link rel="stylesheet" type="text/css" media="screen" href="Styles/studentsStyle.css">' . "\n";
require("Webpiece/Dropdown.php");
?>

<div class="quickview-table">
    <h2>Kiirvaade</h2>
    <br>
    <form class="quickview" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        echo readQuickViewTable();
        ?>
        <br>
        <?php
        echo readTag();
        ?>
    </form>
</div>

<?php
require("Webpiece/Footer.php");
?>