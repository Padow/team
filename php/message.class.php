<?php  
	class Message extends Connexion{

		private $_word;
		private $_numMess;
		private $_page;
		private $_lastid;
		private $_quote;

		public function __construct()
		{
			$this->_connexion = parent::__construct();
		}

		public function setMessage($name, $message){
			$message = nl2br($message);
			$patterns = '/<br \/>/';
			$replacements = '[br/]';
			$message = preg_replace($patterns, $replacements, $message);
			$sql = $this->_connexion->prepare("INSERT INTO  messages (name, message) VALUES (:name, :message) ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('message', $message, PDO::PARAM_STR);
			$sql-> execute();
			$page =  $this->nbpage();
			echo '
				<script type="text/javascript">
			        window.location.href="message_board.php?page='.$page.'";
				</script>';
		}

		public function parse_bbc($word){
		    $find = array(
		        "/\[url\=(.+?)\](.+?)\[\/url\]/is",
		        "/\[url\](.+?)\[\/url\]/is",
		        "/\[b\](.+?)\[\/b\]/is", 
		        "/(.+?)\[br\/\]/is",  
		        "/\[br\/\]/is",  
		        "/\[i\](.+?)\[\/i\]/is", 
		        "/\[u\](.+?)\[\/u\]/is", 
		        "/\[s\](.+?)\[\/s\]/is", 
		        "/\[code\](.+?)\[\/code\]/is", 
		        "/\[quote\=(.+?)](.+?)\[\/quote\]/is",
		        "/\[quote\](.+?)\[\/quote\]/is",
		        "/\[video\](.+?)\[\/video\]/is", 
		        "/\[dailymotion\](.+?)\[\/dailymotion\]/is", 
		        "/\[vimeo\](.+?)\[\/vimeo\]/is", 
		        "/\[color\=(.+?)\](.+?)\[\/color\]/is",
		        "/\[size\=(.+?)\](.+?)\[\/size\]/is", 
		        "/\[font\=(.+?)\](.+?)\[\/font\]/is",
		        "/\[center\](.+?)\[\/center\]/is",
		        "/\[right\](.+?)\[\/right\]/is",
		        "/\[left\](.+?)\[\/left\]/is",
		        "/\[img\](.+?)\[\/img\]/is",
		        "/\[email\](.+?)\[\/email\]/is"
		    );

		    $replace = array(
		        "<a href=\"$1\" target=\"_blank\">$2</a>",
		        "<a href=\"$1\" target=\"_blank\">$1</a>",
		        "<strong>$1</strong>",
		        "<p>$1</p>",
		        "<p></p>",
		        "<em>$1</em>",
		        "<span style=\"text-decoration:underline;\">$1</span>",
		        "<del>$1</del>",
		        "<code class=\"bbc_code\">$1</code>",
		        "<div class=\"quoteheader\">Citation : $1</div><div class=\"bbc_standard_quote\">$2</div>",
		        "<div class=\"quoteheader\">Citation</div><div class=\"bbc_standard_quote\">$1</div>",
		        "<iframe wmode=\"transparent\" width=\"640\" height=\"480\" class=\"hidden-xs\" src=\"//www.youtube.com/embed/$1?wmode=transparent\" frameborder=\"0\" allowfullscreen seamless></iframe>",
		        "<iframe frameborder=\"0\" width=\"480\" height=\"270\" src=\"http://www.dailymotion.com/embed/video/$1\"  allowfullscreen></iframe>",
		        "<iframe src=\"//player.vimeo.com/video/$1\" width=\"500\" height=\"375\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>",
		        "<font color=\"$1\">$2</font>",
		        "<span style=\"font-size:$1\">$2</span>",
		        "<span style=\"font-family: $1\">$2</span>",
		        "<div style=\"text-align:center;\">$1</div>",
		        "<div style=\"text-align:right;\">$1</div>",
		        "<div style=\"text-align:left;\">$1</div>",
		        "<img  src=\"$1\" class=\"imgmess\" alt=\"Responsive image\" />",
		        "<a href=\"mailto:$1\" target=\"_blank\">$1</a>"
		    );

		   $this->_word = preg_replace($find, $replace, $word);
		   return $this->_word;
		}

		public function avatar($name){
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			    $dir = "uploads/".utf8_decode($name);
				$arr = glob($dir.".*");
				if($arr){
					foreach ($arr as $filename) {
						echo   '<img class="avatar" alt="avatar" src="'.utf8_encode($filename).'">';
					}
				}
			} else {
			    $dir = "uploads/".$name;
				$arr = glob($dir.".*");
				if($arr){
					foreach ($arr as $filename) {
						echo   '<img class="avatar" alt="avatar" src="'.$filename.'">';
					}
				}
			}	
		}

		public function datemess($date_fr){
			if($date_fr == date('d/m/Y')){
				echo '<p class="nobr">Aujourd\'hui</p>';
			}elseif($date_fr == date('d/m/Y', strtotime('-1 day'))){
				echo '<p class="nobr">Hier</p>';
			}else{
				echo '<p class="nobr">'.$date_fr.'</p>';
			}
		}


		public function getMessages($page, $author){
			$sql = $this->_connexion->prepare("SELECT * FROM  messages ORDER BY id ");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

			if (!$rows) {
				echo "No Message";
			}else{
				$cpt = 0;
				$deb = ($page-1)*20;
				$fin = ($page*20)-1;
				foreach($rows as $key => $value) {
					if($cpt>=$deb && $cpt<= $fin){
						echo '<div class="col-md-12 no-padd mess_board">';			
							echo '<div class="col-md-12 no-padd mess_board messb">';			
									echo '<div class="col-md-2 topspace poster messbp">';
										echo '<p>'.htmlspecialchars($value['name']).'</p>';
										$this->avatar($value['name']);
										$date = explode(" ", $value['date']);
										$datefr = explode("-", $date[0]);
										$heure = explode(":", $date[1]);
										$date_fr = $datefr[2].'/'.$datefr[1].'/'.$datefr[0];
										$this->datemess($date_fr);
										echo '<p>'.$heure[0].':'.$heure[1].'</p>';
									echo '</div>';
			
									echo '<div class="col-md-10 topspace messbm">';
						 				echo $this->parse_bbc(htmlspecialchars($value['message']));
									echo '</div>';

							echo '</div>';
							echo '<div class="col-md-12 botspace bottmess no-padd">';
							echo '<div class="col-md-2">';
							echo '</div>';
							echo '<div class="col-md-10 brdbot">';
							
								echo '<div class="txtright">';
										echo "<p></p>";							
										echo ' <a href="message_board_quote.php?id='.$value['id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-comment"></span> Citer </a> ';
										if ($author == $value['name'] ) {
											echo ' <a href="message_board_modify.php?id='.$value['id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Modifier</a>';
										}
								echo '</div>';
							echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-md-12 sepmess">&nbsp;</div>';
					}
					$cpt++;
				}
			}
		}

		public function count_mess(){
			$sql = $this->_connexion->prepare("SELECT id FROM  messages ORDER BY id DESC ");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			$this->_numMess = count($rows);
			return $this->_numMess;
		}

		public function last_id(){
			$sql = $this->_connexion->prepare("SELECT id FROM  messages ORDER BY id DESC ");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			if($rows)
				$this->_lastid = $rows[0]['id'];
			else
				$this->_lastid = null;
			return $this->_lastid;
		}

		public function lastmess($name){
			$lastmess = $this->last_id();
			$sql = $this->_connexion->prepare("UPDATE players SET lastmess = :lastmess WHERE name = :name");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('lastmess', $lastmess, PDO::PARAM_STR);
			$sql-> execute();
		}

		public function newMessage($name){
			$lastmess = $this->last_id();
			$sql = $this->_connexion->prepare("SELECT lastmess FROM  players WHERE name = :name ");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			if($rows){
				$lastmessseen = $rows[0]['lastmess'];
				$newmess = $lastmess-$lastmessseen;
			}	
			else
				$newmess = 0;
			
			if($newmess>0)
				echo '<span class="badge nbd">'.$newmess.'</span>';

		}

		public function nbpage(){
			$pge = $this->count_mess();
			if($pge == 0)
				$pge = 1;
			$this->_page = ceil($pge/20);
			return $this->_page;
		}

		public function pagination($curentpage){
			$page =  $this->nbpage();
			if($curentpage>$page){
				header('location: message_board.php?page='.$page);
			}
			$prev = $curentpage-1;
			$next = $curentpage+1;

			$pagination = array();
			for ($i=0; $i < 3; $i++) { 
				$firstpage = 1+$i;
				if($firstpage<=$page){
					if(!in_array($firstpage, $pagination))
						$pagination[] = $firstpage;
				}
			}

			for ($i=0; $i < 3; $i++) { 
				$lastpage = $page-$i;
				if($lastpage>0){
					if(!in_array($lastpage, $pagination))
						$pagination[] = $lastpage;
				}
			}

			for ($i=0; $i < 2 ; $i++) { 
				$prevcurrent = $curentpage-$i;
				if($prevcurrent>0){
					if(!in_array($prevcurrent, $pagination))
						$pagination[] = $prevcurrent;
				}
			}

			for ($i=0; $i < 2 ; $i++) { 
				$nextcurrent = $curentpage+$i;
				if($nextcurrent<$page){
					if(!in_array($nextcurrent, $pagination))
						$pagination[] = $nextcurrent;
				}
			}

			asort($pagination);

			$cpt = 0;
			foreach ($pagination as $value) {
				$cpt++;
				if($value!= $cpt){
					$affpage[] = "...";
					$cpt = $value;
				}
				$affpage[] = $value;
					
			}


			echo '<ul class="pagination pagination-sm no-marg">';
			if($curentpage == 1){
				echo'<li class="disabled"><a href="#">&laquo;</a></li>';
			}else{
				echo '<li><a href="message_board.php?page='.$prev.'">&laquo;</a></li>';
			}

				foreach ($affpage as $value) { 
					if($value == $curentpage)
						echo '<li class="active"><a href="message_board.php?page='.$value.'">'.$value.'</a></li>';
					elseif($value == "...")
						echo '<li class="disabled"><a href="#">'.$value.'</a></li>';
					else
						echo '<li><a href="message_board.php?page='.$value.'">'.$value.'</a></li>';
				}

			if($curentpage == $page)	
				echo '<li class="disabled"><a href="#">&raquo;</a></li>';
			else
				echo '<li><a href="message_board.php?page='.$next.'">&raquo;</a></li>';
				echo '</ul>';
		}


		public function quote($id){
			$sql = $this->_connexion->prepare("SELECT * FROM  messages WHERE id = :id ");
			$sql-> bindParam('id', $id, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			$this->_quote = $rows;
			return $this->_quote;
		}

		public function modifyMessage($name, $message, $id){
			$message = nl2br($message);
			$patterns = '/<br \/>/';
			$replacements = '[br/]';
			$message = preg_replace($patterns, $replacements, $message);
			$sql = $this->_connexion->prepare("UPDATE messages SET message = :message WHERE name = :name AND id = :id");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('message', $message, PDO::PARAM_STR);
			$sql-> bindParam('id', $id, PDO::PARAM_STR);
			$sql-> execute();
			$page =  $this->nbpage();
			echo '
				<script type="text/javascript">
			        window.location.href="message_board.php?page='.$page.'";
			        

				</script>';

		}

	}
?>
