<?php
$data = json_decode(file_get_contents('php://input'), true);
if($data){
    file_put_contents('content.json', json_encode($data, JSON_PRETTY_PRINT));
    echo "Changes saved!";
} else {
    echo "No data received.";
}
?>
