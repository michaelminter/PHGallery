<?php
include_once("config.inc");
?>

<html>
<head>
	<title>MCDN | Moorberry Content Delivery Network</title>
	
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<table id="wrapper" cellpadding="0" cellspacing="0">
	<tr>
		<td height="32" bgcolor="#000000">
			<h2 class="float-left">MoorCDN</h2>
			<ul>
				<li><a href="<?php echo $cfg['server'] ?>/">Browse</a></li>
				<li><a href="<?php echo $cfg['server'] ?>/">Random</a></li>
			</ul>
		</td>
	</tr>
	<tr>
		<td height="100%" align="top">
			<?php
			
			if ($_GET['image']) {
				include_once("includes/display.inc");
			} else {
				include_once("includes/home.inc");
			}
			
			?>
		</td>
	</tr>
</table>

</body>
</html>