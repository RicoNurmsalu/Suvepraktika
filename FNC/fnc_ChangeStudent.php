<?php

function addtag($student_id, $tag_id)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->set_charset("UTF8");
    $stmt = $conn->prepare("INSERT INTO student_tag (student_tag.student_id, student_tag.tag_id) VALUES (?,?)");
    $stmt->bind_param("ii", $student_id, $tag_id);
    if ($stmt->execute()) {
        $notice = " Silt on salvestatud!";
    } else {
        $notice = $stmt->error;
    }

    $stmt->close();
    $conn->close();
    return $notice;
}

function changeStudent($student_id){
    $obj = null;
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->set_charset("utf8");
    $SQLsentence = "SELECT uliopilaskood, firstname, lastname, email, personal_email FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($SQLsentence);
    echo $conn->error;
    $stmt->bind_param("i", $student_id);
    $stmt->bind_result($uliopilaskood_from_db, $firstname_from_db, $lastname_from_db, $email_from_db, $personal_email_from_db);
    $stmt->execute();
    if ($stmt->fetch()) {
        $obj = new stdClass();
        $obj->studentcode = $uliopilaskood_from_db;
        $obj->firstname = $firstname_from_db;
        $obj->lastname = $lastname_from_db;
        $obj->email = $email_from_db;
        $obj->personalemail = $personal_email_from_db;
    } else {
        header("Location: Student.php");
    }
    $stmt->close();
    $conn->close();
    return $obj;
}

function updateStudent($firstname, $lastname, $email, $personal_email, $studentcode, $student_id)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("UPDATE student SET firstname=?, lastname=?, email=?, personal_email=?, uliopilaskood=? WHERE student_id = ?");
    echo $conn->error;
    $stmt->bind_param("sssssi", $firstname, $lastname, $email, $personal_email, $studentcode, $student_id);
    if ($stmt->execute()) {
        $notice = "Tudengi info salvestatud!";
    } else {
        $notice = $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
    return $notice;
}