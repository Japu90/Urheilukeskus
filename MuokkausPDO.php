 <?php
$servername = "mysql.cc.puv.fi";
$username = "e1501159";
$password = "nTDuh9gQuhGk";
$tietokanta = "e1501159_aku";

try {
    $yhteys = new PDO("mysql:host=$servername;dbname=$tietokanta", $username, $password);
    // set the PDO error mode to exception
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		
	$AsiakasID = $_GET['AsiakasID'];
	$Puhelin = $_GET['Puhelin'];


    $sql = "UPDATE asiakas SET Puhelin = :Puhelin WHERE AsiakasID = :AsiakasID";

    // Prepare statement
    $stmt = $yhteys->prepare($sql);
	$stmt->bindParam(':AsiakasID', $AsiakasID);
	$stmt->bindParam(':Puhelin', $Puhelin);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . ": Asiakkaan puhelin numero päivitetty";
	echo "<br>";
	echo "<a href='etusivu.html'>Etusivu</a>";

    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?> 