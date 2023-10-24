<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- for icons-->
		<title>Voter Form</title>
    </head>
  <body>
  <?php
    // mysqli_close($con);
    $pdo->connection = null;
    //echo session status
    if(isset($_SESSION['status'])) {
        echo "<h4>".$_SESSION['status']."</h4>";
        unset($_SESSION['status']);
    }
    ?>
    <p>John Doe /n Society A Member</p>

    <form action="VoterForm.php" method="POST">
      <div class="form-group">
        <button type="submit" name="recentElections">Recent Elections</button>
      </div>
      <div class="form-group">
        <label>Active Elections</label>
        <button type="submit" name="presElections">Presidential Election</button>
      </div>
    </form>
  </body>
</html>