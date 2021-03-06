<?php
    session_start();

    if (!isset($_SESSION['user_id']) || strcmp($_SESSION['type'], 'admin') != 0  || !isset($_REQUEST['page_user_id']))
    {
        // redirect unauthorized user at once to homepage
        header('Location: http://localhost/qa/index.php');
        die();
    }
    $navbar_signup_login = "";
    $header_tag_extras = "";
    $header_section_styles = "";
    $header_section_metas = "";
    $header_section_scripts = "";
    $header_section_extras = "";
    $body_tag_extras = "";

    $body_section_styles = "";
    $body_section_scripts = "";

    //require('../database/selectQuires.php');
    require('../database/models.php');
    $loggedin_user_info = getUserInfoByUserID($_SESSION['user_id']);
    $logged_in_name = "Welcome " . $loggedin_user_info['name'];
    
    $info = getUserInfoByUserID($_REQUEST['page_user_id']);
    $type = getUserTypeString($info['type']);

    $body_section_content = '<h1> Information About User: </h1>';
    $body_section_content .= '<p>you can change the user\'s role, approve or delete the user.</p>
     <form action="approve.php">
        ID: <input type="text" name="ID" readonly value="'. $info['ID'] .'"/><br>
        username: <input type="text" name="username" readonly value="'. $info['user_name'] .'"/><br>
        Name: <input type="text" name="name" readonly value="'. $info['name'] .'"/><br>
        email: <input type="text" name="email" readonly value="'. $info['email'] .'"/><br>
        Role: <input type="text" name="role" readonly value="'. $type .'"/><br>
        new role:<select name="type">
            <option value="instractor">Instructor</option>
            <option value="admin">Admin</option>
            <option value="qa_member">QA member</option>
            <option value="department_manager">Department Manager</option>
        </select><br>';

    if (strcmp($type, 'waiting user') == 0)
        $body_section_content .= '<button type="submit" name="action" value="approve">Approve</option>';
    else
        $body_section_content .= '<button type="submit" name="action" value="change">change</option>';

    $body_section_content .= '<button type="submit" name="action" value="delete"  onclick="return confirm(\'Are you sure?\')">Confirm</button>
    </form>';
    $navbar_signup_login = false;
    $navbar_content = array(
        array("../index.php" , "Home"),
        array("index.php", "DashBoard"),
        array("../about.php", "About"),
        array("../contact.php", "Contact")
    );


    include ("../templates/base.php");

    unset($_REQUEST['page_user_id']);
?>
