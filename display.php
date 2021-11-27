<?php

$conn =  mysqli_connect('localhost', 'zilyassova', 'zilyassova136', 'C354_zilyassova');


if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>