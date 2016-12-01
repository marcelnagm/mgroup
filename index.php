<!DOCTYPE html>
<script>
document.getElementById('tempo').onkeypress =
  function (e) {
    var ev = e || window.event;
    if(ev.charCode < 48 || ev.charCode > 57) {
      return false; // not a digit
    } else if(this.value * 10 + ev.charCode - 48 > this.max) {
       return false;
    } else {
       return true;
    }
  }
</script>
    
<html lang="en">
    <head>

        <script src="layout/dist/js/jquery.js"></script>
        <script src="layout/dist/js/bootstrap.js" async=""></script>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Autopost- Up!</title>

        <!-- Bootstrap -->
        <link href="layout/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="layout/dist/css/bootstrap-theme.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Bootstrap theme</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href=".">Home</a></li>
<!--                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container theme-showcase" role="main">

            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h3>Auto-post , and auto-Up!</h3>
            </div>
            <div>
                <form action="data/process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="grupos">Arquivo de Grupos</label>
                        <input type="file" id="grupos" name="grupos">
                        <p class="help-block">Coloque o id do grupo , nome para sua identificação.</p>
                    </div>
                    <div class="form-group">
                        <label for="links">Arquivo de Ups!</label>
                        <input type="file" id="links" name="links">
                        <p class="help-block">Coloque cada id em uma linha para up</p>
                    </div>
                    <button type="submit" class="btn btn-default" value="Submit">Submit</button>
                </form>
                <?php
                ?>
                <h3>Lista de Grupos</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <td>
                                Group
                            </td>
                            <td>
                                Name
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $myfile = fopen('data/groups.txt', 'r');
                            while (!feof($myfile)) {
                                ?>
                            <tr>
                                <td>
                                    <?php
                                    $line = fgets($myfile);
                                    echo substr($line, 0, strpos($line, ','));
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo substr($line, strpos($line, ',') + 1, strlen($line));
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        fclose($myfile);
                        ?>
                        </tr>
                    </tbody>
                </table>
                <h3>Lista de Links</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <td>
                                Url
                            </td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $myfile = fopen('data/links.txt', 'r');
                            while (!feof($myfile)) {
                                ?>
                            <tr>
                                <td>
                                    <?php
                                    $line = fgets($myfile);
                                    $line  = str_replace( "/\r|\n/", "", $line );
                                    ?>
                                    <a href="<?php echo $line; ?>" target="_blank"> Link</a>

                                </td>                                
                            </tr>
    <?php
}
fclose($myfile);
?>
                        </tr>
                    </tbody>
                </table>
                <form action="data/process_time.php" method="post">
                    <div class="form-group">
                        <label for="grupos">Minutos entre os up dos links</label>
                        <input type="number" id="tempo" name="tempo" min="20" max="50">
                        <p class="help-block">Digite em quanto tempo deseja.</p>
                    </div>                    
                    <div class="form-group">
                        <label for="mensagem">Mensagem dos Up!</label>
                        <input type="text" id="mensagem" name="mensagem">                        
                    </div>                    
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../../dist/js/bootstrap.min.js"></script>
        <script src="../../assets/js/docs.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>


        <div id="global-zeroclipboard-html-bridge" class="global-zeroclipboard-container" style="position: absolute; left: 0px; top: -9999px; width: 15px; height: 15px; z-index: 999999999;" title="" data-original-title="Copy to clipboard">      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="/assets/flash/ZeroClipboard.swf?noCache=1479833229264">         <param name="allowScriptAccess" value="sameDomain">         <param name="scale" value="exactfit">         <param name="loop" value="false">         <param name="menu" value="false">         <param name="quality" value="best">         <param name="bgcolor" value="#ffffff">         <param name="wmode" value="transparent">         <param name="flashvars" value="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com">         <embed src="/assets/flash/ZeroClipboard.swf?noCache=1479833229264" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="100%" height="100%" name="global-zeroclipboard-flash-bridge" allowscriptaccess="sameDomain" allowfullscreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="trustedOrigins=getbootstrap.com%2C%2F%2Fgetbootstrap.com%2Chttp%3A%2F%2Fgetbootstrap.com" scale="exactfit">                </object></div><svg xmlns="http://www.w3.org/2000/svg" width="1140" height="500" viewBox="0 0 1140 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="57" style="font-weight:bold;font-size:57pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thirdslide</text></svg></body>
</html>