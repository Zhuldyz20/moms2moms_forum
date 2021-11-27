<?php
if (empty($_POST['page'])) {  // When no page is sent from the client; The initial display
     require('forum_model.php');                           // You may use if (!isset($_POST['page'])) instead of empty(...).
    $display_modal_window = 'no-modal';  // This variable will be used in 'view_startpage.php'.
     include('forum_view_startpage.php');
    exit();
}

require('forum_model.php');  // This file includes some routines to use DB.

// When commands come from StartPage
if ($_POST['page'] == 'StartPage')
{
    $command = $_POST['command'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    switch($command) {  // When a command is sent from the client
        case 'SignIn':  // With username and password
            if (isUserValid($username, $password)) {
                session_start();
                $_SESSION['signedin'] = 'YES';
                $_SESSION['username'] = $username;
                include('forum_view_mainpage.php');
                exit();
            } 
            else {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                $display_modal_window = 'SignIn';                                       // This variable will used in the form in 'view_startpage.php'.
                include('forum_view_startpage.php');
            }
            exit();
            break;

        case 'SignUp':  // With username, password, email, some other information
            if (signupNewUser($_POST['username'], $_POST['password'], $_POST['email'])) {
                $display_modal_window = 'SignIn'; 
                include('forum_view_startpage.php');
            }
            else {
                $display_modal_window = 'SignUp';  // It will display the start page with the SignIn box.
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
if ($_POST['page'] == 'MainPage'){
session_start();
       
       
      if (!isset($_SESSION['signedin'])) {
        $display_modal_window = 'none';
        include ('forum_view_startpage.php');
        exit;
    }
      $command = $_POST['command'];
       
      switch($command) { 
        case 'SignOut':
            session_unset();
            session_destroy();
            $display_modal_window = 'none';
            include('forum_view_startpage.php');
            exit();

        case 'PostTopic':
            $topic = $_POST['topic'];
            $p = $_POST['post-text'];
            $u = $_SESSION['username'];
            insertNewTopic($topic, $u);
            insertNewForumText($p, $topic, $u);
        
             echo "Posted - " . $topic . " ". $p;
            
            exit();
            break;

        case 'SearchQuestions':
            
            echo json_encode(SearchQuestions($_POST['term']));
            exit();
        
        case 'DeleteProfile' :
           
           
            if (deleteProfile($_POST['username'], $_POST['password'])) 
            {
                
                //$_SESSION['signedin'] = 'YES';
                //$_SESSION['username'] = $username;
                $display_modal_window = 'none';
                include('forum_view_startpage.php');
                exit();
            } 
            else {
                $error_msg_username = '* Wrong username, or';
                $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                $display_modal_window = 'DeleteProfile';                                       // This variable will used in the form in 'view_startpage.php'.
                include('forum_view_mainpage.php');
            }
            exit();
            break;

        case 'EditProfile' :
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if(editProfile($username, $password, $email)) {
                $display_modal_window = 'none';
                include('forum_view_mainpage.php');
                exit();
            }
            else {
                $display_modal_window = 'EditProfile';
                include('forum_view_mainpage.php');
                exit();

            }

        case 'DisplayYourPosts' :
            $yourPosts = displayYourPost($_SESSION['username']);
            echo json_encode($yourPosts);
            exit();
            
        case 'DeleteQuestion' :
            $qid = $_POST['qid'];
            $result = deleteYourPost($qid);
            echo $result;
            exit();
       
    }
} 



?>
