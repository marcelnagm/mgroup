<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="fb.js"></script>

<html>
    <body>
        <div id="fb-root"></div>
        <script>
            function fbAsyncInit() {
                FB.init({
                    appId: '731100007041935', // Set YOUR APP ID     
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
            ;

            function Login()
            {

                FB.login(function (response) {
                    if (response.authResponse)
                    {
                        getUserInfo();
                    } else
                    {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                }, {scope: 'email,user_photos,user_videos,publish_actions,user_managed_groups'});

            }

            function getUserInfo() {
                $my_id = '100002462666032';
                $my_name = '';                
                $message = "UP!";
                FB.api(
                        "/me?fields=name",
                        function (response) {
                            if (response && !response.error) {
                                /* handle the result */
                                console.log(response);
                                $my_name = response.name;
                            }
                        });
                $data = {message: 'Vendo Bicicleta  ',
                    link: "https://www.facebook.com/marcel.nagm/posts/1180575782034499"
                };


//                FB.api('/102830909865592/feed', 'post',$data, function (response) {
//                    if (!response || response.error) {
//                        console.log('Error occured');
//                        console.log(response.error);
//                    } else {
//                        console.log('Post ID: ' + response.id);
//                        $post_id = response.id;
//                        $post_id = $post_id.substr($post_id.indexOf("_")+1,$post_id.length);
//                        console.log('Post ID: ' + $post_id);
     

 <?php                      $myfile = fopen('data/links.txt', 'r');
                            while (!feof($myfile)) {
                                  $line = fgets($myfile); 
                                  $line = trim(preg_replace('/\s\s+/', ' ', $line));
                                ?>
                FB.api(
                        "<?php  echo '/'.$line.'/comments'; ?>",
                        function (response) {
                            if (response && !response.error) {
                                /* handle the result */
//                                console.log(response);
//                                console.log(response.data[0]);
//                                console.log(response.data[1]);
                                for (var l = response.data.length, i = 0; i < l; i++) {
                                    var obj = response.data[i];
                                    console.log("quem : " + obj.from.id);
                                    console.log("id quem : " + obj.from.name);
                                    if (obj.from.name == $my_name && obj.message == $message) {
                                        console.log('Sou eu!');
                                        FB.api( 
                                                obj.id,
                                                "DELETE",
                                                function (response) {
                                                    if (response && !response.error) {
                                                        /* handle the result */
                                                    }
                                                }
                                        );

                                    }
                                    console.log(obj.id);
                                    console.log(obj.message);
                                }
                            }
                        }
                );
                <?php } ?>

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
            <h2>Facebook OAuth Javascript Demo</h2>

            <div id="status">
                Click on Below Image to start the demo: <br/>
                <img src="http://hayageek.com/examples/oauth/facebook/oauth-javascript/LoginWithFacebook.png" style="cursor:pointer;" onclick="Login()"/>
            </div>

            <br/><br/><br/><br/><br/>
            <canvas id="c">
                <img>
                
            </canvas>
            <div id="message">
                Logs:<br/>
            </div>

        </div>
    </body>
    <script>
        $(document).ready(function () {

            fbAsyncInit();
            Login();
            getUserInfo();
        });

    </script>
</html>