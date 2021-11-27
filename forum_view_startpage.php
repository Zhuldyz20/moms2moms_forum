<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
       .container {
           position: relative;
           text-align: center;
           color: white;
           top: 0; left:0; right =0;
           margin:auto;
        }

      .centered {
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
}
#tableDisplay {
  border-collapse: collapse;
  width: 100%;
}

#tableDisplay td, #tableDisplay th {
  border: 1px solid #ddd;
  padding: 8px;
}


#tableDisplay tr:hover {
background-color: #ddd;
}

#tableDisplay th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}      

</style>


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
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


<div class="container">

<div class="mySlides">
  
  <img src="media\mom2.jpg" style="width:100%">
  <div class="centered">We connect</div>
</div>

<div class="mySlides">
 
  <img src="media\mom1.jpg" style="width:100%">
  <div class="centered">We support</div>
</div>

<div class="mySlides">
    <img src="media\mom3.jpg" style="width:100%">
  <div class="centered">We educate</div>
</div>

</div>

<div id='layout-main'>
	
        <div id='layout-main-left'>
            
            <table id = "tableDisplay">
              <tr>
    <th>Topic ID</th>
    <th>Title</th>
    <th>Discussion post</th>
    <th>Date</th>
    <th>Post Owner</th>

  </tr>

 
<?php

include "display.php";
$result = mysqli_query($conn,"select ForumPosts.Topic_Id, ForumTopic.Title, ForumPosts.Text, ForumPosts.Date, ForumPosts.Post_Owner from ForumPosts INNER JOIN ForumTopic ON ForumPosts.Topic_Id = ForumTopic.Topic_Id"); 
while($data = mysqli_fetch_array($result))
{
?>
  <tr>
    <td><?php echo $data['Topic_Id']; ?></td>
    <td><?php echo $data['Title']; ?></td>
    <td><?php echo $data['Text']; ?></td>
    <td><?php echo $data['Date']; ?></td>
    <td><?php echo $data['Post_Owner']; ?></td>

  </tr>	
<?php
}
?>
</table>
<div class = "button">
<button id='post_question' style='font-size: 16px; margin-left:0px; font-weight: lighter;  width:100px; height:40px; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Post</b></button>
</div>

            <h1 style='margin-left: 50px;'>Content1 </h1>
                <br>
           
        </div>
		
        <div id='layout-main-right'>

        	<div id = 'layout-main-right-top'>
                 
                  <h2 style='margin-left: 50px'>Useful links</h2>

                 <ul>
                 <li><a href="https://www.whattoexpect.com/due-date-calculator/" target="_blank">Pregnancy Calculator</a></li>
                 <li><a href="https://iamnotalone.ca/" target="_blank">Pregnancy Care Center</a></li>
                 <li><a href="https://www.plannedparenthood.org/learn/pregnancy/pregnancy-tests">Pregnancy Test</a></li>

                 </ul>
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
        <form method='post' action='forum_controller.php'>
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
            <a href="javascript:yourfunction();"> Haven't register?</a>
            
                         
	    
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
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script>

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}


  /* <?php
        if ($display_modal_window == 'signin')
            echo 'show_signin();';
        else if ($display_modal_window == 'signup')
            echo 'show_signup();';
    ?>*/
    function yourfunction(){
	document.getElementById("modal-signin").style.display = "none";
	document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-signup").style.display = "block";



}  
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

    document.getElementById("post_question").addEventListener("click", function() {
      alert("Sign In is required!");     
       });






    </script>