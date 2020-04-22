<?php

			/*This webservice will insert a new drink history insert
			 *
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('drinkId', $_GET))
                        {
                                exit('Missing drinkId parameter');
			}

			if( ! array_key_exists('tableNumber', $_GET))
                        {
                                exit('Missing tableNumber parameter');
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


			//Make sure the drinkId is in the database
			$sql  = 'SELECT `drinkId` FROM `DrinkInfo` WHERE `drinkId` = ' . $_GET['drinkId'] . '';

			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);
			
			

			//Load results into array
			if( mysqli_num_rows($res) > 0 )
			{
				//if a row is returned, then the drink id exists

				$sql = 'INSERT INTO `DrinkHistory`(`drinkID`, `tableNumber`) VALUES (' . $_GET['drinkId'] . ', ' . $_GET['tableNumber'] . ')';			

				//echo $sql;

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				//return an empty json object if there are no results and exit the program
				exit('{}');
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
