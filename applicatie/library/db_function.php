<?php
function toonTabelInhoud($dataset): string {
    $html = '<table>';
    foreach($dataset as $row) {
        $html .= '<tr>';
        for ($i = 0; $i < (count(value:$row)/2); $i++) {
        $html .= '<td>' . $row[$i] . '</td>';
    }
    $html .= '</tr>';
}
$html .= '<table>';
return $html;
}

function toonTabel($db, $tabel): string {
    $sql = "select * from {$tabel}";
    $dataset = $db->query($sql);

    $html = "<h2>{$tabel}</h2>";
    $html .= toonTabelInhoud($dataset);
    return $html;
}

?>