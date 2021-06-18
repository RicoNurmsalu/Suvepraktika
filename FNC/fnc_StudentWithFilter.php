<?php
$database = "if20_pille_suvepraktika";

function getTagStudentPayment($chosed)
{
    //echo "algus";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT student.student_id, student.uliopilaskood, student.firstname, student.lastname FROM student JOIN student_tag ON student.student_id = student_tag.student_id WHERE student_tag.tag_id = 18 GROUP BY uliopilaskood, firstname, lastname");
    $stmt->bind_result($student_id_from_db, $uliopilaskood_from_db, $firstname_from_db, $lastname_from_db);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "<td>" . '<input type="checkbox" name="student[]" value="<?php echo $lines["student_id"]; ?>' . "</td> \n";
        $lines .= "<td>" . $uliopilaskood_from_db . "</td> \n";
        $lines .= "<td>" . $firstname_from_db . "</td> \n";
        $lines .= "<td>" . $lastname_from_db . "</td>\n";
        $lines .= "<td>" . '<a href="ChangeStudent.php?student_id=' . $student_id_from_db . ' class="link"><img alt="Edit" title="Muuda" src="media/edit.png" width="15px" height="15px" hspace="10" /></a>';
        $lines .= "<td>" . '<a href="Quickview.php?student_id=' . $student_id_from_db . ' class="link"><img alt="Quickview" title="Kiirvaade" src="media/View.png" width="15px" height="15px" hspace="10" /></a>';
        $lines .= "<td>" . '<button class="email-button" type="submit" name="email-label" value="' .   '"> <img class="email-button-img" src="media/Message.png" alt="meili saatmise nupp"></button>' . "</td> \n";
        $lines .= "<td>" . '<button class="delete-button" type="submit" name="delete-student" value="' . $student_id_from_db . '"> <img class="delete-button-img" src="media/delete.png" alt="kustutamise nupp"></button>' . "</td> \n";
        $lines .= "</tr> \n";
    }

    if (!empty($lines)) {
        $notice = '<table class="tags-form-table">' . "\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Vali &nbsp; </th>' . "\n";
        $notice .= '<th>Üliõpilaskood &nbsp; </th>' . "\n";
        $notice .= '<th>Eesnimi &nbsp; <a href="?sortby=1&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=1&sortorder=2">&darr;</a> </th>' . "\n";
        $notice .= '<th>Perekonnanimi &nbsp; <a href="?sortby=2&sortorder=1">&uarr;</a>&nbsp; <a href="?sortby=2&sortorder=2">&darr;</a> </th>' . "\n";
        $notice .= '<th>Muuda tudengi infot &nbsp; </th>' . "\n";
        $notice .= '<th>Kiirvaade &nbsp; </th>' . "\n";
        $notice .= '<th>Saada meil &nbsp; </th>' . "\n";
        $notice .= '<th>Kustuta &nbsp; </th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }



    $stmt->close();
    $conn->close();
    //echo "ots";
    return $notice;
}

function getTagStudentVacation($chosed)
{
    //echo "algus";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT student.student_id, student.uliopilaskood, student.firstname, student.lastname FROM student JOIN student_tag ON student.student_id = student_tag.student_id WHERE student_tag.tag_id = 19 GROUP BY uliopilaskood, firstname, lastname");
    $stmt->bind_result($student_id_from_db, $uliopilaskood_from_db, $firstname_from_db, $lastname_from_db);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "<td>" . '<input type="checkbox" name="student[]" value="<?php echo $lines["student_id"]; ?>' . "</td> \n";
        $lines .= "<td>" . $uliopilaskood_from_db . "</td> \n";
        $lines .= "<td>" . $firstname_from_db . "</td> \n";
        $lines .= "<td>" . $lastname_from_db . "</td>\n";
        $lines .= "<td>" . '<a href="ChangeStudent.php?student_id=' . $student_id_from_db . ' class="link"><img alt="Edit" title="Muuda" src="media/edit.png" width="15px" height="15px" hspace="10" /></a>';
        $lines .= "<td>" . '<a href="Quickview.php?student_id=' . $student_id_from_db . ' class="link"><img alt="Quickview" title="Kiirvaade" src="media/View.png" width="15px" height="15px" hspace="10" /></a>';
        $lines .= "<td>" . '<button class="email-button" type="submit" name="email-label" value="' .   '"> <img class="email-button-img" src="media/Message.png" alt="meili saatmise nupp"></button>' . "</td> \n";
        $lines .= "<td>" . '<button class="delete-button" type="submit" name="delete-student" value="' . $student_id_from_db . '"> <img class="delete-button-img" src="media/delete.png" alt="kustutamise nupp"></button>' . "</td> \n";
        $lines .= "</tr> \n";
    }

    if (!empty($lines)) {
        $notice = '<table class="tags-form-table">' . "\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Vali &nbsp; </th>' . "\n";
        $notice .= '<th>Üliõpilaskood &nbsp; </th>' . "\n";
        $notice .= '<th>Eesnimi &nbsp; <a href="?sortby=1&sortorder=1">&uarr;</a> &nbsp;<a href="?sortby=1&sortorder=2">&darr;</a> </th>' . "\n";
        $notice .= '<th>Perekonnanimi &nbsp; <a href="?sortby=2&sortorder=1">&uarr;</a>&nbsp; <a href="?sortby=2&sortorder=2">&darr;</a> </th>' . "\n";
        $notice .= '<th>Muuda tudengi infot &nbsp; </th>' . "\n";
        $notice .= '<th>Kiirvaade &nbsp; </th>' . "\n";
        $notice .= '<th>Saada meil &nbsp; </th>' . "\n";
        $notice .= '<th>Kustuta &nbsp; </th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }



    $stmt->close();
    $conn->close();
    //echo "ots";
    return $notice;
}
