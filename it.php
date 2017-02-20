<?php
    session_start();
    $_SESSION['tip'] = "it";
    $page_title = 'IT News';
    require_once('header.php');
    require_once('continut-pagina.php');
    require_once('footer.php');
    echo $header;
    echo $search;
?>

    <div class="row pad-top-30">
        <div class="col-md-8">
            <div class="well">
                <h3>IT NEWS</h3>
                <!-- Carousel -->
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="images/it-news1.jpg" alt="IT NEWS">
                            <div class="carousel-caption">
                                Technically News
                            </div>
                        </div>

                         <div class="item">
                            <img src="images/it-news2.jpg" alt="IT NEWS">
                            <div class="carousel-caption">
                                Security News
                            </div>
                        </div>

                         <div class="item">
                            <img src="images/it-news3.jpg" alt="IT NEWS">
                            <div class="carousel-caption">
                               Latest News
                            </div>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <hr>

                <?php generareContinut($_SESSION['tip']); ?>

            </div>

        </div><!-- /. col-md-8 -->

        <!-- Sidebar -->
        <div class="col-md-4"> 
            <div class="well greywell">
                <h3>Quick Contact</h3>
                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Message</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Send</button>
                </form>
            </div>

            <div class="list-group list-group">
                <a href="index.php" class="list-group-item">Home</a>
                <a href="it.php" class="list-group-item active">IT</a>
                <a href="economic.php" class="list-group-item">Economic</a>
                <a href="social.php" class="list-group-item">Social</a>
                <a href="sport.php" class="list-group-item">Sport</a>
            </div>
        </div>          
    </div> 

<?php echo $footer; ?>