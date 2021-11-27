<?php
    if (empty($_SESSION['signedin'])) {
        $display_modal_window = 'none';
        include('forum_view_startpage.php');
        exit;
    }
?>

<?php
   //connect to server and select database
   $conn = mysqli_connect("localhost", "zilyassova", "zilyassova136", "C354_zilyassova");
       

   //gather the topics
   $get_topics = "select Topic_Id, Title,
  Date, Topic_Owner from ForumTopic order by Date desc";
  $get_topics_res = mysqli_query($conn, $get_topics);
  if (mysqli_num_rows($get_topics_res) > 0) {
     //there are no topics, so say so
     //create the display string
     $display_block = "
     <table cellpadding=3 cellspacing=1 border=1>
     <tr>
     <th>TOPIC TITLE</th>
     <th># of POSTS</th>
     </tr>";
  
      while ($topic_info = mysqli_fetch_array($get_topics_res)) {
         $topic_id = $topic_info['Topic_Id'];
         $per_page = 6;
         $topic_title = stripslashes($topic_info['Title']);
         $topic_create_time = $topic_info['Date'];
         $topic_owner = stripslashes($topic_info['Topic_Owner']);
  
         //get number of posts
         $get_num_posts = "select count(Post_Id) from ForumPosts
              where Topic_Id = $topic_id";
         $get_num_posts_res = mysqli_query($conn, $get_num_posts);
              
         $num_posts = mysqli_fetch_array($get_num_posts_res);

         $pages = ceil($num_posts[0] / $per_page);
  
         //add to display
         $display_block .= "
         <tr>
         <td><a href=\"showtopic.php?topic_id=$topic_id\">
         <strong>$topic_title</strong></a><br>
         Created on $topic_create_time by $topic_owner</td>
         <td align=center>$pages</td>
         </tr>";
      }
  } 
  else {
    $display_block = "<P><em>No topics exist.</em></p>";
     }
  
     //close up the table
     $display_block .= "</table>";
  
  ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<style>

.bg-custom-1 {
  background-color: #85144b;
}

