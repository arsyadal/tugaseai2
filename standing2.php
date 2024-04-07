<?php

$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';
$league_id = 140;

$curl_options = array(
    CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_standings&league_id=$league_id&APIkey=$APIkey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

$teams = json_decode($result, true);

if ($teams && isset($teams['errors'])) {
    echo "Error: " . $teams['message'];
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.1/dist/full.min.css" rel="stylesheet" type="text/css" />
        <style>
            .table { border-collapse: collapse; } /* Menambahkan CSS untuk border-collapse */
            .table th, .table td { border: 1px solid #e2e8f0; } /* Menambahkan CSS untuk border antar sel */
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead class="bg-blue-500 text-white text-center">
            <tr>
                <th>Team</th>
                <th>Position</th>
                <th>Played</th>
                <th>W</th>
                <th>D</th>
                <th>L</th>
                <th>GF</th>
                <th>GA</th>
                <th>PTS</th>
                <th>Badge</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($teams as $team) { ?>
                <tr>
                    <td><?php echo $team['team_name']; ?></td>
                    <td><?php echo $team['overall_league_position']; ?></td>
                    <td><?php echo $team['overall_league_payed']; ?></td>
                    <td><?php echo $team['overall_league_W']; ?></td>
                    <td><?php echo $team['overall_league_D']; ?></td>
                    <td><?php echo $team['overall_league_L']; ?></td>
                    <td><?php echo $team['overall_league_GF']; ?></td>
                    <td><?php echo $team['overall_league_GA']; ?></td>
                    <td><?php echo $team['overall_league_PTS']; ?></td>
                    <td><img src="<?php echo $team['team_badge']; ?>" alt="<?php echo $team['team_name']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
    <?php
}

?>
