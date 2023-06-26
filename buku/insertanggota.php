<?php
try {
   $dbh = new PDO('mysql:host=localhost;dbname=buku', "root", "");
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
   $stmt = $dbh->prepare('INSERT INTO anggota VALUES
   (:id, :nomor, :nama, :gender, :alamat, :no_hp, :tanggal_terdaftar)');
  

   $stmt->bindParam(':id', $id);
   $stmt->bindParam(':nomor', $nomor);
   $stmt->bindParam(':nama', $nama);
   $stmt->bindParam(':gender', $gender);
   $stmt->bindParam(':alamat', $alamat);
   $stmt->bindParam(':no_hp', $no_hp);
   $stmt->bindParam(':tanggal_terdaftar', $tanggal_terdaftar);
       
   $id = $_POST["id"];
   $nomor = $_POST["nomor"];
   $nama = $_POST["nama"];
   $gender = $_POST["gender"];
   $alamat = $_POST["alamat"];
   $no_hp = $_POST["no_hp"];

  
   $stmt->execute();
  
 
   echo $stmt->rowCount()." data berhasil ditambahkan";
  
 
   $dbh = null;
 
} catch (PDOException $e) {
  
   print "koneksi/query bermasalah: " . $e->getMessage() . "<br/>";
   die();
}
?>