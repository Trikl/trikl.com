<?php
	// calculate page load times -- this should always be at the bottom!
	$m_time = explode(" ",microtime());
	$m_time = $m_time[0] + $m_time[1];
	$loadend = $m_time;
	$loadtotal = ($loadend - $loadstart);
	echo '<div class="page_load_time">'.round($loadtotal,5).'</div>';
?>
