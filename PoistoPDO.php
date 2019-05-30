<?php 

if (isset($_GET['delete'])){
try{
				require_once 'PDOyhteys.php';
				
				$sql = 'DELETE FROM Varausjarjestelma
				WHERE VarausID = :VarausID';
				$stmt = $conn->prepare($sql);
			
				
				$stmt->bindParam(':VarausID', $_GET['VarausID'],PDO::PARAM_INT);
				
				$stmt->execute();
				
				if ($stmt->rowCount()){
				
				$poistoOnnistui = 'Poisto oniistui:';
				Echo $poistoOnnistui;
				$row_count=$stmt->rowCount();
				
				$rivi = 'rivi(ä) poistettiin.';
				}else{
				$poistoEpaonnistui = 'Poisto epäonnistui: 0 riviä poistettiin.';
					}
				$errorInfo=$stmt->errorInfo();
				if(isset($errorInfo[2])){
				$error=$errorInfo[2];
					}
	}catch (Exception $e){
				$error = $e->getMessage();
						}
							}
?>

<html>
<body>
<a href= "http://localhost/PHP/Aku/etusivu.html"> takaisin</a>
</body>
</html>