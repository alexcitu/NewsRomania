<?php
	class Conexiune
	{
		private $con;
		private $db_user;
		private $db_pass;
		private $db_name;
		private $db_host;
		
		public function __construct()
		{
			$this->db_user = "alex";
			$this->db_pass = "alex";
			$this->db_name = "paw_site";
			$this->db_host = "localhost";
			$this->con = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name) or die("Nu ma pot conecta la MySQL!");
		}
		
		public function getCon()
		{
			return $this->con;
		}
		
		public function getPageContent($tip)
		{
			$result = $this->con->query("SELECT * FROM stiri, login where tip='". $tip ."' and login.email = stiri.email ORDER BY data DESC;");
			return $result;
		}
		
		public function searchNews($search)
		{
			$likeSearch = '%' . $search . '%';
			$result = $this->con->query("SELECT * FROM stiri, login where login.email = stiri.email and (titlu like '". $likeSearch ."' or nume like '". $likeSearch ."' or prenume like '". $likeSearch ."' or continut like '". $likeSearch ."') ORDER BY data DESC;");
			return $result;
		}
		
		public function deleteNews($id)
		{
			$stmt = $this->con->prepare("DELETE FROM stiri WHERE id = ?;");
			$stmt->bind_param("i", $id);
			return $stmt->execute();
		}
		
		public function checkNews($titlu)
		{
			$stmt = $this->con->prepare("SELECT * FROM stiri where titlu = ?;");
			$stmt->bind_param("s", $titlu);
			$stmt->execute();
			return $stmt->num_rows;
		}
		
		public function addNews($titlu, $continut, $data, $target_file, $link, $tip, $email)
		{
			$stmt = $this->con->prepare("INSERT INTO stiri (titlu, continut, data, image, link, tip, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssss", $titlu, $continut, $data, $target_file, $link, $tip, $email);
			$stmt->execute();
		}
		
		public function getNewsById($id)
		{
			$result = $this->con->query("SELECT * FROM stiri where id = ". $id .";");
			$row = $result->fetch_assoc();
			return $row;
		}
		
		public function nrOfNewsByEmail($email)
		{
			$result = $this->con->query("SELECT COUNT(*) as nrStiri FROM stiri WHERE email = '". $email ."'");
			$row = $result->fetch_assoc();
			return $row['nrStiri'];
		}
		
		public function getUserDetailsByUsername($username)
		{
			$result = $this->con->query("SELECT * FROM login where username = '". $username ."';");
			$row = $result->fetch_assoc();
			return $row;
		}
		
		public function getUserDetailsByEmail($email)
		{
			$result = $this->con->query("SELECT * FROM login where email = '". $email ."';");
			$row = $result->fetch_assoc();
			return $row;
		}
		
		public function registerUser($username, $password, $nume, $prenume, $email)
		{
			$stmt = $this->con->prepare("INSERT INTO login (username, password, nume, prenume, email) VALUES (?, ?, ?, ?, ?)");
			$password = md5($password);
			$stmt->bind_param("sssss", $username, $password, $nume, $prenume, $email);
			$rez = $stmt->execute();
			return $rez;
		}
		
		public function updateNews($titlu, $continut, $data, $target_file, $link, $tip, $email, $id)
		{
			if($target_file != 1)
			{
				$stmt = $this->con->prepare("UPDATE stiri SET titlu = ?, continut = ?, data = ?, image = ?, link = ?, tip = ?, email = ? WHERE id = ?;");
				$stmt->bind_param("ssssssss", $titlu, $continut, $data, $target_file, $link, $tip, $email, $id);
				$stmt->execute();
			}
			else
			{
				$stmt = $this->con->prepare("UPDATE stiri SET titlu = ?, continut = ?, data = ?, link = ?, tip = ?, email = ? WHERE id = ?;");
				$stmt->bind_param("sssssss", $titlu, $continut, $data, $link, $tip, $email, $id);
				$stmt->execute();
			}
		}
        
        public function checkVote($id, $email)
        {
            $result = $this->con->query("SELECT * FROM likeanddislike WHERE id = ". $id ." and email = '". $email ."';");
            return $result;
        }
        
        public function getNrOfLikes($id)
        {
            $result = $this->con->query("SELECT COUNT(*) as nrLike FROM likeanddislike WHERE likeNews = 1 and id = " . $id . ";");
			$row = $result->fetch_assoc();
			return $row['nrLike'];
        }
        
        public function getNrOfDislikes($id)
        {
            $result = $this->con->query("SELECT COUNT(*) as nrDislike FROM likeanddislike WHERE dislikeNews = 1 and id = ". $id .";");
			$row = $result->fetch_assoc();
			return $row['nrDislike'];
        }
        
        public function like($id, $username, $tip)
        {
            $ok0 = 0;
            $ok1 = 1;
            $row = $this->getUserDetailsByUsername($username);
            $email = $row['email'];
            
            $result = $this->checkVote($id, $email);
            $row = $result->fetch_assoc();
            
            if($result->num_rows == 0)
            {
                $stmt = $this->con->prepare("INSERT INTO likeanddislike (id, email, likeNews, dislikeNews, tip) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isiis", $id, $email, $ok1, $ok0, $tip);
                $stmt->execute();
            }
            elseif($result->num_rows == 1 && $row['likeNews'] == 1)
            {
                $stmt = $this->con->prepare("UPDATE likeanddislike SET likeNews = ?, dislikeNews = ? WHERE id = ? and email = ?;");
                $stmt->bind_param("iiis", $ok0, $ok0, $id, $email);
                $stmt->execute();
            }
            elseif($result->num_rows == 1 && $row['likeNews'] == 0)
            {
                $stmt = $this->con->prepare("UPDATE likeanddislike SET likeNews = ?, dislikeNews = ? WHERE id = ? and email = ?;");
                $stmt->bind_param("iiis", $ok1, $ok0, $id, $email);
                $stmt->execute();
            }
        }
                
        public function disLike($id, $username, $tip)
        {
            $ok0 = 0;
            $ok1 = 1;
            $row = $this->getUserDetailsByUsername($username);
            $email = $row['email'];
            
            $result = $this->checkVote($id, $email);
            $row = $result->fetch_assoc();
            
            if($result->num_rows == 0)
            {
                $stmt = $this->con->prepare("INSERT INTO likeanddislike (id, email, likeNews, dislikeNews, tip) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isiis", $id, $email, $ok0, $ok1, $tip);
                $stmt->execute();
            }
            elseif($result->num_rows == 1 && $row['dislikeNews'] == 1)
            {
                $stmt = $this->con->prepare("UPDATE likeanddislike SET likeNews = ?, dislikeNews = ? WHERE id = ? and email = ?;");
                $stmt->bind_param("iiis", $ok0, $ok0, $id, $email);
                $stmt->execute();
            }
            elseif($result->num_rows == 1 && $row['dislikeNews'] == 0)
            {
                $stmt = $this->con->prepare("UPDATE likeanddislike SET likeNews = ?, dislikeNews = ? WHERE id = ? and email = ?;");
                $stmt->bind_param("iiis", $ok0, $ok1, $id, $email);
                $stmt->execute();
            }
        }
        
        public function getVotes($username, $tip)
        {
            $row = $this->getUserDetailsByUsername($username);
            $email = $row['email'];
            
            $result = $this->con->query("SELECT id, likeNews, dislikeNews FROM likeanddislike where email = '". $email ."' and tip = '". $tip ."';");
            return $result;
        }
        
        public function getTopNews($tip, $limit)
        {
            $result = $this->con->query("SELECT id, count(*) AS topNews FROM likeanddislike WHERE tip = '". $tip ."' and likeNews = 1 GROUP BY id ORDER BY topNews DESC LIMIT ". $limit .";");
            return $result;
        }
	}
?>