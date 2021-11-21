<?php
if (empty($_POST['page'])) {  // When no page is sent from the client; The initial display
                                // You may use if (!isset($_POST['page'])) instead of empty(...).
    $display_modal_window = 'no-modal';  // This variable will be used in 'view_startpage.php'.
                              // It will display the start page without any box, i.e., no SignIn box, no SignUp box, ...
    $error_msg_username = '';
    $error_msg_password = ''; // Set an error message into a variable.
    include('forum_view_startpage.php');
    exit();
}

require('forum_model.php');  // This file includes some routines to use DB.

// When commands come from StartPage
if ($_POST['page'] == 'StartPage')
{
    $command = $_POST['command'];
    switch($command) {  // When a command is sent from the client
        case 'SignIn':  // With username and password
            if (isUserValid($_POST['username'], $_POST['password'])) {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $_POST['username'];
                //include('w7_view_mainpage.php');
            } 
            else {
                $display_modal_window = 'signin';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                                                        // This variable will used in the form in 'view_startpage.php'.
                include('w7_view_startpage.php');
            }
            exit();
            break;

        case 'SignUp':  // With username, password, email, some other information
            if (signupNewUser($_POST['username'], $_POST['password'], $_POST['email'])) {
                $display_modal_window = 'signin'; 
                include('forum_view_startpage.php');
            }
            else {
                $display_modal_window = 'signup';  // It will display the start page with the SignIn box.
                                           // This variable will be used in 'view_startpage.php'.
                $error_msg_username = '* The username exists.';
                include('forum_view_startpage.php');
            }
            exit();
            break;
            
        default:
            echo "Unknown command from StartPage<br>";
            exit();
            break;
    }
}
