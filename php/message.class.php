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
			setcookie('scroll', 1, 0, "/");
			echo '
				<script type="text/javascript">
			        window.location.href="message_board.php?page='.$page.'";
				</script>';
		}

		public function parse_bbc($word, $trd){
		    $find = array(
		    	"/\[url\]\[img\](.+?)\[\/img\]\[\/url\]/is",
		    	"/\[img\](.+?)\[\/img\]/is",
		    	"/\[url\](.+?)\[\/url\]/is",
		        "/\[url\=(.+?)\](.+?)\[\/url]/is",
		        "/\[b\](.+?)\[\/b\]/is", 
		        "/\[br\/\]/is",
		        "/(\nhttps?:\/\/\S+)/is",
		        "/(^https?:\/\/\S+)/is",
		        "/( https?:\/\/\S+)/is",
		        "/(\])(https?:\/\/\S+)/is",
		        "/\[i\]/is",
		        "/\[\/i\]/is", 
		        "/\[u\]/is",
		        "/\[\/u\]/is", 
		        "/\[s\]/is",
		        "/\[\/s\]/is", 
		        "/\[code\](.+?)\[\/code\]/is", 
		        "/\[quote\=(.+?)\]/is",
		        "/(.+?)/is",
		        "/\[\/quote\]/is",
		        "/\[quote\]/is",
		        "/\[video\](.+?)\[\/video\]/is", 
		        "/\[dailymotion\](.+?)\[\/dailymotion\]/is", 
		        "/\[vimeo\](.+?)\[\/vimeo\]/is", 
		        "/\[color\=(.+?)\](.+?)\[\/color\]/is",
		        "/\[size\=(.+?)\](.+?)\[\/size\]/is", 
		        "/\[font\=(.+?)\](.+?)\[\/font\]/is",
		        "/\[center\](.+?)\[\/center\]/is",
		        "/\[right\](.+?)\[\/right\]/is",
		        "/\[left\](.+?)\[\/left\]/is",
		        "/\[email\](.+?)\[\/email\]/is"
		    );

		    $replace = array(
		    	"<a href=\"$1\" target=\"_blank\"><img  src=\"$1\" class=\"imgmess\" alt=\"Responsive image\" /></a>",
		    	"<img src=\"$1\" class=\"imgmess\" alt=\"Responsive image\" />",
		    	"<a href=\"$1\" target=\"_blank\">$1</a>",
		        "<a href=\"$1\" target=\"_blank\">$2</a>",
		        "<strong>$1</strong>",
		        "<br>",
		        "<a href=\"$1\" target=\"_blank\">$1</a>",
		        "<a href=\"$1\" target=\"_blank\">$1</a>",
		        "<a href=\"$1\" target=\"_blank\">$1</a>",
		        "]<a href=\"$2\" target=\"_blank\">$2</a>",
		        "<em>",
		        "</em>",
		        "<span style=\"text-decoration:underline;\">",
		        "</span>",
		        "<del>",
		        "</del>",
		        "<code class=\"bbc_code\">$1</code>",
		        "<div class=\"quoteheader\">".CLASS_MESSAGE_QUOTED." - $1</div><div class=\"bbc_standard_quote\">",
		        "$1",
		        "</div>",
		        "<div class=\"quoteheader\">".CLASS_MESSAGE_QUOTED."</div><div class=\"bbc_standard_quote\">",
		        "<div class=\"flex-video widescreen\"><iframe wmode=\"transparent\"  src=\"//www.youtube.com/embed/$1?wmode=transparent\" frameborder=\"0\" allowfullscreen seamless></iframe></div>",
		        "<iframe frameborder=\"0\" width=\"480\" height=\"270\" src=\"http://www.dailymotion.com/embed/video/$1\"  allowfullscreen></iframe>",
		        "<iframe src=\"//player.vimeo.com/video/$1\" width=\"500\" height=\"375\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>",
		        "<span style=\"color:$1\">$2</span>",
		        "<span style=\"font-size:$1\">$2</span>",
		        "<span style=\"font-family: $1\">$2</span>",
		        "<div style=\"text-align:center;\">$1</div>",
		        "<div style=\"text-align:right;\">$1</div>",
		        "<div style=\"text-align:left;\">$1</div>",
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
				echo '<p class="nobr">'.CLASS_MESSAGE_TODAY.'</p>';
			}elseif($date_fr == date('d/m/Y', strtotime('-1 day'))){
				echo '<p class="nobr">'.CLASS_MESSAGE_YESTERDAY.'</p>';
			}else{
				echo '<p class="nobr">'.$date_fr.'</p>';
			}
		}

		public function viewby($id, $author){
			$sql = $this->_connexion->prepare("SELECT name FROM players WHERE lastmess >= :id");
			$sql-> bindParam('id', $id, PDO::PARAM_STR);
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($rows as $value) {
				if ($value['name'] != $author){
					$rows2[] = $value['name'];
				}
			}
			$tooltip = "";
			$tooltip =  '<span class="glyphicon glyphicon-eye-open tool" data-toggle="tooltip" data-placement="right" title="';
			if (isset($rows2)) {
				foreach ($rows2 as $value) {
					if ($value === end($rows2)) {
						$tooltip .= $value;
					}else{
						$tooltip .= $value.' / ';
					}
				}
			}
			
			$tooltip .= '"></span>';
			echo $tooltip;

		}


		public function getMessages($page, $author, $trd){
			$sql = $this->_connexion->prepare("SELECT * FROM  messages ORDER BY id ");
			$sql-> execute();
			$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

			if (!$rows) {
				echo CLASS_MESSAGE_NO_MESSAGE;
			}else{
				$cpt = 0;
				$deb = ($page-1)*20;
				$fin = ($page*20)-1;
				foreach($rows as $key => $value) {
					if($cpt>=$deb && $cpt<= $fin){
						echo '<div class="col-md-12 no-padd mess_board">';
						
						if ($value === end($rows)){
							echo '<a class="anchor" id="anchor" href="#last_message"></a>';
						}
						elseif ($cpt == $fin) {
							echo '<a class="anchor" id="anchor" href="#last_message"></a>';
						}		
							echo '<div id="'.$value['id'].'" class="col-md-12 no-padd mess_board messb">';			
									echo '<div class="col-md-2 topspace poster messbp">';
										echo '<p>'.htmlspecialchars($value['name']).'</p>';
										$this->avatar($value['name']);
										$date = explode(" ", $value['date']);
										$datefr = explode("-", $date[0]);
										$heure = explode(":", $date[1]);
										$date_fr = $datefr[2].'/'.$datefr[1].'/'.$datefr[0];
										$this->datemess($date_fr);
										echo '<p>'.$heure[0].':'.$heure[1].'</p>';
										$this->viewby($value['id'], $value['name']);
									echo '</div>';
			
									echo '<div class="col-md-10 topspace messbm">';
						 				echo $this->parse_bbc(htmlspecialchars($value['message']), $trd);
									echo '</div>';

							echo '</div>';
							echo '<div class="col-md-12 botspace bottmess no-padd">';
							echo '<div class="col-md-2">';
							echo '</div>';
							echo '<div class="col-md-10 brdbot">';
							
								echo '<div class="txtright">';
										echo "<p></p>";							
										echo ' <a href="message_board_quote.php?id='.$value['id'].'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-comment"></span> '.CLASS_MESSAGE_QUOTE.' </a> ';
										if ($author == $value['name'] ) {
											echo ' <a href="message_board_modify.php?id='.$value['id'].'&page='.$page.'" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> '.CLASS_MESSAGE_MODIFY.'</a>';
										}
								echo '</div>';
							echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-md-12 sepmess"></div>';
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
			if(($curentpage>$page)||($curentpage<1)){
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

		public function modifyMessage($name, $message, $id, $page){
			$message = nl2br($message);
			$patterns = '/<br \/>/';
			$replacements = '[br/]';
			$message = preg_replace($patterns, $replacements, $message);
			$sql = $this->_connexion->prepare("UPDATE messages SET message = :message WHERE name = :name AND id = :id");
			$sql-> bindParam('name', $name, PDO::PARAM_STR);
			$sql-> bindParam('message', $message, PDO::PARAM_STR);
			$sql-> bindParam('id', $id, PDO::PARAM_STR);
			$sql-> execute();
			setcookie('scrollto', $id, 0, "/");
			echo '
				<script type="text/javascript">
			        window.location.href="message_board.php?page='.$page.'";
				</script>';

		}

	}
