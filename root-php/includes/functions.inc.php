<?php

	function clean_up( $text ){
		
		// strip out all HTML code	
		$text = strip_tags( $text );
		
		// remove any harmful characters that could
		// break a mysql query - only works if connected to the database
		$text = mysql_real_escape_string( $text );
		
		return $text;
	}