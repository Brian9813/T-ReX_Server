<?php

			/*This webservice wil update the coaster table			 
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('userId', $_GET))
                        {
                                exit('Missing userId');
			}


			//now check for one weight range to be updated

			if ( ! array_key_exists('userName', $_GET) && ! array_key_exists('pin', $_GET) && ! array_key_exists('isAdmin', $_GET))
			{
				exit('No drink weight arguments found<br>Must be "userName", "pin", or "isAdmin"');
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
			$sql  = 'SELECT * FROM `Users` WHERE `userId` = ' . $_GET['userId'];

			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);


			
			

			//Load results into array
			if( mysqli_num_rows($res) > 0 )
			{
				//now build the query
				
				$setString = '';

				//add the set statements to the set string var for the query
				if (array_key_exists('userName', $_GET))
				{
					//if there is a username

					$setString .= "`userName` = '" . $_GET['userName'] . "', ";
				}
				if(array_key_exists('pin', $_GET))
				{
					//if there is a pin
					//

					//make sure the pin is 4 digits
					

					if($_GET['pin'] > 9999)
					{
						//if the pin is greater than 5, then exit with error

						exit("Invalid pin entered");
					}

					
					$setString .= "`PIN` = " . $_GET['pin'] . ", ";
				}
				if(array_key_exists('isAdmin', $_GET))
				{
					//if there is a isAdmin

					$setString .= "`isAdmin` = " . $_GET['isAdmin'] . ", ";
				}

				//now chop the back off of the setString

				$setString = substr($setString, 0, -2);







				
				//construct the query
				$sql = "UPDATE `Users` SET " . $setString . " WHERE `userId` = " . $_GET['userId'];			

				//echo $sql;

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				echo 'userId not found';
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
