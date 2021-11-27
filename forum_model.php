<?php
$conn = mysqli_connect('localhost', 'zilyassova', 'zilyassova136', 'C354_zilyassova');

function isUserValid($u, $p) 
{
    global $conn;
    
    $sql = "select * from ForumUsers where Username = '$u' and Password = '$p'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function doesUserExist($u)
{
    global $conn;
    
    $sql = "select * from ForumUsers where Username = '$u'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function signupNewUser($u, $p, $e)
{
    global $conn;
    
    if (doesUserExist($u))
        return false;
    
    $sql = "insert into ForumUsers values (NULL, '$u', '$p', '$e')";
    $result = mysqli_query($conn, $sql);
    return true;
}

function getUserId($u) {

 global $conn;
   $sql = "select * from ForumUsers where Username = '$u'";  
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) <= 0)
        return -1;
    else {
        $row = mysqli_fetch_assoc($result);
        return $row['Id'];}

}

function getTopicId($t, $u) {
    global $conn;
    $sql = "select * from ForumTopic where Title = '$t' and Topic_Owner = '$u'";  
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) > 0)
     {
        $row = mysqli_fetch_assoc($result);
        return $row['Topic_Id'];
     }
     else 
     {
       return -1;
        }
 
}


function  insertNewTopic($t, $u){
 global $conn;
 
    $current_date = date("Ymd"); 
    $sql = "insert into ForumTopic values (NULL, '$t', $current_date, '$u' ) ";  
    $result = mysqli_query($conn, $sql);
    return $result;   
}

function insertNewForumText ($p, $t, $u){
    global $conn;
    $topic_id = getTopicId($t, $u); 
    $current_date = date("Ymd");
    $sql = "insert into ForumPosts values (NULL, $topic_id, '$p', $current_date, '$u') ";
    $result = mysqli_query($conn, $sql);
      return $result;

}


function SearchQuestions($term){
    global $conn;
    $sql = "select ForumPosts.Topic_Id, ForumTopic.Title, ForumPosts.Text, ForumPosts.Date, ForumPosts.Post_Owner from ForumPosts INNER JOIN ForumTopic ON ForumPosts.Topic_Id = ForumTopic.Topic_Id where Title like '%$term%'";  // where Question is like 
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result))
    $data[] = $row;
    return $data;


}
function deleteProfile($u, $p){
    global $conn;
    $sql = "delete from ForumUsers where Username = '$u' and Password = '$p'";
    $result = mysqli_query($conn, $sql);
    return $result;
    if (mysql_affected_rows() == 1)
      return true;
    else 
       return false;

}

function editProfile ($u, $p, $e){
    global $conn;
    $id = getUserId($u);
    $sql = "select * from ForumUsers where Id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    
    if($row['Id'] == $id){
        $sql2 = "update ForumUsers set Username = '$u', Password = '$p', Email = '$e' where Id = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        return $result2;

    }
}

function displayAll(){
    global $conn;
        
        $sql = "SELECT * FROM ForumPosts" ;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0)
            return true;
        else
            return false;
    
    }


    function displayYourPost($u) {
        global $conn;
        $sql = "select ForumPosts.Topic_Id, ForumTopic.Title, ForumPosts.Text, ForumPosts.Date, ForumPosts.Post_Owner from ForumPosts INNER JOIN ForumTopic ON ForumPosts.Topic_Id = ForumTopic.Topic_Id where Post_Owner = '$u'";
        $result = mysqli_query($conn, $sql);
        
    $posts = [];
    while($rows = mysqli_fetch_assoc($result))
        $posts[] = $rows;
    return $posts;
        
    
    
    
    }

    function deleteYourPost($qid){
        global $conn;
        $sql = "delete from ForumTopic where Topic_Id = '$qid'";
        $result = mysqli_query($conn, $sql);
        return $result;  
    }

?>