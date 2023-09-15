<?php
try{
    $veritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=test", "root", "");
}catch(PDOException $hata){
    echo $hata->getMessage();
    die();
}

function Filtre($deger){
    $bir = trim($deger);
    $iki = strip_tags($bir);
    $uc = htmlspecialchars($iki, ENT_QUOTES);
    $sonuc = $uc;
    return $sonuc;
}

$IpAdresi = $_SERVER["REMOTE_ADDR"];
$zamanDamgasi = time();
$oyKullanmaSiniri = 1;
$zamaniGeriAl = $zamanDamgasi-$oyKullanmaSiniri;  

?>