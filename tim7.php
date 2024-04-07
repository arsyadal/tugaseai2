<?php
$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';
$team_id = 11;

$curl_options = array(
  CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_teams&team_id=$team_id&APIkey=$APIkey",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => false,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

// Cek apakah ada kesalahan saat mengambil data dari API
if ($result === false) {
    echo "Error: " . curl_error($curl);
} else {
    $team_data = json_decode($result, true);

    // Cek apakah data tim ditemukan
    if (!empty($team_data) && isset($team_data[0]['team_name']) && isset($team_data[0]['players'])) {
        $team_name = $team_data[0]['team_name'];
        $players = $team_data[0]['players'];
    } else {
        echo "Team data not found or empty.";
    }
}

curl_close($curl);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.1/dist/full.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .table {
            border-collapse: collapse;
        } /* Menambahkan CSS untuk border-collapse */
        .table th, .table td {
            border: 1px solid #e2e8f0;
            padding: 8px;
        } /* Menambahkan CSS untuk border antar sel */
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';
$team_id = 11;

$curl_options = array(
  CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_teams&team_id=$team_id&APIkey=$APIkey",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => false,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

// Cek apakah ada kesalahan saat mengambil data dari API
if ($result === false) {
    echo "Error: " . curl_error($curl);
} else {
    $team_data = json_decode($result, true);

    // Cek apakah data tim ditemukan
    
    if (!empty($team_data) && isset($team_data[0]['team_name']) && isset($team_data[0]['team_badge'])) {
        $team_name = $team_data[0]['team_name'];
        $team_badge = $team_data[0]['team_badge'];
    } else {
        echo "Team data not found or empty.";
    }
}

curl_close($curl);
?>
<div class="hero min-h-screen" style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Ukro-Maki_%2812%29.jpg/450px-Ukro-Maki_%2812%29.jpg);">
<div class="card w-flex bg-base-100 shadow-xl flex flex-col items-center mt-10 mb-10">

  <figure><img src="<?php echo $team_badge; ?>" alt="<?php echo $team_name; ?>" style="max-width: 100px; max-height: 100px;"></figure>
  <h1 class="text-center"><?php echo $team_name; ?></h1>
  <div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead class="bg-blue-500 text-white text-center">
      <tr>
          <th>Player Name</th>
          <th>Number</th>
          <th>Country</th>
          <th>Type</th>
          <th>Age</th>
          <th>Match Played</th>
          <th>Goals</th>
          <th>Assists</th>
          <th>Yellow Cards</th>
          <th>Red Cards</th>
          <th>Injured</th>
          <th>Substitute Out</th>
          <th>Substitutes on Bench</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($players as $player) { ?>
          <tr>
              <td><?php echo $player['player_name']; ?></td>
              <td><?php echo $player['player_number'] ?? ''; ?></td>
              <td><?php echo $player['player_country'] ?? ''; ?></td>
              <td><?php echo $player['player_type'] ?? ''; ?></td>
              <td><?php echo $player['player_age'] ?? ''; ?></td>
              <td><?php echo $player['player_match_played'] ?? ''; ?></td>
              <td><?php echo $player['player_goals'] ?? ''; ?></td>
              <td><?php echo $player['player_assists'] ?? ''; ?></td>
              <td><?php echo $player['player_yellow_cards'] ?? ''; ?></td>
              <td><?php echo $player['player_red_cards'] ?? ''; ?></td>
              <td><?php echo $player['player_injured'] ?? ''; ?></td>
              <td><?php echo $player['player_substitute_out'] ?? ''; ?></td>
              <td><?php echo $player['player_substitutes_on_bench'] ?? ''; ?></td>
          </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  </div>

</div>



</body>
</html>
