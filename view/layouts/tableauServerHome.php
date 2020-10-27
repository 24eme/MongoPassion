	<div class="bg-light m-auto">
		<div class="border">
			<?php
				$serve_list=json_decode($_COOKIE['serve_list']);
				if(sizeof($serve_list)>0){
					echo '<table class="table table-sm table-striped serverlist">';
					echo  	"<h3 class=\"text-center bg-success text-light\"><span><strong>Server list </strong></span></h3>" ;
					foreach ($serve_list as $x) {
						echo '<tr>';
						echo "<td><a  class='text-success'  href='index.php?action=getServer&serve=".$x."'><i title='address IP of server' class='text-dark mr-2 fa fa-fw fa-desktop'></i>";
						echo $x;
						echo '</a></td>';
						echo '<td class="text-right"><a href="?modal_opened=1&serve='.$x.'"><i title="Edit server" class="fa fa-fw fa-edit"></i></a> &nbsp; <a href="?action=removeServer&serve='.$x.'" class="text-mutted"><i title="Delete server" class="fa fa-fw fa-remove"></i></a></td>';
						echo '</tr>';
					}
					echo '</table>';
				}
			?>
		</div>
	</div>