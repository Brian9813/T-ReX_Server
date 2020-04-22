<?php

			/*This webservice wil update the coaster table			 *
			 *
			 * */

			//check for the needed parameters
			if( ! array_key_exists('coasterId', $_GET))
                        {
                                exit('Missing coasterId');
			}


			//now check for one weight range to be updated

			if ( ! array_key_exists('tableNumber', $_GET) && ! array_key_exists('drinkId', $_GET) && ! array_key_exists('drinkLevel', $_GET))
			{
				exit('No drink weight arguments found<br>Must be "tableNumber", "drinkId", or "drinkLevel"');
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
			$sql  = 'SELECT coasterId FROM `Coaster` WHERE `coasterId` = ' . $_GET['coasterId'] . '';

			//echo print_r($sql);
			
			//result of the query, also runs the query
			$res = mysqli_query($con, $sql);


			
			

			//Load results into array
			if( mysqli_num_rows($res) > 0 )
			{
				//now build the query
				
				$setString = '';

				//add the set statements to the set string var for the query
				if (array_key_exists('tableNumber', $_GET))
				{
					//if there is a tableNumber

					$setString .= "`tableNumber` = " . $_GET['tableNumber'] . ", ";
				}
				if(array_key_exists('drinkId', $_GET))
				{
				
					//if there is a drinkId
					

					//because this is a foreign key you have to check and make sure that the given drinkId exists

					//query to see if the drinkId is valid
					$sql  = 'SELECT `drinkId` FROM `DrinkInfo` WHERE `drinkId` = ' . $_GET['drinkId'];


					//execute the query
					$res = mysqli_query($con, $sql);

					//if there are resulting rows, than the foreign key is valid
					if( ! mysqli_num_rows($res) > 0)
					{
						exit("Invalid drinkId");
					}
					
					//if it is valid then add it to the set string

					$setString .= "`drinkId` = " . $_GET['drinkId'] . ", ";
				}
				if(array_key_exists('drinkLevel', $_GET))
				{
					//if there is a bottom to add
					

					$setString .= "`drinkLevel` = " . $_GET['drinkLevel'] . ", ";
				}

				//now chop the back off of the setString

				$setString = substr($setString, 0, -2);







				
				//construct the query
				$sql = "UPDATE `Coaster` SET " . $setString . " WHERE `coasterId` = " . $_GET['coasterId'];			

				//echo $sql;

				//execute the query
				$res = mysqli_query($con, $sql);

				//should return true then exit
				echo json_encode($res);


			}
			else
			{
				echo 'coasterId not found';
			}

			

			
			



			//close connection
			mysqli_close($con);
		?>
