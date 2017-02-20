<?php
	require_once('class.database.php');
		
	function generareContinut($tip)
	{
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
		}
		else
		{
			$username = "";
		}
		$output = '<div id="blog" class="well">';
		
		$conexiune = new Conexiune();
		$result = $conexiune->getPageContent($tip);
        
		while ($row = $result->fetch_assoc()) 
		{
			$output .= '<h3>' . $row['titlu'] . '</h3>';
			$output .= '<small>Posted on <strong>' . $row['data'] . '</strong> by <strong>' . strtoupper($row['prenume']) . " " . strtoupper($row['nume']) . '</strong></small>';
			$output .= '<img src="images/' . $row['image'] . '" alt="' . $row['image'] . '" />';
			$output .= '<p>' . $row['continut'] . '</p>';
			$output .= '<a class="readmore" href="' . $row['link'] . '" target="_blank">Read More</a>';
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			{
				$output .= '<form action="delete.php" method="get" class="deleteForm"> <button class="deleteAndEditButtons" type="submit" name="sterge" value="'.$row['id'].'">Sterge</button>
				</form>';
			}
			elseif(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 && $username == $row['username'])
			{
				$output .= '<form action="delete.php" method="get" class="deleteForm"> <button class="deleteAndEditButtons" type="submit" name="sterge" value="'.$row['id'].'">Sterge</button>
				</form>';
			}
			else
			{
				
			}
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			{
				$output .= '<form action="edit.php" method="get" class="editForm"> <button class="deleteAndEditButtons" type="submit" name="edit" value="'.$row['id'].'">Edit</button>
				</form>';
			}
			elseif(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 && $username == $row['username'])
			{
				$output .= '<form action="edit.php" method="get" class="editForm"> <button class="deleteAndEditButtons" type="submit" name="edit" value="'.$row['id'].'">Edit</button>
				</form>';
			}
			else
			{
				//$output .= ' <hr>';
			}
			$output .= '<div class="likeAndDislike"><a id="l'. $row['id'] .'" class="like" href="likeAndDislike.php?idStireLike='.$row['id'].'&username='. $username .'&tip='. $tip .'"><span class="glyphicon glyphicon-thumbs-up"></span><span class="ldnum">'. $conexiune->getNrOfLikes($row['id']) .'</span></a>';
			$output .= '<a id="d'. $row['id'] .'" class="dislike" href="likeAndDislike.php?idStireDislike='.$row['id'].'&username='. $username .'&tip='. $tip .'"><span class="glyphicon glyphicon-thumbs-down reverse"></span><span class="ldnum">'. $conexiune->getNrOfDislikes($row['id']) .'</span></a></div>';
            $output .= ' <hr>';
		}
		$output .= '</div>';
		$result->free();
		
		echo $output;
		
		if(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 || isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
		{
			echo '<form action="adauga.php" method="post" role="form" enctype="multipart/form-data">
					<div class="form-group">
						<label>Titlu</label>
						<input name="titlu" type="text" class="form-control" placeholder="...">
					</div>
					<div class="form-group">
						<label>Descriere</label>
						<textarea name="continut" class="form-control" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label>Link for Read More</label>
						<input name="link" type="text" class="form-control" placeholder="...">
					</div>
					<div class="form-group">
						<label>Tip Stire</label>
						<input name="tip" type="text" class="form-control" value="'. $tip .'" readonly>
					</div>
					 <div class="form-group">
						<label>Imagine</label>
						<input type="file" name="fileToUpload">
					</div>
					<button type="submit" class="btn btn-default" name="submit">Send</button>
				</form>';
		}
	}
	
	function cautare_stiri($cautat)
	{
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
		}
		else
		{
			$username = "";
		}
		$output = '<div id="blog" class="well">';
		
		$conexiune = new Conexiune();
		$result = $conexiune->searchNews($cautat);

		while ($row = $result->fetch_assoc()) 
		{
			$output .= '<h3>' . $row['titlu'] . '</h3>';
			$output .= '<small>Posted on <strong>' . $row['data'] . '</strong> by <strong>' . strtoupper($row['prenume']) . " " . strtoupper($row['nume']) . '</strong></small>';
			$output .= '<img src="images/' . $row['image'] . '" alt="' . $row['image'] . '" />';
			$output .= '<p>' . $row['continut'] . '</p>';
			$output .= '<a class="readmore" href="' . $row['link'] . '" target="_blank">Read More</a>';
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			{
				$output .= '<form action="delete.php" method="get" class="deleteForm"> <button class="deleteAndEditButtons" type="submit" name="sterge" value="'.$row['id'].'">Sterge</button>
				</form>';
			}
			elseif(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 && $username == $row['username'])
			{
				$output .= '<form action="delete.php" method="get" class="deleteForm"> <button class="deleteAndEditButtons" type="submit" name="sterge" value="'.$row['id'].'">Sterge</button>
				</form>';
			}
			else
			{
				//
			}
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			{
				$output .= '<form action="edit.php" method="get" class="editForm"> <button class="deleteAndEditButtons" type="submit" name="edit" value="'.$row['id'].'">Edit</button>
				</form> <hr>';
			}
			elseif(isset($_SESSION['reporter']) && $_SESSION['reporter'] == 1 && $username == $row['username'])
			{
				$output .= '<form action="edit.php" method="get" class="editForm"> <button class="deleteAndEditButtons" type="submit" name="edit" value="'.$row['id'].'">Edit</button>
				</form> <hr>';
			}
			else
			{
				//$output .= ' <hr>';
			}
		}
		$output .= '</div>';
		$result->free();
		
		echo $output;
	}
?>