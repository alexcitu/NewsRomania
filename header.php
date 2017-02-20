<?php

    define("NROFNEWS", 3);

    if(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 || isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
    {
        $meniu = '<nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">News Romania</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="it.php">IT</a></li>
                <li><a href="economic.php">Economic</a></li>
                <li><a href="social.php">Social</a></li>
                <li><a href="sport.php">Sport</a></li>
              </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="test"><a href="#">'. "Salut " . $_SESSION['username'] . "!" .'</a>
                <div id="myPan"></div></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
          </div>
        </nav>';
    }
    else
    {
        $meniu = '<nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">News Romania</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="it.php">IT</a></li>
                <li><a href="economic.php">Economic</a></li>
                <li><a href="social.php">Social</a></li>
                <li><a href="sport.php">Sport</a></li>
              </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="login"><a href="login.php">Login</a></li>
                <li class="register"><a href="register.php">Register</a></li>
            </ul>
            </div>
          </div>
        </nav>';
    }

    $header = '<!DOCTYPE html> <html>
        <head>
            <title>'. $page_title .'</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link href="css/bootstrap.css" rel="stylesheet"> 

            <link href="css/custom.css" rel="stylesheet">  

            <script src="js/jquery.js"></script>

            <script src="js/bootstrap.js"></script>

            <script src="js/my-jquery.js"></script>

        </head>
        <body>'.$meniu.'

            <div class="container">

                <div id="output_width" class="my-img">  </div>';

    $search = '<div class="row">
            <form action="search.php" method="get" class="navbar-form navbar-right margin-bottom" role="search">
                <div class="form-group">
                    <input name="search_news" type="text" class="form-control search-form" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default buton-search">Submit</button>
            </form>
        </div>';
?>