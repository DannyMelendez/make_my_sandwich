<?php 

    //database connection
    $conn = mysqli_connect('localhost', 'daniel', 'test123', 'make_my_sandwich');

    //database error check
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

?>