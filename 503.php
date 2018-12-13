<?php
/**
 * The template for displaying 503 pages (service currenty not available)
 *
 * @package mochilaso
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Just another WordPress site" />
		<title>Mochilaso.com &raquo; Maintenance Mode</title>

		<style type="text/css">
			* {
				margin: 0;
				padding: 0;
			}
			body {
				font-family: Georgia, Arial, Helvetica, sans-serif;
				font-size: 65.5%;
			}
			a {
				color: #08658F;
			}
			a:hover {
				color: #0092BF;
			}
			#header {
				color: #333;
				padding: 1.5em;
				text-align: center;
				font-size: 1.2em;
				border-bottom: 1px solid #08658F;
			}
			#content {
				font-size: 150%;
				width:80%;
				margin:0 auto;
				padding: 5% 0;
				text-align: center;
			}
			#content p {
				font-size: 1em;
				padding: .8em 0;
			}
			h1,
			h2 {
				color: #08658F;
			}
			h1 {
				font-size: 300%;
				padding: .5em 0;
			}
			#menu {
				position: absolute;
				font-family: Arial, Helvetica, sans-serif;
				bottom: 2em;
				width: 100%;
				border-top: 1px solid #08658F;
			}
			#menu #pluginauthor {
				padding-left: .3em;
			}
			#menu #admin {
				float: right;
				padding-right: .3em;
			}
			img {
				position:absolute;
				top:50%;
				left:50%;
				margin-left:-200px;
				margin-top:-118px;
			}
		</style>

	</head>

	<body>

		<div id="header">
			<h2><a title="Mochilaso" href="<?php echo esc_url( site_url( '/' ) ); ?>">Mochilaso.com</a></h2>
		</div>

		<div id="content">
			<img src="images/comingsoon.png" alt="Los Topetes coming soon...">
		</div>

		<div id="menu">
			<p id="admin"><a rel="nofollow" href="<?php echo esc_url( site_url( '/' ) ); ?>/wp-login.php">Log In</a></p>
		</div>

	</body>
</html>
