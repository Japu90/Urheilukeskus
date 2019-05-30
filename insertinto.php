<?php
if(isset($_GET['Submit'])){

try {
require_once 'PDOyhteys.php';	



$stmt = $conn->prepare("INSERT INTO asiakas (AsiakasID, EtuNimi, SukuNimi, Osoite, PostitoimiPaikka, PostiNumero, Puhelin, Sahkoposti)
					  VALUES ( :AsiakasID, :EtuNimi, :SukuNimi, :Osoite, :PostitoimiPaikka, :PostiNumero, :Puhelin, :Sahkoposti)");	
					  
	$AsiakasID = $_GET['AsiakasID'];
	$EtuNimi = $_GET['EtuNimi'];
	$SukuNimi = $_GET['SukuNimi'];
	$Osoite = $_GET['Osoite'];
	$PostitoimiPaikka = $_GET['PostitoimiPaikka'];
	$PostiNumero = $_GET['PostiNumero'];
	$Puhelin = $_GET['Puhelin'];
	$Sahkoposti = $_GET['Sahkoposti'];				  
					  
	$stmt->bindParam(':AsiakasID', $AsiakasID);
	$stmt->bindParam(':EtuNimi', $EtuNimi);
	$stmt->bindParam(':SukuNimi', $SukuNimi);
	$stmt->bindParam(':Osoite', $Osoite);
	$stmt->bindParam(':PostitoimiPaikka', $PostitoimiPaikka);
	$stmt->bindParam(':PostiNumero', $PostiNumero);
	$stmt->bindParam(':Puhelin', $Puhelin);
	$stmt->bindParam(':Sahkoposti', $Sahkoposti);	
	

	

	
		   $stmt->execute($sql);
		
        $errorInfo = $stmt->errorInfo();
        if (isset($errorInfo[2])) {
            $error = $errorInfo[2];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
echo "Asikas lisätty";
}
?>


<!DOCTYPE html>
<html>
	<head>
	<title>insert data in database using PDO(php data object)</title>
	
	</head>
<body bgcolor="#99ccff">
	

	<div align ="center"id="main">
	<h1>Asiakkaan lisäys</h1>
	<div align ="center">
	<h2>Asiakas</h2>
	<?php if (isset($error)) {
    echo "<p>$error</p>";
} ?>
	
		<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<p>
				
					<label for="AsiakasID">AsiakasID :</label> 
					<input type="text" name="AsiakasID" id="AsiakasID" required="required" placeholder="6"></input><br /><br />
					
					<label for="EtuNimi">Etunimi :</label> 
					<input type="text" name="EtuNimi" id="EtuNimi" required="required" placeholder="Jarno"></input><br/><br />
					
					<label for="SukuNimi">Sukunimi :</label> 
					<input type="text" name="SukuNimi" id="SukuNimi" required="required" placeholder="Kuisma"></input><br/><br />
					
					<label for="Osoite">Osoite :</label> 
					<input type="text" name="Osoite" id="Osoite" required="required" placeholder="Palosaarentie 58"></input><br/><br />
					
					<label for="PostitoimiPaikka">Postitoimipaikka :</label>
					<input type="text" name="PostitoimiPaikka" id="PostitoimiPaikka" required="required" placeholder=" Vaasa "></input><br/><br />
					
					<label for="PostiNumero">Postinumero :</label>
					<input type="text" name="PostiNumero" id="PostiNumero" required="required" placeholder="65200"></input><br/><br />
					
					<label for="Puhelin">Puhelinnumero :</label>
					<input type="text" name="Puhelin" id="Puhelin" required="required" placeholder="04012345678"></input><br/><br />
					
					<label for="Sahkoposti">Sahkopostiosoite :</label>
					<input type="email" name="Sahkoposti" id="Sahkoposti" required="required" placeholder="japi@asdda.fi"></input><br/><br />
					
					<input type="Submit" value=" Submit " name="Submit" id="Submit"/><br />
					
					
				</p>
			</fieldset>
		</form>
		<form action="http://localhost/PHP/Aku/etusivu.html">
		<input type="submit" value="Etusivu"/>
		</form>
		
	</div>

	</div>
	<?php if (isset($_GET['Submit'])) {
	$row = $stmt->fetch();
	if ($row) {
	?>
	
<table>
	<?php do { ?>
	<tr>
	<th><?php echo $row['AsiakasID']?></th>
	<th><?php echo $row['EtuNimi']?></th>
	<th><?php echo $row['SukuNimi']?></th>
	<th><?php echo $row['Osoite']?></th>
	<th><?php echo $row['PostitoimiPaikka']?></th>
	<th><?php echo $row['PostiNumero']?></th>
	<th><?php echo $row['Puhelin']?></th>
	<th><?php echo $row['Sahkoposti']?></th>
	</tr> 
	<?php } while ($row = $stmt->fetch());
	?>
</table>
<?php } else { 
			echo '<p> No results found</p>';
			}  } ?>

</body>
</html>

