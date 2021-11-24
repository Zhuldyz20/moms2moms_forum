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


function  PostAQuestion($q,$uid,$t){
 global $conn;
    $current_date = date("Ymd"); 
    $sql = "insert into ForumQuestions values (NULL, '$q', $uid, '$t') ";  
    $result = mysqli_query($conn, $sql);
    return $result;        
}


function SearchQuestions($term){
    global $conn;
    $sql = "select Topic from ForumQuestions where Topic like '%$term%'";  // where Question is like 
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result))
    $data[] = $row;
    return $data;


}

function deleteProfile($id){
    global $conn;
    $sql = "delete from ForumUsers where Id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;

}