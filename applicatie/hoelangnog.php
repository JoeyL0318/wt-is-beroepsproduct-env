<?php

$vandaag = date_create('now');
$sinterklaas = date_create('2024-12-05');
$datediff = date_diff($vandaag,$sinterklaas);
$santaklaus = $datediff->format("%a dagen");

$landen = [
    'nl' => "Nederland",
    'DE' => 'duitsland',
    'be' => 'belgië'
    ];
$landen['fr'] = 'Frankrijk';

var_dump(value: $landen);

echo '<br>';
foreach ($landen as $index => $land) {
    echo $index . ' = ' . $land . '<br>';
}
echo '<br>';
for ($i = 0; $i < count($landen); $i++) {
    echo $i . ' = ' . $landen[$i] . '<br>';
}

$menu = [
    'eten' => [
        'hamburger' => 5.50,
        'döner' => 9.00
    ],
    'drinken' => [
        'cola' => 2.50
    ],
];

function showMenuItem($array): string {
    $html = <<<HTML 
    <table>
        <thead>
            <tr>
                <th>Food</th>
                <th>Price</th>
            </tr>
                </thead>
                <tbody>
    HTML;

    foreach ( $array as $item => $prijs ) {
        $html = <<<HTML
        <tr>
            <td>"{$item}"</td>
            <td>"{$prijs}"</td>
        </tr>
        HTML;
    }
}
foreach ($menu as $key => $array) {
    echo <h2>$key</h2>
    if (isarray(value: $array))
}

$html = '</tbody></table>';

return $html;


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>PHP voorbeeld</title>
</head>
<body>
    Het duurt nog <?= $santaklaus ?> tot sinterklaas.
</body>
</html>
