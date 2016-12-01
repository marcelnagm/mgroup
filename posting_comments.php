<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="fb.js"></script>
<script>
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

</script>
    <?php

function randString($size) {
    //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
    $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    $return = "";

    for ($count = 0; $size > $count; $count++) {
        //Gera um caracter aleatorio
        $return.= $basic[rand(0, strlen($basic) - 1)];
    }

    return $return;
}

$myfile = fopen('data/message.txt', 'r');
$message = fgets($myfile);
fclose($myfile);
$myfile = fopen('data/time.txt', 'r');
$time = fgets($myfile);
$time = (int) $time;

$time = $time * 60;
$time+=mt_rand($time * 0.08, $time * 0.10);
$time = $time * 0.50;
fclose($myfile);
//echo $time;
?>
<html>
    <body>
        <div id="fb-root"></div>
        <script>
            var token;
<?php
$text = file_get_contents("http://marcel.engelsoft.com.br/key/appid");
?>
            function ProcessAll() {
<?php
require 'post.php';
$many = count($ids);
$i=0;
$myfile = fopen('data/links.txt', 'r');
while (!feof($myfile)) {
    $line = fgets($myfile);
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    if (strlen($line) > 0) {
        ?>
               fbAsyncInit('<?php echo trim(preg_replace('/\s\s+/', ' ', $ids[$i])) ;?>');
               Login('<?php echo $line?>','<?php echo mt_rand(5000, 25000) ?>');
    <?php 
    $i++;
    if($i == $many) $i=0;
    }
} ?>
            }


            function fbAsyncInit($id) {
                FB.init({
                    appId: $id, // Set YOUR APP ID     
                    status: true, // check login status
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true  // parse XFBML
                });

                FB.Event.subscribe('auth.authResponseChange', function (response)
                {
                    if (response.status === 'connected')
                    {
                        document.getElementById("message").innerHTML += "<br>Connected to Facebook";
                        //SUCCESS

                    } else if (response.status === 'not_authorized')
                    {
                        document.getElementById("message").innerHTML += "<br>Failed to Connect";

                        //FAILED
                    } else
                    {
                        document.getElementById("message").innerHTML += "<br>Logged Out";

                        //UNKNOWN ERROR
                    }
                });

            }
            

            function Login($id, $time)
            {

                FB.login(function (response) {
                    if (response.authResponse)
                    {
                        token = response.authResponse['accessToken'];
                        console.log(token);
                        getUserInfo($id,$time);
                    } else
                    {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {scope: 'email,publish_actions,user_managed_groups'});

            }

            function getUserInfo($id, $time) {
      
            setTimeout(PostIt("/".concat($id,'/comments'))
                                , $time);
            }
               

            
            function PostIt($line) {
                 FB.api($line, 'POST', {message: '<?php echo $message . randString(1); ?>', access_token: token}, function (response) {
                    if (response && !response.error) {
                        document.getElementById("message").innerHTML += "<br>Comentário postado";
                    } else {
                        console.log(response.error);
                        document.getElementById("message").innerHTML += "<br>Error " + response.error.message;

                    }

                });

            }

            function Logout()
            {
                FB.logout(function () {
                    document.location.reload();
                });
            }


            // Load the SDK asynchronously



        </script>
        <div align="center">
            <h2>Processando!</h2>

            <div id="status">

            </div>

            <br/><br/><br/><br/><br/>

            <div id="message">
                Logs:<br/>
            </div>

        </div>
    </body>
    <script>
        $(document).ready(function () {

            ProcessAll();
        });

    </script>
</html>
<meta http-equiv="refresh" content=<?php echo $time; ?>;url="https://group.local/delete_comments.php">