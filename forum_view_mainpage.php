<?php
    if (empty($_SESSION['signedin'])) {
        $display_modal_window = 'none';
        include('forum_view_startpage.php');
        exit;
    }
?>

<!DOCTYPE html>

<html>
<head>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <style>
        #layout-header {
            position:relative; top:0; left:0;
            width:100vw; height:120px; 
        }
        #layout-main {
            position:relative; top:0; left:0;
            width:100vw; height:calc(100vh - 120px); 
        }
        
        #layout-navigation {
            position:absolute; top:0; left:0;
            width:100%; height:100%; 
            background-color:#4CAF50; 
            padding:10px;
        }
        
        #layout-content {
            position:absolute; 
            top:0; left:200px;
            width:100%; height:100%; 
            background-color:#4CAF50; 
            padding:10px;
        }
        
        .modal-window {
            width:400px; height:200px;
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
    <!-- layout -->
    
    <div id='layout-header'>
        <h1 style='text-align:center; padding-top: 10px;'>MomsToMoms Forum</h1>
        <h3 style='text-align:center; padding-bottom: 10px;'>- User: <?php echo $_SESSION['Username']; ?> -</h3>
    </div>
    <div id='layout-main'>
        <div id='layout-navigation'>
            <button id='post-a-discussion'>Post a Discussion</button><br>
            <br>
            <button id='search-discussions'>Search a Discussion</button><br>
            <br>
            <button id='sign-out'>Sign Out</button><br>
        </div>
            
        <div id='layout-content'>
            Results will be displayed here.
        </div>
    </div>
    
    <!-- forms -->
    
    <form method='post' action='forum_controller.php' id='form-signout' style='display:none'>
        <input type='hidden' name='page' value='MainPage'>
        <input type='hidden' name='command' value='SignOut'>
    </form>

    <!-- modal windows -->
   <!--  
    <div id='blanket'>
    </div>

    <div id='modal-postaquestion' class='modal-window'>
        <h2 style='text-align:center'>Post a Question!</h2>
        <br>
        <form method='POST' action='w7_controller.php'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='PostAQuestion'>
            <input id='postaquestion-question' type='text' size='50' name='question' placeholder='Question' required> 
            <br>
            <input id='postaquestion-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
        </form>
            <input id='postaquestion-submit' type='button' value='Submit' style='margin:10px; position:absolute; right:0; bottom:0'>
    </div>

    <div id='modal-searchquestions' class='modal-window'>
        <h2 style='text-align:center'>Search Questions!</h2>
        <br>
        <form method='POST' action='w7_controller.php'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='SearchQuestions'>
            <input id='searchquestions-term' type='text' size='50' name='term' placeholder='Search term' required> 
            <br>
            <input id='searchquestions-cancel' type='button' value='Cancel' style='margin:10px; position:absolute; left:0; bottom:0'>
        </form>
            <input id='searchquestions-submit' type='button' value='Submit' style='margin:10px; position:absolute; right:0; bottom:0'>
    </div>
    -->
</body>
</html>
 <!--
<script>
    

    // Post a question
    
    $('#post-a-discussion').click(function() {
        $("#blanket").show();
        $("#modal-postaquestion").show();
    });
    
    $("#postaquestion-submit").click(function() {
        var question = $('#postaquestion-question').val().trim();
        $("#postaquestion-cancel").click();
        if (question.length == 0) return;
        var xhttp = new XMLHttpRequest();  // create an AJAX object
        xhttp.onreadystatechange = function() {  // register an event handler for the onreadystatechange event
            if (this.readyState == 4 && this.status == 200) {  // check readyState and status
                //alert(this.responseText);  // text response
                $('#layout-content').html(this.responseText);  // display the text response to the above <div> using jQuery
            }
        };
        var url = "w7_controller.php";
        var query="page=MainPage&command=PostAQuestion&question=" + question;
        xhttp.open('POST', url);  // open the channel using the POST method
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    });
    
    $("#postaquestion-cancel").click(function() {
        $("#blanket").hide();
        $("#modal-postaquestion").hide();
    });
    
    // Search questions

    $('#search-discussions').click(function() {
        $("#blanket").show();
        $("#modal-searchquestions").show();
    });
    
    
    
    function closeSearchQuestionsModalWindow() {
        $("#blanket").hide();
        $("#modal-searchquestions").hide();
    }
    
    $("#searchquestions-cancel").click(function() {
        closeSearchQuestionsModalWindow();
    });

    $('#searchquestions-submit').click(list_questions);
function list_questions() {
    var url = "w7_controller.php"; 
    var query = {page: "MainPage", command: "SearchQuestions", term: $('#searchquestions-term').val() };
   
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
                        t += "<button class = 'delete' type='button' data-q-id='" + rows[i]['Id']  + "'>Delete</button>"; 
                    t += "</td>";
                t += "</tr>";
            }
        t += "</table>";
        $('#layout-content').html(t);
 
        
        $('.delete').click(function() { 
            $(this).parent().parent().remove();
            var url = "w7_controller.php";
            var query = {page: "MainPage", command: "DeleteQuestion", qid: $(this).attr('data-q-id')};
            $.post(url, query,function(data) {

                    $('#layout-content').html(this.responseText);
                   
                 });
        });
    });
}
  -->
  <script>
//document.getElementById('sign-out').addEventListener('click', function() {
 //       document.getElementById('form-signout').submit();
 //   });
    
    var timer = setTimeout(timeout, 10 * 1000);
    window.addEventListener('mousemove', event_listener_mousemove_or_keydown);  // mousemove on the screen
    window.addEventListener('keydown', event_listener_mousemove_or_keydown);  // for keyboard action
    window.addEventListener('unload', function() {  // when the window is closed
        timeout();  // ...
    });
    function event_listener_mousemove_or_keydown() {
        clearTimeout(timer);
        timer = setTimeout(timeout, 10 * 1000);
    }
    function timeout() {
        document.getElementById('form-signout').submit();  // send the 'SignOut' command to the controller
    }

</script>
