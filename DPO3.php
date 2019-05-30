<?php

if (isset($_GET['search'])) {
    try {
        require_once './PDOyhteys.php';
        $sql = 'SELECT Varausjarjestelma.PVM, Varausjarjestelma.AlkamisAika, Varausjarjestelma.LoppumisAika, 
				asiakas.EtuNimi, asiakas.SukuNimi
                FROM asiakas
                INNER JOIN  Varausjarjestelma
				ON asiakas.AsiakasID = Varausjarjestelma.AsiakasID
				WHERE asiakas.SukuNimi LIKE :SukuNimi AND Varausjarjestelma.AlkamisAika = :AlkamisAika
                ORDER BY asiakas.SukuNimi';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':AlkamisAika',  $_GET['AlkamisAika'] );
		$stmt->bindValue(':SukuNimi', '%' . $_GET['SukuNimi'] . '%' );
        $stmt->execute();
		//echo $_GET['SukuNimi'];
        $errorInfo = $stmt->errorInfo();
        if (isset($errorInfo[2])) {
            $error = $errorInfo[2];
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Named Parameters</title>
    <link rel="stylesheet" href="../../styles/styles.css">
</head>
<body>
<h1>Haku Tietokannasta</h1>

<?php if (isset($error)) {
    echo "<p>$error</p>";
} ?>

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Haku nimen mukaan</legend>
    <p>
        <label for="make">Alkamisaika (muodossa 9:00): </label>
        <input type="text" name="AlkamisAika" id="AlkamisAika">
		<label for="make">Sukunimi: </label>
        <input type="text" name="SukuNimi" id="SukuNimi">
        <input type="submit" name="search" value="Search">
    </p>
    </fieldset>
</form>
<?php if (isset($_GET['search'])) {
    $row = $stmt->fetch();
    if ($row) {
    ?>
<table>
    <tr>
        <th>Etunimi</th>
        <th>Sukunimi</th>
        <th>Aloitusaika</th>
        <th>Loppumisaika</th>
        <th>Päivämäärä</th>
    </tr>
    <?php do { ?>
    <tr>
        <td><?php echo $row['EtuNimi']; ?></td>
        <td><?php echo $row['SukuNimi']; ?></td>
        <td><?php echo number_format($row['AlkamisAika'],  2); ?></td>
        <td><?php echo number_format($row['LoppumisAika'], 2); ?></td>
        <td><?php echo $row['PVM']; ?></td>
    </tr>
    <?php } while ($row = $stmt->fetch()); ?>
</table>
<?php } else {
        echo '<p>No results found.</p>';
    } } ?>
</body>
</html>
