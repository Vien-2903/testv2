<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents("php://input"),true);

$STT= isset($data['STT']) ? $data['STT'] : '';
$MSV= isset($data['MSV']) ? $data['MSV'] : '';
$hoten= isset($data['hoten']) ? $data['hoten'] : '';
$tongdiem= isset($data['tongdiem']) ? $data['tongdiem'] : '';

$sql = "SELECT * from sinhvien where MSV= '$MSV' or hoten='$hoten' or tongdiem='$tongdiem'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    echo json_encode([
        'status' => true,
        'manage' => "tim thay sinhvien",
        'user' => [
            'STT' => $user['STT'],
            'MSV' => $user['MSV'],
            'hoten' => $user['hoten'],
            'tongdiem' => $user['tongdiem']
        ]
    ]);
} else {
    echo json_encode([
        'status' => false,
        'manage' => "khong tim thay sinhvien"
    ]);
}
?>