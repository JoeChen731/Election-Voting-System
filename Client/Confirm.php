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
    <p>Are you want to participate in the Presidential Election?</p>

    <form action="ChoiceBallot.php" method="POST">
      <div class="form-group">
        <button type="submit" name="yes">Yes</button>
      </div>
      <div class="form-group">
        <button type="submit" name="no">No</button>
      </div>
    </form>
  </body>
</html>