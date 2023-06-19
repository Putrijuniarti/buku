
<?php

include 'connection.php';

$conn = getConnection();

try {
    if ($_POST) {
        $id = $_POST["id"];
        $kode = $_POST["kode"];
        $kategori = $_POST["kategori"];
        $kode = $_POST["kode"];

        $statement = $conn->prepare("SELECT * FROM kategori WHERE kode = :kode;");
        $statement->bindParam(':kode', $kode);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            $statement = $conn->prepare("UPDATE kategori SET id = :id, kode = :kode, kategori = :kategori");
            $statement->bindParam(':id', $id);
            $statement->bindParam(':kode', $kode);
            $statement->bindParam(':kategori', $kategori);
            $statement->execute();

            $response['message'] = "Update Berhasil";
        } else {
            http_response_code(404);
            $response['message'] = "informasi tidak ditemukan";
        }

    } else {
        $response['message'] = "Update Gagal";
    }
} catch (PDOException $e) {
    echo $e;
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;