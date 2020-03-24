<?php
session_start();
//redirect if not logged in
if (!isset($_SESSION['loggedin'])){
  header('Location: \dactr/index.php');
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

    <title>Dactr | My Results</title>

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
            <a class="nav-link" href="\dactr/php/logout.php">Logout</a>
          </nav>
        </div>
      </header>
      <!-- Results -->
      <main>
        <div class="row">
          <h1>Feedback</h1>
        </div>
        <div class="row">
          <?php //provide journal made
          ?><p> 1Make sure to eat plenty of mac and cheese</p><?php
          # Includes the autoloader for libraries installed with composer
          require __DIR__ . '/vendor/autoload.php';
          ?><p> 2Make sure to eat plenty of mac and cheese</p><?php
          # Imports the Google Cloud client library
          use Google\Cloud\Language\LanguageClient;
          ?><p> 3Make sure to eat plenty of mac and cheese</p><?php
          # Your Google Cloud Platform project ID
          $projectId = 'dactr-272020';
          ?><p> 4Make sure to eat plenty of mac and cheese</p><?php
          # Instantiates a client
          $language = new LanguageClient([
            'projectId' => $projectId
          ]);
          ?><p> 5Make sure to eat plenty of mac and cheese</p><?php
          # The text to analyze
          $text = 'Hello, world!';
          ?><p> 6Make sure to eat plenty of mac and cheese</p><?php
          # Detects the sentiment of the text
          $annotation = $language->analyzeSentiment($text);
          $sentiment = $annotation->sentiment();
          ?><p> 7Make sure to eat plenty of mac and cheese</p><?php
          echo 'Text: ' . $text . '
          Sentiment: ' . $sentiment['score'] . ', ' . $sentiment['magnitude'];
          ?><p> 8Make sure to eat plenty of mac and cheese</p><?php
          ?>
        </div>
        <div class="row">
          <p> Make sure to eat plenty of mac and cheese</p>
        </div>
      </main>
      <!-- Footer -->
      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>&copy; PyFresh</p>
        </div>
      </footer>
    </div>
  </body>

</html>
