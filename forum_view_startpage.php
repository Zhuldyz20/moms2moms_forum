<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

        #menu-register, #menu-signin{
            display: inline;
        }

        #layout-main {
            position:relative; top:0; left:0;
            width:100vw; height:calc(100vh - 100px); 
        }
        
        #layout-main-left {
            position:absolute; top:0; left:0;
            width:70%; height:100%; 
            background-color:#4CAF50; 
        }
        
        #layout-main-right {
            position:relative; 
            top:0; left:70%;
            width:30%; height:50%; 
             
        }   
   
        #layout-main-right-top{
        position:absolute; 
        top:0;
        bottom: 50%;
        }

        #layout-main-right-bottom{
        position:absolute;
        top: 50%;
        bottom: 0;
        }

       #layout-bottom {
            position:relative;
        }

        #blanket {
            background-color:#98BF64;
            display:none;
            width:100%; height:100%;
            position:fixed;
            top:0; left:0;
            opacity:0.5;
            z-index:998;
        }

        .modal-window {
            width:450px; height:300px;
            border:1px solid black;
            display:none;
            background-color:White;
            position:fixed;
            top:150px; left:calc(50% - 201px);
            padding:20px;
            z-index:999;
        }

        

</style>



</head>

<body>


<div id = 'header'>

<div class = "buttons">

<button id='menu-register' style='font-size: 16px; margin-left: 1230px; font-weight: lighter;  width:100px; height:40px; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Register</b></button>
<button id='menu-signin' style=' left: 0%; width:100px; height:40px; font-weight: lighter; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Sign in</b></button>
</div>
</div>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">MomsToMoms</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="forum_view_startpage.php"><i class="fa fa-home"></i>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div id='layout-main'>
	
        <div id='layout-main-left'>
            <div id='content-left' style='position:absolute'>
            <h1 style='margin-left: 50px;'>Content1 </h1>
                <br>
            </div>
        </div>
		
        <div id='layout-main-right'>

        	<div id = 'layout-main-right-top'>
                 
                  <h2 style='margin-left: 50px'>Content2 </h2>
                  <h3 style='margin-left: 50px'>Trending disscusion posts</h3>
                  

        	</div>

        	<div id = 'layout-main-right-bottom'>
                  
                  <h2 style='margin-left: 50px'>Content3 </h2>
                  <h3 style='margin-left: 50px'>Results </h3>

                  

        	</div>



     
        </div>
</div>


<div id='layout-bottom'>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp
        <a href=''>Some links</a> &nbsp;&nbsp;&nbsp;
        <br>
</div>

<div id='blanket'>
    </div>

    <div id='modal-signin' class='modal-window' style='display: relative'>
        <h2 style='text-align:center'>Sign in to MomsToMoms Forum</h2>
        <br>
        <form method='POST' action='forum_controller.php'>
            <input type='hidden' name='page' value='StartPage'>
            <input type='hidden' name='command' value='SignIn'>
            <label class='modal-startpage' for='signin-username'>Username: </label>
            <input id='signin-username' type='text' name='username' required> 
            <span id='error-msg-signin-username'><?php if (!empty($error_msg_username)) echo $error_msg_username; // Display error message if there is ?></span>
            <br><br>
            <label class='modal-startpage' for='signin-password'>Password: </label>
            <input id='signin-password' type='password' name='password' required>
            <span id='error-msg-signin-password'><?php if (!empty($error_msg_password)) echo $error_msg_password; ?></span>
            <br>
            <input id='signin-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
            <input id='signin-submit' type='submit' value='Submit' style='margin:10px; position:absolute; right:0; bottom:0'>
        </form>
    </div>

    <div id='modal-signup' class='modal-window'>
        <h2 style='text-align:center'>Register</h2>
        <br>
        <form method='POST' action='forum_controller.php'>
            <input type='hidden' name='page' value='StartPage'>
            <input type='hidden' name='command' value='SignUp'>
            <label class='modal-startpage' for='signup-username'>Username: </label>
            <input id='signup-username' type='text' name='username' required> 
            <span id='error-msg-signup-username'><?php if (!empty($error_msg_username)) echo $error_msg_username; ?></span>
            <br>
            <label class='modal-startpage' for='signup-password'>Password: </label>
            <input id='signup-password' type='password' name='password' required><br>
            <label class='modal-startpage' for='signup-password'>Email: </label>
            <input id='signup-email' type='text' name='email' required><br>
            <input id='signup-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
            <input id='signup-submit' type='submit' value='Submit' style='margin:10px; position:absolute; right:0; bottom:0'>
        </form>
    </div>

</body>
</html>

<script>
   <?php
        if ($display_modal_window == 'signin')
            echo 'show_signin();';
        else if ($display_modal_window == 'signup')
            echo 'show_signup();';
    ?>
    
    function show_signin() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-signin").style.display = "block";
    }
    
    function show_signup() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-signup").style.display = "block";
    }
    
    function delete_error_messages() {
        document.getElementById("error-msg-signin-username").innerHTML = "";
        document.getElementById("error-msg-signin-password").innerHTML = "";
        document.getElementById("error-msg-signup-username").innerHTML = "";
    }
    
    document.getElementById("blanket").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "none";
        document.getElementById("modal-signin").style.display = "none";
        document.getElementById("modal-signup").style.display = "none";
        delete_error_messages();
    });

    document.getElementById("menu-signin").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-signin").style.display = "block";
    });
    
    document.getElementById("menu-register").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-signup").style.display = "block";
    });
    
    document.getElementById("signin-cancel").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "none";
        document.getElementById("modal-signin").style.display = "none";
        document.getElementById("modal-signup").style.display = "none";
        delete_error_messages();
    });

    document.getElementById("signup-cancel").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "none";
        document.getElementById("modal-signin").style.display = "none";
        document.getElementById("modal-signup").style.display = "none";
        delete_error_messages();
    });
    </script>