<?php
require("Session/session.php");

require("FNC/fnc_addTag.php");
require("FNC/fnc_table.php");
require("FNC/fnc_DeleteTag.php");
require("config.php");
require_once "db.php";

$tag_name = "";
$tagnotice = null;
$tag_nameerror = null;
$tag_color = null;
$tag_colorerror = null;
$notice = null;

if (isset($_POST["delete-label"])) {
    $delete_result = deleteTag($_POST["delete-label"]);
    if($delete_result == 0) {
        $notice = "Silti ei õnnestu kustutada!";
    } else {
        $notice = "Silt kustutatud!";
    }
}

if (isset($_POST["personsubmit"])) {
    if (!empty($_POST["tag_nameinput"])) {
        $tag_name .= ($_POST["tag_nameinput"]);
    } else {
        $tag_nameerror = "Palun sisesta silt";
    }

    if (!empty($_POST["tag_colorinput"])) {
        $tag_color .= ($_POST["tag_colorinput"]);
    } else {
        $tag_colorerror .= ($_POST["tag_colorinput"]);
    }

    if (empty($tag_nameerror) and empty($tag_colorerror)) {
        $tagnotice = addTag($tag_name, $tag_color);
    }
}
require("Webpiece/Htmlheader.php");
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen" href="Styles/tagsStyles.css">'."\n";
echo "\n \t".'<link rel="stylesheet" type="text/css" media="screen and (max-width: 1070px)" href="Styles/tagsStylesNarrow.css">'."\n";
require("Webpiece/Dropdown.php");
?>

<div class="tags-container">
    <div class="tags-insert form-item">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Lisa silt:</h2>
            <input name="tag_nameinput" id="tag_nameinput" type="text" value="<?php echo $tag_name; ?>"><span><?php echo $tag_nameerror; ?></span> 
            <input type="color" class="tag-insert-color-picker" name="tag_colorinput" id="tag_colorinput" value="<?php echo $tag_color; ?>"><span><?php echo $tag_colorerror; ?></span>
            <br>
            <input name="personsubmit" type="submit" id="tag-submit" value="Salvesta">
            <span><?php echo $tag_nameerror ?></span>
            <span><?php echo $tag_colorerror; ?></span>
            <p><?php echo $tagnotice; ?></p>
        </form>

    </div>
    <div class="tags-view form-item">
        <h2>Sildid</h2>
        <br>
        <form class="tags-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php
            if(!empty($notice)){
                echo "\n <p>" . $notice . "</p> \n \t";
            }
            echo readTagTable();
            ?>
        </form>
    </div>

</div>
<?php
require("Webpiece/Footer.php");
?>