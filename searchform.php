<?php
/**
 * Template for displaying search forms
 *
 * @package mochilaso
 */

?>
<form action="<?php bloginfo( 'url' ); ?>" id="searchform" method="get">
	<div>
		<label for="s" class="screen-reader-text hide">Search for:</label>
		<input type="text" id="s" name="s" value="" />

		<input type="submit" value="Search" id="searchsubmit" />
	</div>
</form>
