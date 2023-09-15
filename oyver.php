<?php
require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oyverme İşlemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="card" style="width: 50rem;margin-right: auto;margin-left: auto;margin-top: 45px;background-color: ghostwhite;">

<?php
$gelenCevap = Filtre($_POST["cevap"]);

$kontrolSorgusu = $veritabaniBaglantisi->prepare("SELECT * FROM oykullananlar WHERE ipadresi = ? AND tarih >= ?");
$kontrolSorgusu->execute([$IpAdresi, $zamaniGeriAl]);
$kontrolSayisi = $kontrolSorgusu->rowCount();

if($kontrolSayisi>0){
?>
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
			<td colspan="2"><p style="margin-top: 19px;margin-left: -2px;">HATA</p></td>
	    </tr>
		<tr height="30">
			<td width="225"><p>Daha önce oy kullanmışsınız. Lütfen en az 24 saat sonra tekrar deneyiniz.</p></td>
		</tr>
		<tr height="30">
			<td width="225"><p>Anasayfaya dönnmek için <a href="index.php" style="text-decoration: none;color: mediumpurple;">Tıklayınız.</a></p></td>
		</tr>
    </table>
<?php
}else{

    if($gelenCevap==1){
        $guncelle = $veritabaniBaglantisi->prepare("UPDATE anket SET oysayisibir=oysayisibir+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }elseif($gelenCevap==2){
        $guncelle = $veritabaniBaglantisi->prepare("UPDATE anket SET oysayisiiki=oysayisiiki+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }elseif($gelenCevap==3){
        $guncelle = $veritabaniBaglantisi->prepare("UPDATE anket SET oysayisiuc=oysayisiuc+1, toplamoysayisi=toplamoysayisi+1");
        $guncelle->execute();
    }else{
?>
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
			<td colspan="2"><p style="margin-top: 19px;margin-left: -2px;">HATA!</p></td>
	    </tr>
		<tr height="30">
			<td width="225"><p>Cevap Kaydı Bulunamıyor.</p></td>
		</tr>
		<tr height="30">
			<td width="225"><p>Anasayfaya dönnmek için <a href="index.php" style="text-decoration: none;color: mediumpurple;" >Tıklayınız.</a></p></td>
		</tr>
    </table>
<?php
}

    $ekle = $veritabaniBaglantisi->prepare("INSERT INTO oykullananlar (ipadresi, tarih) values (?, ?)");
    $ekle->execute([$IpAdresi, $zamanDamgasi]);
    $ekleKontrol = $ekle->rowCount();

    if($ekleKontrol>0){
?>
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
			<td colspan="2"><p style="margin-top: 19px;margin-left: -2px;">Teşekkürler!</p></td>
	    </tr>
		<tr height="30">
			<td width="225"><p>Vermiş Olduğunuz Oy Sisteme Kaydedildi.</p></td>
		</tr>
		<tr height="30">
			<td width="225"><p>Anasayfaya dönnmek için <a href="index.php" style="text-decoration: none;color: mediumpurple;">Tıklayınız.</a></p></td>
		</tr>
    </table>
        
<?php 
}else{
?>       
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="30">
			<td colspan="2"><p style="margin-top: 19px;margin-left: -2px;">HATA!</p></td>
	    </tr>
		<tr height="30">
			<td width="225"><p>İşlem Sırasında Beklenmeyen Bir Hata Oluştu. Lütfen Daha Sonra Tekrar Deneyiniz.</p></td>
		</tr>
		<tr height="30">
			<td width="225"><p>Anasayfaya dönnmek için <a href="index.php" style="text-decoration: none;color: mediumpurple;">Tıklayınız.</a></p></td>
		</tr>
    </table>
<?php  }
}
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>

<?php
$veritabaniBaglantisi = null;
?>