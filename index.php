<?php
// session_start();
require_once 'config.php';

if (!isset($_SESSION['player_id'])) {
    header('Location: login.php');
    exit;
}

$player_id = $_SESSION['player_id'];
R::debug(false);
$player = R::load('players', $player_id);
$current_port = $player->current_port;

$ports = R::findAll('ports');
$portName = $ports[$current_port]->name;
$goods = R::findAll('goods', 'port = ?', [$current_port]);

// Example arrival time from the database
$estimated_arrival_time = $player->arriving_time; // assuming $travel_hours is calculated

// Convert time to player's timezone
$player_timezone = new DateTimeZone($player->timezone);
$server_timezone = new DateTimeZone(date_default_timezone_get());


$datetime = new DateTime('@' . $estimated_arrival_time);
$datetime->setTimezone($server_timezone); // first set it to the server's timezone
$datetime->setTimezone($player_timezone); // then convert to player's timezone

if($player->arriving_time > time()) {
  $rand = rand(1, 35);
  $image ='departed/departed'.$rand.'.jpg';
  // $portName = 'Sailed to ' . $portName. '. Estimated arrival time: ' . date('Y-m-d H:i', $player->arriving_time);
  $portName = 'Sailed to ' . $portName. '. Estimated arrival time: ' . $datetime->format('Y-m-d H:i');;
} else {  
  $image =  R::load('ports', $current_port)->name .'_port.jpg';
  // Update player's current port, destination, and travel status
  $player->destination = 0;
  $player->departed = 0;
  $player->departure_time = 0; // Current timestamp for departure time
  $player->arriving_time = 0;
  R::store($player);
}

// $temp = $twig->loadTemplate('index.html');
// echo $temp->render(array());
// die;
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

<!-- departed28.jpg very nice -->

<body style="background-image: url(ports/<?php echo $image; ?>);">
  <div class="container">
    <div class="container-fluid player-info text-right my-3">
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
    <h1 class="text-center my-4">Trading Ships Game</h1>
    <div id="player-info" class="card text-white bg-dark mb-4">
      <div class="card-body">
        <p>Gold: <?php echo $player->gold; ?> coins</p>
        <p>Ship Capacity: <?php echo $player->ship_capacity; ?> tons</p>
        <p>Current Port: <span id="current-port"><?php echo $portName; ?></span></p>
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
    <?php if($player->departed == 0 && $player->destination == 0 && ($player->arriving_time <= $player->departure_time)):?>
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
    <?php endif; ?>
    <!-- // end of #ports -->


  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>