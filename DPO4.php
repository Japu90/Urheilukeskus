

<?php
if (isset($_GET['search'])) {
    try {
        require_once './PDOyhteys.php';
        $sql = 'SELECT Varausjarjestelma.PVM, Varausjarjestelma.AlkamisAika, Varausjarjestelma.LoppumisAika, 
				asiakas.EtuNimi, asiakas.SukuNimi
                FROM asiakas
                INNER JOIN  Varausjarjestelma
				ON asiakas.AsiakasID = Varausjarjestelma.AsiakasID
				WHERE asiakas.SukuNimi LIKE :SukuNimi OR asiakas.EtuNimi LIKE :EtuNimi
                ORDER BY asiakas.EtuNimi';
        $stmt = $conn->prepare($sql);
        $values = array(':EtuNimi' =>  $_GET['EtuNimi'],
                        ':SukuNimi' =>  $_GET['SukuNimi']);
        $stmt->execute($values);
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
    <!--<link rel="stylesheet" href="../../styles/styles.css">-->
</head>
<body>
<h1>Haku tietokannasta</h1>
<?php if (isset($error)) {
    echo "<p>$error</p>";
} ?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <legend>Haku kannasta</legend>
    <p>
        <label for="EtuNimi">Etunimi: </label>
        <input type="text" name="EtuNimi" id="EtuNimi">
		<label for="SukuNimi">Sukunimi: </label>
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
        <th>PVM</th>
        <th>Alkamisaika</th>
        <th>Loppumisaika</th>
        
    </tr>
    <?php do { ?>
    <tr>
        <td><?php echo $row['EtuNimi']; ?></td>
        <td><?php echo $row['PVM']; ?></td>
        <td><?php echo $row['AlkamisAika']; ?></td>

    </tr>
    <?php } while ($row = $stmt->fetch()); ?>
</table>
<?php } else {
        echo '<p>No results found.</p>';
    } } ?>
</body>
</html>
