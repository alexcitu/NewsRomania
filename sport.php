<?php
    session_start();
    $_SESSION['tip'] = "sport";
    $page_title = 'Sport News';
    require_once('header.php');
    require_once('continut-pagina.php');
    require_once('footer.php');
    echo $header;
    echo $search;
?>

    <div class="row pad-top-30">
        <div class="inner-page col-md-8">
            <div class="well">
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

            <div class="grey-list list-group">
                <div class="topNews">Cele mai apreciate stiri</div>
                <?php   
                    $conexiune = new Conexiune(); 
                    $result = $conexiune->getTopNews($_SESSION['tip'], NROFNEWS);
                    while ($row = $result->fetch_assoc()) 
                    {
                        $stire = $conexiune->getNewsById($row['id']); ?>
                        <a href="search.php?search_news=<?php echo $stire['titlu']; ?>" class="list-group-item">
                            <h4 class="list-group-item-heading"><?php echo $stire['titlu']; ?></h4>
                        </a>
                <?php } ?>
            </div>
            <br>
            <div class="list-group list-group">
                <a href="index.php" class="list-group-item">Home</a>
                <a href="it.php" class="list-group-item">IT</a>
                <a href="economic.php" class="list-group-item">Economic</a>
                <a href="social.php" class="list-group-item">Social</a>
                <a href="sport.php" class="list-group-item active">Sport</a>
            </div><!-- /. list-group -->

        </div><!-- /. col-md-4 -->           
    </div> <!-- /row -->  

<?php echo $footer; ?>