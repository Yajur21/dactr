<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>

    <!-- Custom CSS from Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Custom page CSS -->
    <link href="css/login.css" rel="stylesheet" type="text/css">

  </head>

  <body>
    <div class="register">
			<h1>Login</h1>
      <!-- Login Form -->
      <form method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
        <label for="password">
					<i class="fas fa-lock"></i>
				</label>
			  <input type="password" name="password" placeholder="Password" id="password" required>
        <a href="php/register.php" style:"padding:5px">Click here to register</a>
				<input type="submit" value="login">
			</form>

      <?php //Login code
      session_start();

      //Connecting to the login database
      $DATABASE_HOST = 'localhost';
      $DATABASE_USER = 'root';
      $DATABASE_PASS = '';
      $DATABASE_NAME = 'dactrlogin';
      $connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
      //Stop if a connection error occurs
      if (mysqli_connect_errno()){
        exit('Failed to connect' .mysqli_connect_error());
      }

      //Send an error if login data was not submitted
      if (!isset($_POST['username'], $_POST['password'])){
        exit();
      }

      //Prepare SQL to prevent injection
      if ($stmt = $connection->prepare('SELECT id, password FROM accounts WHERE username = ?')){
        //Bind parameters
        $stmt->bind_param('s', $_POST['username']);
      	$stmt->execute();
        //Store result so we can check if it exists
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
        	$stmt->bind_result($id, $password);
        	$stmt->fetch();
        	// Account exists, now verify the password
        	// Since password is hashed, we need to use password_verify to check if its the same
          if (password_verify($_POST['password'], $password)) {
          	// Create sessions so we know the user is logged in and
            // can use variables without having to reconnect to database
          	session_regenerate_id();
          	$_SESSION['loggedin'] = TRUE;
          	$_SESSION['name'] = $_POST['username'];
          	$_SESSION['id'] = $id;
            // redirect to home page
            header('Location: \dactr/pages/home.php');
           }
          else {
            ?>
              <p class="text-danger">Incorrect password</p>
            <?php
          }
        }
        else {
          ?>
            <p class="text-danger">Incorrect username</p>
          <?php
        }

        $stmt->close();
      }
      ?>

		</div>
  </body>

  </html>
