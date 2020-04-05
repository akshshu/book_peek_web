<?php
//connect to database
$conn = mysqli_connect('localhost', 'aksh', 'akash1234', 'asg_books');
//check connection
if (!$conn) {
    echo 'connection error:' . mysqli_connect_error();
}
