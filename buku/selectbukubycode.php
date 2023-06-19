<?php
include 'connection.php';

$conn = getConnection();

$kode = $_GET["kode"];

try {
    $statement = $conn->prepare("SELECT * FROM data_buku WHERE kode = :kode;");
    $statement->bindParam(':kode', $kode);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_OBJ);
    $result = $statement->fetch();

    if($result){
        echo json_encode($result, JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        $response["message"] = "kode tidak ditemukan";
        echo json_encode($response,JSON_PRETTY_PRINT);
    }

} catch (PDOException $e) {
    echo $e;
}