.bg-custom-2 {
background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
}
 
 #header{
     position: relative; top: 0; left: 0;
     width: 100%; height: 80px;
     
 }

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
            background-color:#8FBC8F;
       
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
        .modal-window-topic {
            width:450px; height:500px;
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
<nav class="navbar navbar-dark bg-dark navbar-expand-sm">
  <div id = "name-account" style = "margin-left: calc(90% - 20px); color: white; font-size: 20px">
  
    <?php echo $_SESSION['username']; ?>
 
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar-list-4">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >

          <img src="https://cdn-icons-png.flaticon.com/512/17/17603.png" width="40" height="40">

        </a>
        <div class="dropdown-menu float-right" style="right: 0; left: auto;" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" id = "edit-profile">Edit Profile</a>
          <a class="dropdown-item" id = 'sign_out'>Log Out</a>
          <a class="dropdown-item" id = "delete-profile">Delete Profile</a>
        </div>
      </li>   
    </ul>
  </div>
</nav>
  </div>



<!--<div class = "button" >

<button id='sign_out' style='font-size: 16px; margin-left: 1230px; font-weight: lighter;  width:100px; height:40px; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Sign Out</b></button>

</div> -->

<div id = "navigation-bar">
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
</div>



<div id='layout-main'>
	
        <div id='layout-main-left'>
        <div class = 'buttons' style = 'text-align: center;'>
<button id='post_q' style=' margin-top:20px ;margin-left: 20px; display:inline-block; width:150px; height:75px;'><b>Post a discussion</b></button>
	
		<!---->
                
<button id='search_q' style='margin-left: 20px; display:inline-block; width:120px; height:75px;'><b>Search for a topic</b></button>

<button id='delete_q' style='margin-left: 20px; display:inline-block; width:120px; height:75px;'><b>Delete your discussions</b></button>

<button id='report_q' style='margin-left: 20px; display:inline-block; width:120px; height:75px;'><b>Report some discussions</b></button>

<button id='display-topics' style='margin-left: 20px; display:inline-block; width:120px; height:75px;'><b>Show the topics</b></button>

</div>
        <div id = 'e3-result-pane'> 
        <h1>Topics in My Forum</h1>
            <?php print $display_block; ?>
        </div>
        <form id='e1-form' style='display:none' method='post' action='forum_controller.php'>
		<input type='hidden' name='page' value='MainPage'>
        	<input type='hidden' name='command' value='SignOut'>
          </form>	

          <div id='blanket'>
          </div>
          <div id='modal-delete' class='modal-window' style='display: relative'>
        <h2 style='text-align:center'>Delete your profile</h2>
        <br>
        <form method='post' action='forum_controller.php'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='DeleteProfile'>
            <label class='modal-startpage' for='delete-username'>Username: </label>
            <input id='signin-username' type='text' name='username' required> 
            <span id='error-msg-delete-username'><?php if (!empty($error_msg_username)) echo $error_msg_username; // Display error message if there is ?></span>
            <br><br>
            <label class='modal-startpage' for='delete-password'>Password: </label>
            <input id='signin-password' type='password' name='password' required>
            <span id='error-msg-delete-password'><?php if (!empty($error_msg_password)) echo $error_msg_password; ?></span>
            <br>
            <input id='signin-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
            <input id='signin-submit' type='submit' value='Delete' style='margin:10px; position:absolute; right:0; bottom:0'>
            
        </form>
    </div>

    <div id='modal-edit' class='modal-window' style='display: relative'>
        <h2 style='text-align:center'>Edit your profile</h2>
        <br>
        <form method='POST' action='forum_controller.php'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='EditProfile'>
            <label class='modal-mainpage' for='edit-username'>Username: </label>
            <input id='edit-username' type='text' name='username' required> 
            
            <br>
            <label class='modal-mainpage' for='edit-password'>Password: </label>
            <input id='edit-password' type='password' name='password' required><br>
            <label class='modal-mainpage' for='edit-email'>Email: </label>
            <input id='edit-email' type='text' name='email' required><br>
            <input id='edit-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
            <input id='edit-submit' type='submit' value='Submit' style='margin:10px; position:absolute; right:0; bottom:0'>
        </form>
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





    <div id='modal-topic' class='modal-window-topic'>
        <h2 style='text-align:center'>Post a discussion topic</h2>

    <form id = 'discussion-form' method="POST" action='forum_controller.php'> 
	<input type='hidden' name='page' value='MainPage' >
    <input type='hidden' name='command' value='PostTopic'>
         <p><strong>Topic Title:</strong><br>
  <input id= 'topic-title' type='text'  name='topic' size=40 maxlength=150>
  <P><strong>Post Text:</strong><br>
  <textarea id = 'text-post' name='post-text' rows=8 cols=40 wrap=virtual></textarea>
  <P><input id = 'add-topic' type='button' value='Submit'></p>

    <input id='e1-cancel' type='button' value='Cancel'>  	 

	<input type="reset" value="Reset"> 
</form>


    </div>



    <div id='modal-q1' class='modal-window'>
        <h2 style='text-align:center'>Search a discussion</h2>

    <form method="POST" action='forum_controller.php'> 
  <input id='e3-question' type='text' name='term' placeholder = 'Question'><br> 
     <br><br>		
        <input id='e2-cancel' type='button' value='Cancel'>  	 
	<input id ='e3-submit' class='' type='button' value='submit' >
	<input type="reset" value="Reset">
  
</form>

    </div>

    <div id='modal-reply' class='modal-window'>
        <h2 style='text-align:center'>Reply to <?php echo $_SESSION['']; ?></h2>

    <form method="POST" action='forum_controller.php'> 
  <input id='e3-question' type='text' name='term' placeholder = 'Question'><br> 
     <br><br>		
        <input id='e2-cancel' type='button' value='Cancel'>  	 
	<input id ='e3-submit' class='' type='button' value='submit' >
	<input type="reset" value="Reset">
  
</form>

    </div>


</body>
</html>

<script>

$('#post_q').click(function() {
     
     $('#modal-topic').show();
 });

 $("#add-topic").click(function() {
     var topic = $('#topic-title').val().trim();
     var text = $('#text-post').val().trim();
     var xhttp = new XMLHttpRequest();  
     xhttp.onreadystatechange = function() {  
         if (this.readyState == 4 && this.status == 200) {  
             $('#e3-result-pane').html(this.responseText);  
         }
     };
     var controller = "forum_controller.php";  
     var query="page=MainPage&command=PostTopic&topic=" + topic + "&post-text=" + text;
     xhttp.open('POST', controller);  
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");  
     xhttp.send(query);
    });

 $("#e1-cancel").click(function() {
     
     $("#modal-topic").hide();
 });
 $('#search_q').click(function() {
     
     $('#modal-q1').show();
 });
 $("#e3-submit").click(function() {
        var url = "forum_controller.php";
        var term = $('#e3-question').val().trim();
        document.getElementById("modal-q1").style.display ="none";

        var query="page=MainPage&command=SearchQuestions&term=" + term;
         
        var xhttp = new XMLHttpRequest();  
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
              $.post(url, query, function(data)  {
        var rows = JSON.parse(data);   
             var t = '<table border = "1">';
            t += "<tr>";
            for (var p in rows[0])  
                        t += "<th>" + p + "</th>";
            t += "</tr>";

            for (var i = 0; i < rows.length; i++) {  
                t += '<tr>';
                for (var p in rows[i])  
                    t += '<td>' + (rows[i])[p]  + '</td>';    
                t += "<td>";
                        t += "  <button name='count' type='button' data-q-id='" + rows[i]['Id']   + "'>Like</button>";  
                    t += "</td>";
                t += "</tr>";

            }
        t += '</table>';
        $('#e3-result-pane').html(t);

             
});        
};
};
        

var url = "forum_controller.php";
        xhttp.open('POST', url);  
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
           

    });

     document.getElementById('sign_out').addEventListener('click', function() {
       document.getElementById('e1-form').submit();
        });

        document.getElementById("delete-profile").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-delete").style.display = "block";
    });
    
    document.getElementById("edit-profile").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "block";
        document.getElementById("modal-edit").style.display = "block";
    });
    
    document.getElementById("signin-cancel").addEventListener("click", function() {
        document.getElementById("blanket").style.display = "none";
        document.getElementById("modal-signin").style.display = "none";
        document.getElementById("modal-signup").style.display = "none";
        delete_error_messages();
    });
