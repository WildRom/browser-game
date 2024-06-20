<?php
// session_start();
require_once 'config.php';

if (!isset($_SESSION['player_id'])) {
    header('Location: login.php');
    exit;
}

$player_id = $_SESSION['player_id'];
$player = R::load('players', $player_id);
$current_port = $player->current_port;

$ports = R::findAll('ports');
$goods = R::findAll('goods', 'port = ?', [$current_port]);

$class =  strtolower(R::load('ports', $current_port)->name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <title>Trading Ships Game</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body class="<?= $class; ?>">
  <div class="container">
    <div class="container-fluid player-info text-right my-3">
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <h1 class="text-center my-4">Trading Ships Game</h1>
    <div id="player-info" class="card text-white bg-dark mb-4">
      <div class="card-body">
        <p>Gold: <?php echo $player->gold; ?> coins</p>
        <p>Ship Capacity: <?php echo $player->ship_capacity; ?> tons</p>
        <p>Current Port: <span id="current-port"><?php echo R::load('ports', $current_port)->name; ?></span></p>
      </div>
    </div>


    <!-- TODO #market - Display none for a while, edit later-->
    <div id="market" class="card mb-4">
      <div class="card-body">
        <h2>Market in <?php echo R::load('ports', $current_port)->name; ?></h2>
        <table class="table">
          <thead>
            <tr>
              <th>Good</th>
              <th>Buy Price</th>
              <th>Sell Prices in Other Ports</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($goods as $good): ?>
            <tr>
              <td><?php echo htmlspecialchars($good->name); ?></td>
              <td><?php echo $good->buy_price; ?> coins</td>
              <td>
                <?php
                  $sell_prices = R::findAll('goods', 'name = ? AND port != ?', [$good->name, $current_port]);
                  foreach ($sell_prices as $sell_price) {
                      echo R::load('ports', $sell_price->port)->name . ": " . $sell_price->sell_price . " coins<br>";
                  }
                ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- end of #market -->


    <div id="ports" class="row">
      <?php foreach($ports as $port): ?>
      <?php if ($port->id == $current_port) continue; ?>
      <div class="col-md-4 mb-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($port->name); ?></h5>
            <form method="POST" action="travel.php">
              <input type="hidden" name="destination_id" value="<?php echo $port->id; ?>">
              <button type="submit" class="btn btn-primary">Sail to
                <?php echo htmlspecialchars($port->name); ?></button>
            </form>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>