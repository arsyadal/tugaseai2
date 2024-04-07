<?php
$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';
$player_name = "Benzema";

// Kirim permintaan untuk mendapatkan data pemain
$curl_options = array(
    CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_players&player_name=$player_name&APIkey=$APIkey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

// Periksa apakah hasil permintaan tidak kosong
if ($result !== false) {
    $player_info = json_decode($result, true);

    // Periksa apakah ada data pemain yang ditemukan
    if (!empty($player_info)) {
        // Cek apakah data pemain tersedia
        if (isset($player_info['player_name'])) {
            $players[] = $player_info;
        } else {
            echo "Player data not found.";
        }
    } else {
        echo "No player data found.";
    }
} else {
    echo "Error: " . curl_error($curl);
}

curl_close($curl);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <style>
        .table { border-collapse: collapse; } /* Menambahkan CSS untuk border-collapse */
        .table th, .table td { border: 1px solid #e2e8f0; padding: 8px; } /* Menambahkan CSS untuk border antar sel */
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
            <th>Minutes Played</th>
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
                <td><?php echo $player['player_minutes'] ?? ''; ?></td>
                <td><?php echo $player['player_injured'] ?? ''; ?></td>
                <td><?php echo $player['player_substitute_out'] ?? ''; ?></td>
                <td><?php echo $player['player_substitutes_on_bench'] ?? ''; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
