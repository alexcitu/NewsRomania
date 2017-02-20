<?php
    session_start();
    $page_title = 'News Romania';
    require_once('header.php');
    require_once('footer.php');
	require_once('class.database.php');
    echo $header;
    echo $search;
?>

    <div class="row pad-top-30">
        <div class="col-md-8 col-md-offset-2">
            <div class="well">
                <?php

                    $id = $_GET['edit'];
                    $_SESSION['idToEdit'] = $id;
                    $_SESSION['referinta'] = $_SERVER['HTTP_REFERER'];
                    
					$conexiune = new Conexiune();
                    $row = $conexiune->getNewsById($id);

                    if(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 || isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                    {
                        echo '<form action="updateDatabase.php" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Titlu</label>
                                    <input name="titlu" type="text" class="form-control" value="'. $row['titlu'] .'">
                                </div>
                                <div class="form-group">
                                    <label>Descriere</label>
                                    <textarea name="continut" class="form-control" rows="5">'. $row['continut'] .'</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Link for Read More</label>
                                    <input name="link" type="text" class="form-control" value="'. $row['link'] .'">
                                </div>
                                <div class="form-group">
                                    <label>Tip Stire</label>
                                    <input name="tip" type="text" class="form-control" value="'. $row['tip'] .'" readonly>
                                </div>
                                 <div class="form-group">
                                    <label>Imagine</label>
                                    <input type="file" name="fileToUpload">
                                </div>
                                <button type="submit" class="btn btn-default" name="submit">Edit</button>
                            </form>';
                    }
                 ?>
            </div>
        </div>
    </div>
			
<?php echo $footer; ?>