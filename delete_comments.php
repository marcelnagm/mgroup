<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="fb.js"></script>
<?php
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

            function fbAsyncInit() {
                FB.init({
                    appId: '743894209095848', // Set YOUR APP ID     
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

            function Login()
            {

                FB.login(function (response) {
                    if (response.authResponse)
                    {
                        token = response.authResponse['accessToken'];
                        console.log(token);
                        getUserInfo();
                    } else
                    {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {scope: 'email,publish_actions,user_managed_groups'});

            }

            function getUserInfo() {
                $my_name = '';
                $message = '<?php echo $message; ?>';
                FB.api(
                        "/me?fields=name",
                        function (response) {
                            if (response && !response.error) {
                                /* handle the result */
//                                console.log(response);
                                $my_name = response.name;
                            }
                        });
                $data = {message: '<?php echo $message ?>'};
<?php
$myfile = fopen('data/links.txt', 'r');
while (!feof($myfile)) {
    $line = fgets($myfile);
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    if (strlen($line) > 0) {
        ?>
                        FB.api(
                                "<?php echo '/' . $line . '/comments'; ?>",
                                function (response) {
                                    if (response && !response.error) {
                                        /* handle the result */
                                        //                                console.log(response);
                                        //                                console.log(response.data[0]);
                                        //                                console.log(response.data[1]);
                                        for (var l = response.data.length, i = 0; i < l; i++) {
                                            var obj = response.data[i];
//                                                                                console.log("quem : " + obj.from.id);
                                                                                console.log("id quem : " + obj.from.name);
                                                                                console.log("quem sou : " + $my_name);
                                                                                console.log("resultado : " + (obj.from.name == $my_name));
                                                                                console.log("resultado2 : " + (obj.message.includes($message)));
                                            if (obj.from.name == $my_name && obj.message.includes($message) ) {
                                                console.log('Sou eu!');
                                                alert('test');
                                                FB.api(
                                                        '/'.concat(obj.id),
                                                        "DELETE",{
                                                        access_token: token    
                                                        },
                                                        function (response) {
                                                            if (response && !response.error) {                                                                
                                                               console.log(response)     
                                                            }else console.log(response.error);
                                                        }
                                                );
                                            }
//                                            console.log(obj.id);
//                                            console.log(obj.message);
                                        }
                                    }
                                }
                        );
        <?php
    }
}
?>




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

            fbAsyncInit();
            Login();
//            getUserInfo();
        });

    </script>
</html>
<meta http-equiv="refresh" content=<?php echo $time; ?>;url="https://group.local/posting_comments.php">