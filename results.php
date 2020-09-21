<html>
	<head>
		<link rel="stylesheet" id='stylen' media="screen and (min-width: 1330px)" href="../Pics/1360 sze/rpg gamers.css"/>
		<link rel="stylesheet" id='stylen' media="screen and (min-width: 1920px)" href="../Pics/1920 sze/rpg gamers.css"/>
		<link rel="stylesheet" id='stylen' media="screen and (min-width: 1460px)" href="../rpg gamers.css" />
		<title> DB Results </title>
<?php

		$width = $_POST['sizen'];
		$width = trim($width, '[]');
		
		if ($width >= 1330 && $width < 1400)
		{
		  include_once("../inc/design1366.php");
		}
		else if ($width >= 1920 && $width <1990)
		{
			include_once("../inc/design1920.php");
		}
		else
		{
		  include_once("../inc/design.php");
		}

echo $top;

error_reporting(0);//Removes the data base errors.
if(isset($_POST['submit'])|| $_GET['search'] != null)
{
	
	$con = mysql_connect(/*"localhost","root","")*/"rpgg-207231.mysql.binero.se","207231_ku10490","CJKa3aMhtDatabses");
		if (!$con)
		 {
			 die('Could not connect: ' . mysql_error()."damn");
		 }
		 //väljer databas
		mysql_select_db("207231-rpgg", $con) or die("Couldn't connect to DB!");
			
	$game = $_POST['game'];
	$check = $_POST['search'];
	$checkG = $_GET['search'];
	$search = $_POST['finde'];
	
	//Pathfinder results
	if($game == 'Pathfinder CRB')
	{
	
		//Armor results
		if($check == 'armor' || $checkG == 'armor')
		{
			
			//If person has keyword, selects results.
			if($search != null)
			{
				// done, Copy this querry, book needs `` signs not ''
				$result = mysql_query("SELECT * FROM armor WHERE protectiveItem LIKE '%".$search."%' AND `Book` = 'Pathfinder CRB'");
				
				echo $search;
				if (!$result)
				{
					
						die('Could not query:' . mysql_error());
					
				}
				else
				{
					if ($width >= 1330 && $width < 1400)
					{
						echo"
										<tr>
								<td>
									<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='../Pics/1360 sze/Search/pathfinder.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='../Pics/1360 sze/Search/cyberpunk.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='../Pics/1360 sze/Search/starwars.png'/></a>
								</td>
							</tr>
						</table>
						</div>
						<div class='conTxt'>";
					}
					else if($width >= 1920 && $width > 1990)
					{
							echo"
										<tr>
								<td>
									<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='http://www.rpgg.org/Pics/1920 sze/Search/pathfinder.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/1920 sze/Search/cyberpunk.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/1920 sze/Search/starwars.png'/></a>
								</td>
							</tr>
						</table>
						</div>
						<div class='conTxt'>";
					}
					else
					{
						echo"
									<tr>
							<td>
								<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='http://www.rpgg.org/Pics/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/Search/cyberpunk.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>
					</div>
					<div class='conTxt'>";
					}
					echo "
						<table border='1'>
							<tr>
								<td>
									<font color='#669999'>
										<b>Class</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Name</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Costs</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>AC Bonus</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Maximun Dex Bonus</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Armor chek Penalty</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Arcane Spell Failure Chance</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Speed 30ft/20ft</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Weight</b>
									</font>
								</td>
							</tr>";
						while ($row = mysql_fetch_assoc($result))
						{
							
							echo "<tr>";
								echo "<td><font color='#999999'>".$row['class']."</font></td>";									
								echo "<td><font color='#999999'>".$row['protectiveItem']."</font></td>";
								echo "<td><font color='#999999'>".$row['cost']."</font></td>";
								echo "<td><font color='#999999'>".$row['ac']."</font></td>";
								echo "<td><font color='#999999'>".$row['dexBonus']."</font></td>";
								echo "<td><font color='#999999'>".$row['checkPenalty']."</font></td>";
								echo "<td><font color='#999999'>".$row['spellFail']."</font></td>";
								echo "<td><font color='#999999'>".$row['speed']."</font></td>";
								echo "<td><font color='#999999'>".$row['weight']."</font></td>";
							echo "</tr>";
							
						}
							echo "</table></p>";
							mysql_close($con);
				}
				
			}
			//If user doesn't select keyword, shows all from category
			else
			{
				
				
				$result = mysql_query("SELECT * FROM armor WHERE `Book` = 'Pathfinder CRB'");
				if (!$result)
				{
					die('Could not query: ' . mysql_error());
				}
				else
				{
				
				
				if ($width >= 1330 && $width < 1400)
				{
					echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1360 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href=''../under construction.php'><img src='../Pics/1360 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
				}
				else if ($width >= 1920 && $width < 1990)
				{
					echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1920 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
				}
				else
				{
					echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
				}
				echo "
					</div>
					<div class='conTxt'>
						<table border='1'>
							<tr>
								<td>
									<font color='#669999'>
										<b>Class</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Name</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Costs</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>AC Bonus</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Maximun Dex Bonus</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Armor chek Penalty</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Arcane Spell Failure Chance</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Speed 30ft/20ft</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Weight</b>
									</font>
								</td>
							</tr>";
						while ($row = mysql_fetch_assoc($result))
						{
							
							echo "<tr>";
								echo "<td><font color='#999999'>".$row['class']."</font></td>";									
								echo "<td><font color='#999999'>".$row['protectiveItem']."</font></td>";
								echo "<td><font color='#999999'>".$row['cost']."</font></td>";
								echo "<td><font color='#999999'>".$row['ac']."</font></td>";
								echo "<td><font color='#999999'>".$row['dexBonus']."</font></td>";
								echo "<td><font color='#999999'>".$row['checkPenalty']."</font></td>";
								echo "<td><font color='#999999'>".$row['spellFail']."</font></td>";
								echo "<td><font color='#999999'>".$row['speed']."</font></td>";
								echo "<td><font color='#999999'>".$row['weight']."</font></td>";
							echo "</tr>";
							
						}
							echo "</table></p>";
							mysql_close($con);
				}
			}
				
				echo "<br/>
					<br/>";
				
				echo "<b>Heavy Armor:</b> When running in heavy armor, you move only triple your speed, not quadruple.";
				
				echo "<br>";
				
				echo "<b>Tower Shield:</b> It can grant you cover instead of Shield Bonus.";
				
				echo "<br/>";
				
				echo "<b>Gauntlet, looked:</b> Hand is not free to cast spells!";
					
				echo "<br/>";
				echo "<br/>";
				
				
				echo "<br/>";
				
				echo "<a href='search.php'>Back</a>";
			echo "</div>";
		}
		else if($check == 'monster')
		{
			echo "you choose monster";
		}
		//Weapons reults
		else if($check == 'weapon' || $checkG == 'weapon')
		{
			
			//If serache with keyword
			if($search != null)
			{
				//Kör en SQL-fråga mot databasen
				$result = mysql_query("SELECT * FROM weapons WHERE name LIKE '%".$search."%' AND `Book` = 'Pathfinder CRB'");
				if (!$result)
				{
					die('Could not query:' . mysql_error());
				}
				else
				{
					if ($width >= 1330 && $width < 1400)
					{
						echo"
										<tr>
								<td>
									<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='Pics/1360 sze/Search/pathfinder.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='Pics/1360 sze/Search/cyberpunk.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='Pics/360 sze/Search/starwars.png'/></a>
								</td>
							</tr>
						</table>
						</div>
						<div class='conTxt'>";
					}
					else if($width >= 1920 && $width > 1990)
					{
							echo"
										<tr>
								<td>
									<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='http://www.rpgg.org/Pics/1920 sze/Search/pathfinder.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/1920 sze/Search/cyberpunk.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/1920 sze/Search/starwars.png'/></a>
								</td>
							</tr>
						</table>
						</div>
						<div class='conTxt'>";
					}
					else
					{
						echo"
									<tr>
							<td>
								<a href='http://www.rpgg.org/Databases/Pathfinder/main.php'><img src='http://www.rpgg.org/Pics/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/Search/cyberpunk.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='http://www.rpgg.org/under constructionUnder construction.html'><img src='http://www.rpgg.org/Pics/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>
					</div>
					<div class='conTxt'>";
					}
						echo "
							<table border=1>
								<tr>
									<td>
										<font color='#669999'>
											<b>Name</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Price</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Total Attack Bonus</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Damage</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Critical</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Range</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Special Properties</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Amo</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Weight</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Size</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Type</b>
										</font>
									</td>
								</tr>";
							while ($row = mysql_fetch_assoc($result))
							{
								
								echo "<tr>";
									echo "<td><font color='#999999'>".$row['name']."</font></td>";
									echo "<td><font color='#999999'>".$row['Price']."</font></td>";
									echo "<td><font color='#999999'>".$row['totalAttackBonus']."</font></td>";
									echo "<td><font color='#999999'>".$row['damge']."</font></td>";
									echo "<td><font color='#999999'>".$row['critical']."</font></td>";
									echo "<td><font color='#999999'>".$row['range']."</font></td>";
									echo "<td><font color='#999999'>".$row['specialProperties']."</font></td>";
									echo "<td><font color='#999999'>".$row['amo']."</font></td>";
									echo "<td><font color='#999999'>".$row['weight']."</font></td>";
									echo "<td><font color='#999999'>".$row['size']."</font></td>";
									echo "<td><font color='#999999'>".$row['type']."</font></td>";
								echo "</tr>";
								
							}
							echo "</table></p>";
							mysql_close($con);
							echo "<br/>
								<br/>";
							
							echo "you choose weapon";
							echo "<br/>";
							echo "<a href='search.php'>Back</a>";
						echo "</div>";
						mysql_close();
				}
			}
			//search without keyword
			else
			{
				//Kör en SQL-fråga mot databasen
				$result = mysql_query("SELECT * FROM weapons WHERE `Book` = 'Pathfinder CRB'");
				if (!$result)
				{
					die('Could not query:' . mysql_error());
				}
				else
				{
					if ($width >= 1330 && $width < 1400)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1360 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
					else if ($width >= 1920 && $width < 1990)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1920 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
					else
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
						echo "
							<table border=1>
								<tr>
									<td>
										<font color='#669999'>
											<b>Name</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Price</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Total Attack Bonus</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Damage</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Critical</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Range</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Special Properties</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Amo</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Weight</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Size</b>
										</font>
									</td>
									<td>
										<font color='#669999'>
											<b>Type</b>
										</font>
									</td>
								</tr>";
							while ($row = mysql_fetch_assoc($result))
							{
								
								echo "<tr>";
									echo "<td><font color='#999999'>".$row['name']."</font></td>";
									echo "<td><font color='#999999'>".$row['Price']."</font></td>";
									echo "<td><font color='#999999'>".$row['totalAttackBonus']."</font></td>";
									echo "<td><font color='#999999'>".$row['damge']."</font></td>";
									echo "<td><font color='#999999'>".$row['critical']."</font></td>";
									echo "<td><font color='#999999'>".$row['range']."</font></td>";
									echo "<td><font color='#999999'>".$row['specialProperties']."</font></td>";
									echo "<td><font color='#999999'>".$row['amo']."</font></td>";
									echo "<td><font color='#999999'>".$row['weight']."</font></td>";
									echo "<td><font color='#999999'>".$row['size']."</font></td>";
									echo "<td><font color='#999999'>".$row['type']."</font></td>";
								echo "</tr>";
								
							}
							echo "</table></p>";
							mysql_close($con);
							echo "<br/>
								<br/>";
							
							echo "you choose weapon";
							echo "<br/>";
							echo "<a href='search.php'>Back</a>";
						echo "</div>";
						mysql_close();
				}
			}
			
		}
		//Items Results
		else if($check == "items" || $checkG == "items")
		{
			
			if($search != null)
			{
				//Kör en SQL-fråga mot databasen
				$result = mysql_query("SELECT * FROM items WHERE name LIKE '%".$search."%' AND `Book` = 'Pathfinder CRB'");
				if (!$result)
				{
					die('Could not query:' . mysql_error());
				}
				else
				{
					
					if ($width >= 1330 && $width < 1400)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1360 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
					else if ($width >= 1920 && $width < 1990)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1920 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}

					else
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
						echo "
						<table border=1>
							<tr>
								<td>
									<font color='#669999'>
										<b>Name</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Cost</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Weight</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Description<b/>
									</font>
								</td>
							</tr>";
						while ($row = mysql_fetch_assoc($result))
						{
							
							echo "<tr>";
								echo "<td><font color='#999999'>".$row['name']."</td>";									
								echo "<td><font color='#999999'>".$row['cost']."</td>";
								echo "<td><font color='#999999'>".$row['weight']."</td>";
								if($row['desc'] != null)
								{
									echo "<td>
											<font color='#999999'>
												<form action='info.php' method='POST'>
													<input type='hidden' name='hidden' id='hidden' value='".$row['name']."'/>
													<input type='hidden' name='sizens' id='sizen' value='".$width."'/>
													";
													echo $width;
													echo "
													<input type='submit' value='More info' name='dInfo' id='dInfo'/>
												</form>
											</font>
										</td>";
								}
								else
								{
									echo "<td>
											<font color='#999999'>
												Not added yet!
											</font>
										</td>";
								}
							echo "</tr>";
							
						}
						echo "</table></p>";
						mysql_close($con);
						echo "<br/>
							<br/>";
						echo "You choosed Items";
						
						echo "<br/>";
						
						echo "<a href='search.php'>Back</a>";
					echo "</div>";
					mysql_close();
				}
			}
			else
			{
			
				//Kör en SQL-fråga mot databasen
				$result = mysql_query("SELECT * FROM items WHERE `Book` = 'Pathfinder CRB'");
				if (!$result)
				{
					die('Could not query:' . mysql_error());
				}
				else
				{
				
					if ($width >= 1330 && $width < 1400)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1360 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1360 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}
					else if ($width >= 1920 && $width < 1990)
					{
						echo"
						<tr>
							<td>
								<a href='Pathfinder/main.php'><img src='../Pics/1920 sze/Search/pathfinder.png'/></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/cyberpunk.png'/></a>
							<td>
						</tr>
						<tr>
							<td>
								<a href='../under construction.php'><img src='../Pics/1920 sze/Search/starwars.png'/></a>
							</td>
						</tr>
					</table>";
					}

					else
					{
						echo"
							<tr>
								<td>
									<a href='arms.php'><img src='../Pics/Search/pathfinder.png'/></a>
								</td>
							</tr>
							<tr>
								<td>
									<a href='armas.php'><img src='../Pics/Search/cyberpunk.png'/></a>
								<td>
							</tr>
							<tr>
								<td>
									<a href='items.php'><img src='../Pics/Search/starwars.png'/></a>
								</td>
							</tr>
						</table>";
					}
						echo "
						<table border=1>
							<tr>
								<td>
									<font color='#669999'>
										<b>Name</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Cost</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Weight</b>
									</font>
								</td>
								<td>
									<font color='#669999'>
										<b>Description</b>
									</font>
								</td>
							</tr>";
							
						while ($row = mysql_fetch_assoc($result))
						{
							
							echo "<tr>";
								echo "<td><font color='#999999'>".$row['name']."</td>";									
								echo "<td><font color='#999999'>".$row['cost']."</td>";
								echo "<td><font color='#999999'>".$row['weight']."</td>";
								if($row['desc'] != null)
								{
									echo "<td>
											<font color='#999999'>
												<form action='info.php' method='POST'>
													<input type='hidden' name='hidden' id='hidden' value='".$row['name']."'/>
													<input type='hidden' name='sizen' value='$width'/>
													<input type='submit' value='More info' name='dInfo' id='dInfo'/>
													
												</form>
											</font>
										</td>";
								}
								else
								{
									echo "<td>
											<font color='#999999'>
												Not added yet!
											</font>
										</td>";
								}
							echo "</tr>";
							
						}
						echo "</table></p>";
						mysql_close($con);
						echo "<br/>
							<br/>";
						echo "You choosed Items";
						
						echo "<br/>";
						
						echo "<a href='search.php'>Back</a>";
					echo "</div>";
					mysql_close();
				}
			}
			
		}	
		else
		{
			echo 
			<<<CONT
			</table>
			</div>
			<div class='conTxt' style="text-align:center; margin-top:100px; height:150px">
				ERROR unexcpected data value for radio buttons!
				<br/>
					Check if you've selected a catagory or game!
				<br/>You may only browse one category at a time.
				<br/>
					Not all game have the same categories.
				<br/>
				<a href='search.php'>Back</a>
			</div>
CONT;
		}
	}
	else if($game =='Cyberpunk')
	{
		//ADD STUFF
		echo "You selected Cyberpunk
		<br/>
		<a href='search.php'>Back</a>";
		mysql_close();
		
	}
	else if($game == 'Star Wars')
	{
		//ADD STUFF
		echo "You selected Star Wars
		<a href='search.php'>Back</a>";
		mysql_close();
		
	}
	else
	{
		echo "</table>";
		echo "</div>";
		echo "<div class='conTxt'>";
			echo "Please select a game! <br/><a href='search.php'>Back</a><br/>";
			echo $game;	
			echo "</div>";
			mysql_close();
	}
}
else
{

die("You haven't entered anything to searh for or chosen the catagory!<br/><a href='search.php'>Back</a>");
}
echo "
<div class='rCol'>
";
		if ($width >= 1330 && $width < 1400)
		{
		echo "
			<table class='SubMenue'>
				<tr>
					<td>
						<img src='Pics/1360 sze/crumbles/tracker.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<a href='http://www.rpgg.org/Databases/search.php'><img src='http://www.rpgg.org/Pics/1360 sze/crumbles/searchOld.png'/></a>
					<td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/1360 sze/crumbles/arrow.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/1360 sze/crumbles/searchResultAtive.png'/>
					</td>
				</tr>
			</table>";
		}
		else if($width >= 1920 && $width < 1990)
		{
			echo "
			<table class='SubMenue'>
				<tr>
					<td>
						<img src='../Pics/1920 sze/crumbles/tracker.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<a href='http://www.rpgg.org/Databases/search.php'><img src='http://www.rpgg.org/Pics/1920 sze/crumbles/searchOld.png'/></a>
					<td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/1920 sze/crumbles/arrow.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/1920 sze/crumbles/searchResultActive.png'/>
					</td>
				</tr>
			</table>";
		}
		else
		{
			echo "
			<table class='SubMenue'>
				<tr>
					<td>
						<img src='../Pics/crumbles/tracker.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<a href='http://www.rpgg.org/Databases/search.php'><img src='http://www.rpgg.org/Pics/crumbles/searchOld.png'/></a>
					<td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/crumbles/arrow.png'/>
					</td>
				</tr>
				<tr>
					<td>
						<img src='http://www.rpgg.org/Pics/crumbles/searchResultActive.png'/>
					</td>
				</tr>
			</table>";
		}
		echo <<<RIGT
		</div>
RIGT;
echo $bottom;
mysql_close();
?>
