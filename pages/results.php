<?php
session_start();
//redirect if not logged in
if (!isset($_SESSION['loggedin'])){
  header('Location: ../index.php');
  exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Dactr | My Feedback</title>

    <!-- Custom style -->
    <link href="\dactr/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  </head>

  <body class="text-center">
    <!-- Main container -->
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <!-- Header -->
      <header class="masthead">
        <div class="inner">
          <h3 class="masthead-brand">Dactr</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link" href="home.php">Home</a>
            <a class="nav-link active" href="journal.php">My Diary</a>
            <a class="nav-link" href="profile.php">My Profile</a>
            <a class="nav-link" href="../php/logout.php">Logout</a>
          </nav>
        </div>
      </header>
      <!-- Results -->
      <main>
          <h1>Feedback</h1>
          <!-- Cards with journal and feedback -->
            <!-- Journal card -->
            <div class ="card" style="text-align: left">
              <div class="card-header">Your Diary Entry</div>
              <div class="card-body">
                <h5 class="card-title">Dear Dactr,</h5>

                <?php //Pull and display journal
                // Connect to the database dactrlogin
          			$DATABASE_HOST = 'localhost';
          			$DATABASE_USER = 'root';
          			$DATABASE_PASS = $_SESSION['pass'];
          			$DATABASE_NAME = 'dactrjournal';
          			$connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
          			// Stop if can't connect
          			if (mysqli_connect_errno()) {
          				exit('Failed to connect ' . mysqli_connect_error());
          			}

                //Find and display today's latest journal made by the patient
                //$date = $date = date('m/d/Y');
                $result = $connection->query("SELECT username, date, journal FROM journals ORDER BY id DESC LIMIT 1");
                $noName = 0;
                if ($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                    if ($row['username'] == $_SESSION['name']){
                      echo '<p class="card-text">'.$row['journal'].'</p>';
                      echo '<p class="card-text mb-2">- <em>'.$_SESSION['name'].' '.$row['date'].'</em></p>';
                      $noName = 1;
                      break;
                    }
                  }
                  if ($noName == 0){
                    ?><p class="card-text"><em>You haven't written in your diary yet!</em></p><?php
                  }
                } else {
                  ?><p class="card-text"><em>You haven't written in your diary yet!</em></p><?php
                }
                ?>

              </div>
            </div>
            <!--Feedback card -->
            <div class ="card" style="text-align: left">
              <div class="card-header">Sentiment Analysis</div>
              <div class="card-body">
                <h5 class="card-title">Dear <?=$_SESSION['name']?>,</h5>

                <?php

                # Includes the autoloader for libraries installed with composer
                include '/home/bitnami/vendor/autoload.php';
                echo '<p>test2</p>';

                # Imports the Google Cloud client library
                use Google\Cloud\Language\LanguageClient;

                # Your Google Cloud Platform project ID
                $projectId = 'dactr-272020';

                # Instantiates a client
                $language = new LanguageClient(['projectId' => $projectId]);

                # The text to analyze
                $text = "I love garlic bread! It's by far the best type of bread on earth.";
                echo '<p>text</p>';

                # Detects the sentiment of the text   analyzeSentiment()
                $annotation = $language->analyzeSentiment($text);
                echo '<p>bro i am screaming 1</p>';
                $sentiment = $annotation->sentiment();
                echo '<p>bro i am screaming 2</p>';
                echo "<p>Sentiment: " . $sentiment['score'] . "</p>";

                $connection->close();
                ?>
              </div>
            </div>


      </main>
      <!-- Footer -->
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>&copy; Dactr Group</p>
          <a class="btn btn-link btn-sm text-danger" href="crisis.php">Need Support Now?</a>
        </div>
      </footer>
    </div>
  </body>

</html>
