<?php 
require_once('db-connect.php');

// בדוק אם הגישו את ה-ID
if(!isset($_POST['id'])){
    echo json_encode(['success' => false]);
    exit;
}

$eventId = $_POST['id'];

// בצע את המחיקה מהטבלה המתאימה
$delete = $conn->query("DELETE FROM `schedule_list` WHERE id = '$eventId'");

// בדוק אם המחיקה בוצעה בהצלחה והחזר תגובה JSON
if($delete){
    echo json_encode(['success' => true]);
}else{
    echo json_encode(['success' => false]);
}

$conn->close();
?>
