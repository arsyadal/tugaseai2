<?php
$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';
$league_id = 148;

$curl_options = array(
    CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_topscorers&league_id=$league_id&APIkey=$APIkey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

$players = json_decode($result, true);

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <style>
        .table { border-collapse: collapse; }
        .table th, .table td { border: 1px solid #e2e8f0; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead class="bg-blue-500 text-white text-center">
        <tr>
            <th>Place</th>
            <th>Name</th>
            <th>Team</th>
            <th>Goals</th>
            <th>Assists</th>
            <th>Penalty Goals</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (is_array($players)) {
            foreach ($players as $player) { ?>
                <tr>
                    <td><?php echo isset($player['player_place']) ? $player['player_place'] : ''; ?></td>
                    <td><?php echo isset($player['player_name']) ? $player['player_name'] : ''; ?></td>
                    <td><?php echo isset($player['team_name']) ? $player['team_name'] : ''; ?></td>
                    <td><?php echo isset($player['goals']) ? $player['goals'] : ''; ?></td>
                    <td><?php echo isset($player['assists']) ? $player['assists'] : ''; ?></td>
                    <td><?php echo isset($player['penalty_goals']) ? $player['penalty_goals'] : ''; ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>
</div>
</body>
</html>
