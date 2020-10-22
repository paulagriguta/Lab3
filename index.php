<?php
$servername = "remotemysql.com";
$username = "Ym1nPp0lPi";
$password = "zBssYGqW0a";
$dbname = "Ym1nPp0lPi";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST["adauga"])) {
  $produs = $_POST["produs"];
  $cantitate = $_POST["cantitate"];
  $sql = "INSERT INTO lista (produs, cantitate) VALUES (?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$produs, $cantitate]);
}
if (isset($_POST["sterge"])) {
 
  $sql = "DELETE FROM `lista`";        
  $q = $conn->prepare($sql);

  $response = $q->execute();     
}

?>
<!DOCTYPE html>
<title></title>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="col-md-6">
    <h1>Shopping List</h1>
    <form class="needs-validation" method="post" novalidate>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="validationTooltip01">Produs</label>
          <input type="text" name="produs" class="form-control" id="validationTooltip01" placeholder="Produs">
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationTooltip02">Cantitate</label>
          <input type="text" name="cantitate" class="form-control" id="validationTooltip02" placeholder="Cantitate">
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <input type="submit" class="btn btn-info btn-lg" value="Adauga" name="adauga">


      </div>
    </form>
  </div>
  <div class="col-md-6"> 
    <form method="POST">
    <table class="table" class="col-md-6">
      <thead><th>ID</th>
        <th>Produs</th>
        <th>Cantitate</th>
      </thead>
      <tbody>
    
        <?php
         $data = $conn->query("SELECT * FROM lista")->fetchAll();
        
         foreach ($data as $row) {
           echo "<tr name=".$row['ID']."><td>". $row['ID']."</td><td>" . $row['Produs'] . "</td><td>" . $row['Cantitate'] . "</td></tr>";
         }
         
        ?>
        
       
      </tbody>
    </table>
    <div class="col-md-6 mb-3">
        <input type="submit" class="btn btn-info btn-lg" value="Sterge Tot" name="sterge">


      </div>
    </form>
  </div>
  
</body>

