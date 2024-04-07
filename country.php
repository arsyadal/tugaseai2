<?php

$APIkey = '41f2e70d7981a90c843d0f18ff6f4d893ca35e414314c08230993ae8e5cd9489';

$curl_options = array(
    CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_countries&APIkey=$APIkey&limit=100", // Ubah limit sesuai kebutuhan Anda
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 5
);

$curl = curl_init();
curl_setopt_array($curl, $curl_options);
$result = curl_exec($curl);

$countries = json_decode($result, true);

if ($countries && isset($countries['errors'])) {
    echo "Error: " . $countries['message'];
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
                <th>ID</th>
                <th>Name</th>
                <th>Logo</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($countries as $country) { ?>
                <tr>
                    <td><?php echo $country['country_id']; ?></td>
                    <td><?php echo $country['country_name']; ?></td>
                    <td><img src="<?php echo $country['country_logo']; ?>" alt="<?php echo $country['country_name']; ?>" style="max-width: 100px; max-height: 100px;"></td>
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