/*
        $('#delete-profile').click(function() { 
            //$(this).parent().parent().remove();
            var url = "forum_controller.php";
            var query = {page: "MainPage", command: "DeleteProfile", id: $_POST['Id'];};
            $.post(url, query,function(data) {

                document.getElementById('e1-form').submit();
                   
                 });
        });*/
 

// Close the dropdown if the user clicks outside of it
/*window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}*/


    




    document.getElementById("search_q").addEventListener("click", function() {
               document.getElementById("modal-q1").style.display = "block";
    });


	document.getElementById("e2-cancel").addEventListener("click", function() {
        
        document.getElementById("modal-q1").style.display = "none";
    });


    $('#delete_q').click(function(){

  
    var url = "forum_controller.php"; 
    var query = {page: "MainPage", command: "DisplayYourPosts" };
   
    $.post(url, query, function(data) {
      
       var rows = JSON.parse(data);  
                                  
        var t = "<table>";
            t += "<tr>";
            for (var p in rows[0])  
                        t += "<th>" + p + "</th>";
            t += "</tr>";
            for (var i = 0; i < rows.length; i++) { 
                t += "<tr>";
                    for (var p in rows[i])  
                        t += "<td>" + rows[i][p] + "</td>";  
                    t += "<td>";
                        t += "<button class = 'delete' type='button' data-q-id='" + rows[i]['Topic_Id']  + "'>Delete</button>"; 
                    t += "</td>";
                t += "</tr>";
            }
        t += "</table>";
        $('#e3-result-pane').html(t);
 
        
        $('.delete').click(function() { 
            $(this).parent().parent().remove();
            var url = "forum_controller.php";
            var query = {page: "MainPage", command: "DeleteQuestion", qid: $(this).attr('data-q-id')};
            $.post(url, query,function(data) {

                    $('#e3-result-pane').html(this.responseText);
                   
                 });
        });
    });
});


$('#report_q').click(function(){

  
var url = "forum_controller.php"; 
var query = {page: "MainPage", command: "DisplayNotYourPosts" };

$.post(url, query, function(data) {
  
   var rows = JSON.parse(data);  
                              
    var t = "<table>";
        t += "<tr>";
        for (var p in rows[0])  
                    t += "<th>" + p + "</th>";
        t += "</tr>";
        for (var i = 0; i < rows.length; i++) { 
            t += "<tr>";
                for (var p in rows[i])  
                    t += "<td>" + rows[i][p] + "</td>";  
                t += "<td>";
                    t += "<button class = 'report' type='button' data-q-id='" + rows[i]['Topic_Id']  + "'>Report</button>"; 
                t += "</td>";
            t += "</tr>";
        }
    t += "</table>";
    $('#e3-result-pane').html(t);

    
    $('.report').click(function() { 
        $(this).parent().parent().remove();
       
      $('#e3-result-pane').html(this.responseText);
               
             
    });
});
});

        
$('#display-topics').click(function(){

  
var url = "forum_controller.php"; 
var query = {page: "MainPage", command: "DisplayAllPosts" };

$.post(url, query, function(data) {
  
   var rows = JSON.parse(data);  
                              
    var t = "<table>";
        t += "<tr>";
        for (var p in rows[0])  
                    t += "<th>" + p + "</th>";
        t += "</tr>";
        for (var i = 0; i < rows.length; i++) { 
            t += "<tr>";
                for (var p in rows[i])  
                    t += "<td>" + rows[i][p] + "</td>";  
                t += "<td>";
                    t += "<button class = 'reply' type='button' data-q-id='" + rows[i]['Topic_Id']  + "'>Reply</button>"; 
                t += "</td>";
            t += "</tr>";
        }
    t += "</table>";
    $('#e3-result-pane').html(t);

    
    $('.reply').click(function() { 
        $(this).parent().parent().remove();
       
      $('#e3-result-pane').html(this.responseText);
               
             
    });
});
});


    </script>