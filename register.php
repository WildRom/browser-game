<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nick_name = $_POST['nick_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $ip = $_SERVER['REMOTE_ADDR'];
    $timezone = isset($_POST['timezone']) ? $_POST['timezone'] : 'Europe/London';
    $time = time();

    // Check if nickname or email already exists
    $existing_nickname = R::findOne('players', 'nick_name = ?', [$nick_name]);
    $existing_email = R::findOne('players', 'email = ?', [$email]);

    if ($existing_nickname) {
        echo "Nickname already taken. Please choose another.";
    } elseif ($existing_email) {
        echo "Email already registered. Please use another email.";
    } else {
      // Nickname and email are unique, proceed with registration
    $player = R::dispense('players');
    $player->nick_name = $nick_name;
    $player->email = $email;
    $player->password = $password;
    $player->timezone = $timezone; // Save timezone
    $player->group = 1;
    $player->avatar = 'default.png';
    $player->ip = $ip;
    $player->gold = 100;
    $player->ship_capacity = 20;
    $player->current_port = 1;
    $player->departed = 0;
    $player->departure_time = $time;
    $player->created_at = $time;
    $player->updated_at = $time;

    R::store($player);

    $_SESSION['player_id'] = $player->id;

    header('Location: index.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div id="register-form" class="container">
    <h1 class="text-center my-4">Register</h1>
    <form method="POST" action="register.php">
      <div class="form-group">
        <label for="nick_name">Nickname</label>
        <input type="text" class="form-control" id="nick_name" name="nick_name" required>
      </div>

      <!-- Hidden input to store the client's timezone -->
      <input type="hidden" id="timezone" name="timezone">

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div class="text-center mt-3">
      <a href="login.php" class="login">Already have an account? Login here</a>
    </div>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get the client's timezone
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.getElementById("timezone").value = timezone;
  });
  </script>
</body>

</html>