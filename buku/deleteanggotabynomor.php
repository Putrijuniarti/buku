
<?php
// deletebyid.php
include 'connection.php';

$conn = getConnection();

try {
    if (isset($_GET["nomor"])) {
        $nomor = $_GET["nomor"];

        $statement = $conn->prepare("SELECT * FROM anggota WHERE nomor = :nomor;");
        $statement->bindParam(':nomor', $nomor);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $result = $statement->fetch();

        if ($result) {
            $statement = $conn->prepare("DELETE FROM anggota WHERE nomor = :nomor");
            $statement->bindParam("nomor", $nomor);
            $statement->execute();

            $response['message'] = "Delete Data Berhasil";
        } else {
            http_response_code(404);
            $response['message'] = "informasi tidak ditemukan";
        }

    } else {
        $response['message'] = "Delete Data Gagal";
    }
} catch (PDOException $e) {
    echo $e;
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;