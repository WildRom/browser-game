<?php
// travel.php

require_once 'config.php';


// Check if player is logged in
if (!isset($_SESSION['player_id'])) {
    header('Location: login.php');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination_id'])) {
    $player_id = $_SESSION['player_id'];
    $destination_id = $_POST['destination_id'];

    // Fetch player details
    $player = R::load('players', $player_id);

    // Fetch destination details
    $destination = R::load('ports', $destination_id);
    
    // *************************** THIS PART SHOULD BE COMMENTED FOR TESTING PURPOSES ***************************
    // Update player's current port, destination, and travel status
    // $player->current_port = 0; // Assuming 0 represents "en route"
    $player->current_port = $destination_id;
    $player->destination = $destination_id;
    $player->departed = 1;
    $player->departure_time = time(); // Current timestamp for departure time

    // Calculate arriving time (example: add 5 hours to departure time)
    //TODO calculate properly arriving time
    $arriving_time = strtotime('+1 minute', $player->departure_time);
    $player->arriving_time = $arriving_time;
    // *************************** THIS IS END OF PART DISABLED FOR TESTING PURPOSES ***************************

    
    // Store changes in database
    R::store($player);

    // Redirect to index.php or another page after processing
    header('Location: index.php');
    exit;
}

// If no form submission, continue displaying travel options

$player_id = $_SESSION['player_id'];

// Fetch player details including current port and other relevant information
$player = R::load('player', $player_id);

$current_port_id = $player->current_port;

// Fetch destinations (ports other than current)
$destinations = R::find('port', ' id != :current_id ', [':current_id' => $current_port_id]);

// Display user info and travel options
echo "<h1>Welcome, {$player->nick_name}!</h1>";
echo "<p>Current port: {$current_port->port_name}</p>";

// Display travel form
echo "<h2>Travel Options:</h2>";
echo "<form method='post'>";
echo "<select name='destination_id'>";
foreach ($destinations as $destination) {
    echo "<option value='{$destination->id}'>Sail to {$destination->port_name}</option>";
}
echo "</select>";
echo "<button type='submit'>Sail!</button>";
echo "</form>";
?>