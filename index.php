<?php
    session_start();

    $logged_in_name ="Site Portal";
    $header_tag_extras = "";
    $header_section_styles = "";
    $header_section_metas = "";
    $header_section_scripts = "";
    $header_section_extras = "";
    $body_tag_extras = "";
    $navbar_signup_login = "";
    $body_section_styles = "";
    $body_section_scripts = "";
    $body_section_content = '<p> Welcome to the Quality Assurance Committee website for Cairo University, Faculty of Engineering</p>
    <p>Use the navigation bar to the left to go through the website.<br> ';

    if (isset($_SESSION['user_id']))
    {
        require('database/models.php');
        $loggedin_user_info = getUserInfoByUserID($_SESSION['user_id']);
        $logged_in_name = "Welcome " . $loggedin_user_info['name'];
        $navbar_signup_login = false;

        // check user type
        switch ($_SESSION['type']) {
            case 'qa_member':
                $body_section_content .= 'You can see departments progress from the Dashboard.';
                $navbar_content = array(
                    array("index.php" , "Home"),
                    array("http://localhost/qa/quality-assurance/index.php" , "Dashboard"),
                    array("about.php", "About"),
                    array("contact.php", "Contact")
                );
                break;

            case 'admin':
                $body_section_content .= 'You can approve pending users, change users type or delete user accounts';
                $navbar_content = array(
                    array("index.php" , "Home"),
                    array("http://localhost/qa/admin/index.php" , "DashBoard"),
                    array("about.php", "About"),
                    array("contact.php", "Contact")
                );
                break;

            case 'instractor':
                $body_section_content .= 'You add, update or remove links or upload QA files';
                $navbar_content = array(
                    array("index.php" , "Home"),
                    array("http://localhost/qa/instructor/index.php" , "DashBoard"),
                    array("about.php", "About"),
                    array("contact.php", "Contact")
                );
                break;

            case 'department_manager':
                $body_section_content .= 'You can view the department\'s courses progress and add new courses.';
                $navbar_content = array(
                    array("index.php" , "Home"),
                    array("http://localhost/qa/department-managment/index.php" , "DashBoard"),
                    array("http://localhost/qa/department-managment/new-course.php" , "New Course"),
                    array("about.php", "About"),
                    array("contact.php", "Contact")
                );
                break;

            case 'waiting user':
                $navbar_content = array(
                    array("index.php" , "Home"),
                    array("about.php", "About"),
                    array("contact.php", "Contact")
                );
                break;

            default:
                die('unregisterd user managed to get here dfuck!');
                break;
        }
    }
    else
    {// anonymous user
        $navbar_signup_login = true;
        $navbar_content = array(
            array("index.php" , "Home"),
            array("about.php", "About"),
            array("contact.php", "Contact")
        );
    }

    $body_section_content .= '</p>';
    include ("templates/base.php");
?>
