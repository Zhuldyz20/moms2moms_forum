<?php
$conn = mysqli_connect('localhost', 'zilyassova', 'zilyassova136', 'C354_zilyassova');

/*
*   User management
*/

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
