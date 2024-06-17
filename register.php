<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nick_name = $_POST['nick_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $ip = $_SERVER['REMOTE_ADDR'];
    $time = time();

    $player = R::dispense('players');
    $player->nick_name = $nick_name;
    $player->email = $email;
    $player->password = $password;
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
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
      <a href="login.php">Already have an account? Login here</a>
    </div>
  </div>
</body>

</html>