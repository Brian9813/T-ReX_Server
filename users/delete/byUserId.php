<?php

			/*This webservice will delete a  user in the database
			 *
			 *
			 * */

            if( ! array_key_exists('userId', $_GET))
            {
                exit('Missing userId');
			}

			//credentials for connection
			$dbhost = 'localhost';
			$db = 'capstone';
			$user = 'user1';
			$pswd = 'password';
			//echo 'Before Connect<br>';
	
			//open connection to mysql
			$con = mysqli_connect($dbhost, $user, $pswd, $db);


			if(! $con )
			{
				die('Could not connect -> '.$con->connect_error);
			}


			//Query with the column and the value passed via the parameters
			$sql  = 'DELETE FROM `Users` WHERE `userId` = ' . $_GET['userId'];


			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
            echo json_encode($res);


			//close connection
			mysqli_close($con);
		?>
