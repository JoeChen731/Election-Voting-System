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

    <form action="OnlineBallot.php" method="POST">
      <div class="form-group">
        <input type="checkbox" id="candidate1" name="candidate1" value="Candidate1">
        <label for="candidate1"> Candidate 1 </label><br>
        <input type="checkbox" id="candidate2" name="candidate2" value="Candidate2">
        <label for="candidate2"> Candidate 2 </label><br>
        <input type="checkbox" id="candidate3" name="candidate3" value="Candidate3">
        <label for="candidate3"> Candidate 3 </label><br>
        <input type="checkbox" id="candidate4" name="candidate4" value="Candidate4">
        <label for="candidate4"> Candidate 4 </label><br>
      </div>
      <button type="button">Confirm</button>
      <button type="button">Clear</button>
    </form>
  </body>
</html>
