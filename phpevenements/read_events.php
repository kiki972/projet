<?php
require_once 'Database.php';
require_once 'Événement.php';

$database = new Database();
$db = $database->getConnection();

$événement = new Événement($db);
$stmt = $événement->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $events_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $event_item = array(
            "ID_evénement" => $ID_evénement,
            "Titre" => $Titre,
            "Date" => $Date,
            "Lieu" => $Lieu,
            "Description" => $Description
        );
        array_push($events_arr, $event_item);
    }
    echo json_encode($events_arr);
} else {
    echo json_encode(array());
}
?>