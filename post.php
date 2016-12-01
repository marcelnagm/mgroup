<?php
$myfile = file_get_contents("http://marcel.engelsoft.com.br/key/appid");;
$ids = explode(',', $myfile);
//var_dump($ids);