<?php
try {
   $dbh = new PDO('mysql:host=localhost;dbname=buku', "root", "");
   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
   $stmt = $dbh->prepare('INSERT INTO kategori VALUES
   (:id, :kode, :kategori)');
  

   $stmt->bindParam(':id', $id);
   $stmt->bindParam(':kode', $kode);
   $stmt->bindParam(':kategori', $kategori);
       
   $id = $_POST["id"];
   $kode = $_POST["kode"];
   $kategori = $_POST["kategori"];
  
   $stmt->execute();
  
 
   echo $stmt->rowCount()." data berhasil ditambahkan";
  
 
   $dbh = null;
 
} catch (PDOException $e) {
  
   print "koneksi/query bermasalah: " . $e->getMessage() . "<br/>";
   die();
}
?>