<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>

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

        

</style>



</head>

<body>


<div id = 'header'>

<div class = "buttons">

<button id='menu-register' style=' font-size: 16px; margin-left: 1250px; font-weight: lighter;  width:100px; height:40px; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Register</b></button>
<br>
<button id='menu-signin' style='margin-left: 1250px;  width:100px; height:40px; font-weight: lighter; border: 1px solid #4CAF50; border-radius: 5px; color: #4CAF50 ; background-color: white;'><b>Sign in</b></button>
</div>
</div>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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



</body>
</html>