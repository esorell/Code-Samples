<?php
	// connect to the database
	require_once( 'includes/login-connect.inc.php' );
	require_once( 'includes/login-functions.inc.php' );
	
	// check if the form was submitted
	if( isset( $_POST[ 'title' ] ) ){
		
		// assemble all the form data and eliminate any harmful form input
		$title = mysql_real_escape_string( strip_tags( $_POST[ 'title' ] ) );
		$url = mysql_real_escape_string( strip_tags( $_POST[ 'url' ] ) );
		
		// insert into the database, but only if the data checks out
		$query = "INSERT INTO 
				 	bookmark(title,
							url)
				 	VALUES( '$title',
							'$url')";
						   
		$result = mysql_query( $query )
			or die(mysql_error() );
	}
	
	// get all the bookmarks from the database and sort in alphabetical order by title
	$query = 'SELECT * FROM bookmark ORDER BY title ASC';
	
	$result = mysql_query( $query ) 
		or die( mysql_error() );
		
		
	// LOGIN CODE	
		
	// always start the session, or the session variables won't work
	session_start();

	if( isset($_POST[ 'email' ] ) ){
		$error = login();
	}
?>
	
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        	<title>Relish</title>
        	<link rel="stylesheet" href="css/style.css" />
    </head>
    
    <body>
    	<header>
        	<h1>Relish.</h1>
            <h2>collect the things you love</h2>
        </header>
     	
        <div class="container">
        
         <!-- LOGIN FORM --> 
            
       <?php echo $error; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        	<div id="login">
				<ol>
                	<li><label class="top">LOGIN</label></li>
                    <li>
                        <label class="top">Email:</label>
                        <input type="email" name="email" value="<?php echo $_POST['email']; ?>" size="40" />
                    </li>
                    <li>
                        <label class="top">Password:</label>
                        <input type="password" name="password" size="40" />
                    </li>
                    <li>
                        <input class="button" type="submit" value="Sign In" />
                    </li>
				</ol>
            </div>
		</form>
        
        	<!-- LIST OF BOOKMARKS -->
        	<div class="links">
        		<ol>
					<?php // output events as a list 
                    	while($row = mysql_fetch_assoc( $result ) ):
                    ?>
            		<li class="title">
                		<p><?php echo $row['title']; ?></p>
            		</li>
             		<li class="web">
                		<a href="<?php echo $row['url'] ?>" target="_blank"><?php echo $row['url'] ?></a>
             		</li>
             		<?php endwhile; ?>
        		</ol>
        	</div>
       		
            <footer>
            	<p>© 2013 Emily Sorell</p>
            </footer>
            
    </div> <!--end of container -->
  </body>
</html>
