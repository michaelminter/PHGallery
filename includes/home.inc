<table class="gallery" cellpadding="0" cellspacing="0">
	<tr>
		<td class="content" valign="top">
			<?php
			// code for TOP of the page
			$start = microtime();
			$startarray = explode(" ", $start);
			$start = $startarray[1] + $startarray[0];

			// sets path: base dir + get dir
			$path = $cfg['gallery'];
				if($_GET['dir']) {  
					 $path .= '/' . $_GET['dir'];
				}
			$path .= '/';
			
			$dir_count = 0;
			$img_count = 0;
			
			// handle directories first
			$handle = opendir($path);
    		while (($dir = readdir($handle)) !== false) {
        		if ($dir != "." && $dir != ".." && is_dir($path . $dir)) {
					
					echo '<a href="' . $cfg['server'] . '?dir=';
					if ($_GET['dir']) {
						echo $_GET['dir'] . '/';
					}
						echo $dir . '">';
							//if (($scan = @scandir($path . '/' . $dir)) && count($scan) <= 2) {
								echo '<img src="images/gallery.png" width="100">';
								echo '<span>'.$dir.'</span>';
							//} else {
								//echo '<img src="' . $cfg['server'] . '/includes/image.php?image=' . $path . '' . $scan[3];
							//}
						echo '</a>' . "\n";
						$dir_count++;
        		}
    		}
    		// handle images
    		$handle = opendir($path);
			while (($file = readdir($handle)) !== false) {
				if ($file != "." && $file != ".." && !is_dir($path . '/' . $file)) {
					
					echo '<a href="' . $cfg['server'] . '?image=';
						if ($_GET['dir']) {
							echo $_GET['dir'] . '/';
						}
					echo $file . '">';
						echo '<img src="' . $cfg['server'] . '/includes/image.php?image=' . $path . '' . $file . '">';
					echo '</a>' . "\n";
					$img_count++;
				}
			}
			closedir($handle);
			
			?>
		</td>
		<td class="side" valign="top">
			<div class="main">
				<?php
				echo '<span style="font-size:10px;">' . $path . '</span><br><br>';
				echo $dir_count . ' directories<br>';
				echo $img_count . ' images<br><br>';
				
				// code for BOTTOM of the page
				$end = microtime();
				$endarray = explode(" ", $end);
				$end = $endarray[1] + $endarray[0];
				$total = $end - $start;
				//$total = round($total,2);
				echo '<span style="font-size:11px;">' . $total . " seconds</span>";
			
				?>
			</div>
		</td>
	</tr>
</table>