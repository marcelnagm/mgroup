<?php

//echo $target_file;
// Check if image file is a actual image or fake image
if (!$_FILES['links']['error']) {
    //now is the time to modify the future file name and validate the file
    $new_file_name = 'links.txt'; //rename file
    //if the file has passed the test
    //move it to where we want it to be
    move_uploaded_file($_FILES['links']['tmp_name'], './' . $new_file_name);
    $message = 'Parabéns, arquivo aceito.';
    echo $message;    
?>
    <meta http-equiv="refresh" content=3;url="https://group.local">
    <?php    

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
}
?>

