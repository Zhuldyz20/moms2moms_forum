<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        

</style>

   <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>


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
          <a class="dropdown-item" href="#">Dashboard</a>
          <a class="dropdown-item" href="#">Edit Profile</a>
          <a class="dropdown-item" href="#">Log Out</a>
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
<button id='post_q' style=' margin-top:20px ;margin-left: 20px; display:inling-block; width:150px; height:75px;'><b>Post a discussion</b></button>
	
		<!---->
                
<button id='search_q' style='margin-left: 20px; display:inling-block; width:150px; height:75px;'><b>Search for a topic</b></button>

</div>
        <div id = 'e3-result-pane'>  </div>
            <form id='e1-form' style='display:none' method='post' action='forum_controller.php'>
		<input type='hidden' name='page' value='MainPage'>
        	<input type='hidden' name='command' value='SignOut'>
          </form>	
		

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



    <div id='modal-q' class='modal-window'>
        <h2 style='text-align:center'>Post a question</h2>

    <form id = 'tr5-form' method="POST" action='forum_controller.php'> 
	<input type='hidden' name='page' value='MainPage' >
        <input type='hidden' name='question' value='post_q'>
		
     <input id='e4-question' type='text' name='question' placeholder = 'Question'> <br> 
     <br><br>
     <input id='e4-topic' type='text' name='topic' placeholder = 'Topic'> <br> 
     <br><br>

    <input id='e1-cancel' type='button' value='Cancel'>  	 
	<input id ='e4-submit'class='submit' type='button' value='submit' >
	<input type="reset" value="Reset"> 
</form>


    </div>



    <div id='modal-q1' class='modal-window'>
        <h2 style='text-align:center'>Search a question</h2>

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


    

     //document.getElementById('sign_out').addEventListener('click', function() {
      //  document.getElementById('e1-form').submit();
       //  });
       function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
     document.getElementById("post_q").addEventListener("click", function() {
               document.getElementById("modal-q").style.display = "block";
    });


	document.getElementById("e1-cancel").addEventListener("click", function() {
        
        document.getElementById("modal-q").style.display = "none";
    });


    document.getElementById("search_q").addEventListener("click", function() {
               document.getElementById("modal-q1").style.display = "block";
    });


	document.getElementById("e2-cancel").addEventListener("click", function() {
        
        document.getElementById("modal-q1").style.display = "none";
    });



 
    $('#e4-submit').click(function() {
        document.getElementById("modal-q").style.display ="none";
        var xhttp = new XMLHttpRequest();  
        xhttp.onreadystatechange = function() {  
            if (this.readyState == 4 && this.status == 200) {  
                $('#e3-result-pane').html(this.responseText);  
            }
        };
        var controller = "forum_controller.php";
        var query="page=MainPage&command=PostAQuestion" + "&" + "question= " + $("#e4-question").val().trim() + "&" + "topic= " + $("#e4-topic").val().trim();

        xhttp.open("post", controller);  
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");  
        xhttp.send(query);
    });


$("#e3-submit").click(function() {
        var url = "forum_controller.php";
        var term = $('#e3-question').val().trim();
        var query="page=MainPage&command=SearchQuestions&term=" + term;
        var xhttp = new XMLHttpRequest();  
        xhttp.onreadystatechange = function() { 
            if (this.readyState == 4 && this.status == 200) {
               $.post(url, query, function(data)  {
               var rows = JSON.parse(data);   
               var t = '<table>';
               t += "<tr>";
               for (var p in rows[0])  
                 t += "<th>" + p + "</th>";
               t += "</tr>";
               for (var i = 0; i < rows.length; i++) {  
                  t += '<tr>';
                  for (var p in rows[i])  
                    t += '<td>' + (rows[i])[p]  + '</td>';    
                  t += "<td>";
                  t += "</tr>";}
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



    </script>