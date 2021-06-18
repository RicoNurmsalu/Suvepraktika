<?php
//funktsioonid, mida või kuidas kasutada
$database = "if20_pille_suvepraktika";


function addNewStudent($firstname, $lastname, $email, $personal_email, $uliopilaskood)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT firstname FROM student WHERE (firstname = ? AND lastname = ?)");
    //echo $conn->error;
    $stmt->bind_param("ss", $firstname, $lastname);
    $stmt->bind_result($firstnamefromdb);
    if ($stmt->execute()) {
        if ($stmt->fetch()) {
            $notice = "See tudeng on juba andmebaasis!";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO student (firstname, lastname, email, personal_email, uliopilaskood) VALUES (?, ?, ?, ?, ?)");
            echo $conn->error;
            $stmt->bind_param("sssss", $firstname, $lastname, $email, $personal_email, $uliopilaskood);
            if ($stmt->execute()) {
                $notice = "Tudengi info salvestatud!";
            } else {
                $notice = $stmt->error;
            }
        }
    } else {
        $notice = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}


function addstudent($firstname, $lastname, $email, $personal_email, $uliopilaskood, $tag_id)
{
    //echo "algus";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->set_charset("UTF8");
    $stmt = $conn->prepare("SELECT uliopilaskood FROM student WHERE (uliopilaskood = ?)");
    //echo $conn->error;
    $stmt->bind_param("i", $uliopilaskood);
    $stmt->bind_result($uliopilaskoodfromdb);
    if ($stmt->execute()) {
        if ($stmt->fetch()) {
            $notice = "See tudeng on juba andmebaasis!";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO student (firstname, lastname, email, personal_email, uliopilaskood) VALUES (?, ?, ?, ?, ?)");
            echo $conn->error;
            $stmt->bind_param("sssss", $firstname, $lastname, $email, $personal_email, $uliopilaskood);
            if ($stmt->execute()) {
                $notice = "Tudengi info salvestatud!";
                $student_id = $conn->insert_id;
            } else {
                $notice = $stmt->error;
            }
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO student_tag (student_tag.student_id, student_tag.tag_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $student_id, $tag_id);
            if ($stmt->execute()) {
                $notice .= " Seos on salvestatud!";
            } else {
                $notice = $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $notice = $stmt->error;
    }


    $conn->close();



    //echo "ots";
    return $notice;
}



function getTag($chosed)
{
    //echo "algus";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT tag_id, tag_name, tag_color FROM tag");
    //echo $conn->error;
    //$stmt->bind_param("iss", $tag_id, $tag_name, $tag_color);
    $stmt->bind_result($tag_idfromdb, $tag_namefromdb, $tag_colorfromdb);
    $stmt->execute();
    $tag = "";
    while ($stmt->fetch()) {
        $tag .= '<option value="' . $tag_idfromdb . '"';
        if (intval($tag_idfromdb) == $chosed) {
            $tag .= " selected";
        }
        $tag .= ' style="background-color: ' . $tag_colorfromdb .'"';
        $tag .= ">" . $tag_namefromdb . "</option> \n";
    }

    if (!empty($tag)) {
        $notice = '<select name="tag_nameinput" id="tag_nameinput">' . "\n";
        $notice .= '<option value="" selected disabled>Vali silt</option>' . "\n";
        $notice .= $tag;
        $notice .= "</select> \n";
    }

    $stmt->close();
    $conn->close();
    //echo "ots";
    return $notice;
}
