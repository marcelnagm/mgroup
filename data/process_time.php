<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$file = fopen("time.txt","w");
echo fwrite($file,$_POST['tempo']);
fclose($file);
$file = fopen("message.txt","w");
echo fwrite($file,$_POST['mensagem']);
fclose($file);

  $message = 'Parabéns, tempo setado o Script iniciará em 3 segundos.<br>';
    echo $message;    
  $message = 'Caso queira paralisar o script, pressione a tecla ESC';
    echo $message;    
    

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<meta http-equiv="refresh" content=3;url="https://group.local/posting_comments.php">