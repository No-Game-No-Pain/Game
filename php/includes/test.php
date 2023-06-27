

<?php
include "./includes/connect.php";
$query = "SELECT * FROM user";
$stmt = $pdo->prepare($query);
$stmt->execute();


?>
<h1>test</h1>
<?php
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    // Utilisez les valeurs de chaque ligne
    $colonne1 = $row['colonne1'];
    $colonne2 = $row['colonne2'];}
?>



<div class="input-class">
                    <label for= "class" class="borders"> Choisissez votre classe :  </label>
                    <select name="inputclass" style="width: 25%;" id="class" class="selectperso">
                        <option value="Mage">Mage</option>
                        <option value="Gunner">Gunner</option>
                        <option value="Cowboy">Cowboy</option>
                        <option value="Hazel">Hazel</option>
                        <option value="Cyber">Cyber</option>
                    </select>
                </div>