<?php
//updatebyid.php

include 'connection.php';

$conn = getConnection();

try {
    if($_POST) {
        $id = $_POST["id"];
        $kode = $_POST["kode"];
        $kode_kategori = $_POST["kode_kategori"];
        $judul = $_POST["judul"];
        $pengarang = $_POST["pengarang"];
        $penerbit = $_POST["penerbit"];
        $tahun = $_POST["tahun"];
        $harga = $_POST["harga"];
        $file_cover = $_POST["file_cover"];

        $statement = $conn->prepare("SELECT * FROM data_buku WHERE kode = :kode");
        $statement->bindParam(':kode', $kode);
        $statement->execute();
        $result = $statement->fetch();

        if($result){

            if(isset($_FILES['file_cover']['name'])){
                $image_name = $_FILES['file_cover']['name'];
                $extension_file = ["jpg", "png", "jpeg"];
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);

                if (in_array($extension, $extension_file)){
                    $upload_path = 'upload/' . $image_name;

                    if(move_uploaded_file($_FILES['file_cover']['tmp_name'], $upload_path)){
                        $message = "berhasil";
                        $keterangan = "https://lutproject.my.id/donasi/".$upload_path;
                      
                      	echo $image;

                        $statement = $conn->prepare("UPDATE `data_buku` SET id = :id, kode = :kode, kode_kategori = :kode_kategori, judul = :judul, pengarang = :pengarang, penerbit = :penerbit, tahun = :tahun, harga = :harga, file_cover = :file_cover WHERE id = :id");

                        $statement->bindParam(':id', $id);
                        $statement->bindParam(':kode',$kode);
                        $statement->bindParam(':kode_kategori',$kode_kategori);
                        $statement->bindParam(':judul',$judul);
                        $statement->bindParam(':pengarang',$pengarang);
                        $statement->bindParam(':penerbit', $penerbit);
                        $statement->bindParam(':tahun',$tahun);
                        $statement->bindParam(':harga',$harga);
                        $statement->bindParam(':file_cover',$file_cover);

                    } else {
                        $message = "Terjadi kesalahan saat mengupload gambar";
                    }
                } else {
                    $message = "Hanya diperbolehkan mengupload file gambar!";
                    $response["message"] = $message;
                    $json = json_encode($response, JSON_PRETTY_PRINT);

                    echo $json;
                    die();
                }
            } else {
                $statement = $conn->prepare("UPDATE `data_buku` SET id = :id, kode = :kode, kode_kategori = :kode_kategori, judul = :judul, pengarang = :pengarang, penerbit = :penerbit, tahun = :tahun, harga = :harga, file_cover = :file_cover WHERE id = :id");

                $statement->bindParam(':id', $id);
                $statement->bindParam(':kode',$kode);
                $statement->bindParam(':kode_kategori',$kode_kategori);
                $statement->bindParam(':judul',$judul);
                $statement->bindParam(':pengarang',$pengarang);
                $statement->bindParam(':penerbit', $penerbit);
                $statement->bindParam(':tahun',$tahun);
                $statement->bindParam(':harga',$harga);
                $statement->bindParam(':file_cover',$file_cover);
            }
            $statement->execute();
            $response["message"] = "Data berhasil di ubah!";
        } else {
            $response["message"] = "Data tidak ditemukan!";
        }
    }
} catch(PDOException $e) {
    $response["message"] = "Error . $e";
}
$json = json_encode($response, JSON_PRETTY_PRINT);

//print json
echo $json;