
<?php
$database = "if20_pille_suvepraktika";

function deleteTag($tag_id) {
    $notice = 0;
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->set_charset("utf8");
    $stmt = $conn->prepare("DELETE FROM tag WHERE tag_id = ?");
    $stmt->bind_param("i", $tag_id);
    if ($stmt->execute()){
        $notice = 1;
    }
    $stmt->close();
    $conn->close();
    return $notice;
    //header("Location:Tags.php");
}

function deleteStudent($student_id){
    //echo "otsitav id: " . $student_id;
    $notice = 0;
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $conn->set_charset("utf8");
    //$stmt = $conn->prepare("DELETE FROM student WHERE student_id = ?");
    $stmt = $conn->prepare("UPDATE student SET deleted = NOW() WHERE student_id = ?");
    echo $conn->error;
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()){
        $notice = 1;
        //echo "kustutan";
    } else {
        echo $stmt->error;
        echo $conn->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
?>