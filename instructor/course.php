<?php
    session_start();

    if (!isset($_SESSION['user_id']) || strcmp($_SESSION['type'], 'instractor') != 0  || !isset($_REQUEST['page_course_id']))
    {
        // redirect unauthorized user at once to homepage
        header('Location: http://localhost/qa/index.php');
        die();
    }

    // view course details
    $header_tag_extras = "";
    $header_section_styles = "";
    $header_section_metas = "";
    $header_section_scripts = "";
    $header_section_extras = "";
    $body_tag_extras = "";

    $body_section_styles = "";
    $body_section_scripts = "";

    $navbar_signup_login = "";
    require('../database/models.php');
    $loggedin_user_info = getUserInfoByUserID($_SESSION['user_id']);
    $logged_in_name = "Welcome " . $loggedin_user_info['name'];
    // get all files
    $course = getInfoByCourseID($_REQUEST['page_course_id']);
    $files = getFilesByCourseID($_REQUEST['page_course_id']);

    $body_section_content = '<h1> Information About Course: </h1>';
    $body_section_content .= '<form enctype="multipart/form-data" method="POST" action="upload.php">
        ID: <input type="text" readonly name="ID" value="'. $course['ID']  .'"><br>
        Name: <input type="text" readonly name="name" value="'.$course['name'].'"><br>
        Code: <input type="text" readonly name="code" value="'.  $course['code'] .'"><br>
        Semester: <input type="text" readonly name="semester" value="'. $course['semster'] .'"><br>
        Year: <input type="text" readonly name="year" value="'. $course['year'] .'"><br>';
    $body_section_content .= '<p>You can add links to files, remove links or update links or save your files on the cloud.</p><table border=1><tr>';
    $i = 1;
    // add information about the 6 files of the Course
    foreach ($files as $file)
    {
        $body_section_content .= '<td>'.str_replace("_", " ", $file['type']) .': <input type="text" name="'.$file['type'].'" value="';
        if ($file['data'] == NULL)
            $body_section_content .= '" placeholder="Insert Link to file."/><br>';
        else
            $body_section_content .= $file['data'] . '"/><br>';
        $body_section_content .= 'or upload file<input type="file" name="upload_'.$file['type'].'" /><br></td>';
        ++$i;
        if ($i == 4) {
            $body_section_content .= '</tr><tr>';
        }
    }
    $body_section_content .= '</tr></table><button type="submit" value="confirm"  onclick="return confirm(\'Are you sure?\')">Confirm</button>';
    $body_section_content .= '</form>';

    $navbar_signup_login = false;
    $navbar_content = array(
        array("../index.php" , "Home"),
        array("index.php" , "DashBoard"),
        array("../about.php", "About"),
        array("../contact.php", "Contact")
    );


    include ("../templates/base.php");

    unset($_REQUEST['page_course_id']);

?>
