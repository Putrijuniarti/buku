
<?php

include 'connection.php';

$conn = getConnection();

try {
    if ($_POST) {    
        $id = $_POST["id"];
        $nomor = $_POST["nomor"];
        $nama = $_POST["nama"];
        $gender = $_POST["gender"];
        $alamat = $_POST["alamat"];
        $no_hp = $_POST["no_hp"];
       
        $statement = $conn->prepare("SELECT * FROM anggota WHERE nomor = :nomor;");
        $statement->bindParam(':nomor', $nomor);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            $statement = $conn->prepare("UPDATE anggota SET id = :id, nomor = :nomor, nama = :nama, gender = :gender, alamat = :alamat, no_hp = :no_hp");
            $statement->bindParam(':id', $id);
            $statement->bindParam(':nomor', $nomor);
            $statement->bindParam(':nama', $nama);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':alamat', $alamat);
            $statement->bindParam(':no_hp', $no_hp);
            
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