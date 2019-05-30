<!DOCTYPE html>
<html>

<?php
mb_http_output( "UTF-8" );
echo "<table style='border: solid 1px black;'>";
  echo "<tr><th>AsiakasID</th><th>Etunimi</th><th>Sukunimi</th><th>Osoite</th><th>Postitoimipaikka</th><th>Postinumer</th><th>Puhelin</th><th>Sähköposti</th></tr>";

class TableRows extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() {
         echo "<tr>";
     }

     function endChildren() {
         echo "</tr>" . "\n";
     }
}



 
    try {
        require_once './PDOyhteys.php';
		
        $sql = 'SELECT AsiakasID, EtuNimi, SukuNimi, Osoite, PostitoimiPaikka, PostiNumero, Puhelin, Sahkoposti
                FROM asiakas';
        $stmt = $conn->prepare($sql);

        $stmt->execute();
     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<body bgcolor="#99ccff">
<form method="get" action="MuokkausPDO.php" >
<label for="AsiakasID">Valitse mukattavan asikaan ID: </label>

				<input type="text" name="AsiakasID" id="AsiakasID"></input><br /><br />
				
				<label for="Puhelin">Uusi puhelin numero: </label>

				<input type="text" name="Puhelin" id="Puhelin"></input><br /><br />
				
		        <input type="submit" value="Päivitä">
</form>
		</form>
		<form action="http://localhost/PHP/Aku/etusivu.html">
		<input type="submit" value="Etusivu"/>
		</form>
</body>
</html>
