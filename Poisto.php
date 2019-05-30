<!DOCTYPE html>
<html>

<?php

echo "<table style='border: solid 1px black;'>";
  echo "<tr><th>VarausID</th><th>AsiakasID</th><th>LajiID</th><th>PVM</th><th>Alkamis Aika</th><th>Loppumis Aika</th></tr>";

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
		
        $sql = 'SELECT VarausID, AsiakasID, LajiID, PVM, AlkamisAika, LoppumisAika
                FROM Varausjarjestelma';
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
<form method="GET"  action="PoistoPDO.php">
<label for="VarausID">Valitse postettava VarausID: </label>
				<input type="text" name="VarausID" id="VarausID"></input><br /><br />
				
		        <input type="submit" name="delete" value="Poista">
</form>
		</form>
		<form action="http://localhost/PHP/Aku/etusivu.html">
		<input type="submit" value="Etusivu"/>
		</form>
</body>
</html>
