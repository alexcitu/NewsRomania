<?php
    session_start();
    $page_title = 'News Romania';
    require_once('header.php');
    require_once('continut-pagina.php');
    require_once('footer.php');
    echo $header;
    echo $search;
?>

    <div class="row pad-top-30">
        <div class="col-md-8">
            <div class="well">
                <?php
                    if(isset($_GET['search_news']) && $_GET['search_news'] != "")
                    {
                        cautare_stiri($_GET['search_news']);
                    }
                    else
                    {
                        if($_SERVER['HTTP_REFERER'] == 'http://localhost/paw/')
                        {
                            echo "<script>
                                window.location.href='index.php';
                                </script>";
                        }
                        else
                        {
                            header("Location:" . basename($_SERVER['HTTP_REFERER']).PHP_EOL);
                            exit();
                        }
                    }
                ?>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="list-group">
                <a href="index.php" class="list-group-item active">Home</a>
                <a href="it.php" class="list-group-item">IT</a>
                <a href="economic.php" class="list-group-item">Economic</a>
                <a href="social.php" class="list-group-item">Social</a>
                <a href="sport.php" class="list-group-item">Sport</a>
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
        </div>
    </div>
			
<?php echo $footer; ?>