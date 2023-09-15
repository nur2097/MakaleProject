<?php
require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anket Sonuçları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="card" style="width: 50rem;margin-right: auto;margin-left: auto;margin-top: 45px;background-color: ghostwhite;">
    <?php
    $anketSorgusu = $veritabaniBaglantisi->prepare("SELECT * FROM anket LIMIT 1");
    $anketSorgusu->execute();
    $kayitSayisi = $anketSorgusu->rowCount();
    $kayit = $anketSorgusu->fetch(PDO::FETCH_ASSOC);

    $anketinBirinciSikkiIcinOySayisi = $kayit["oysayisibir"];
    $anketinIkinciSikkiIcinOySayisi  = $kayit["oysayisiiki"];
    $anketinUcuncuSikkiIcinOySayisi  = $kayit["oysayisiuc"];
    $anketinToplamOySayisi = $kayit["toplamoysayisi"];

    $birinciSecenekIcinYuzdeHesapla = ($anketinBirinciSikkiIcinOySayisi/$anketinToplamOySayisi)*100;
    $birinciSecenekIcinYuzde = number_format($birinciSecenekIcinYuzdeHesapla, 2, ",", "");
    $ikinciSecenekIcinYuzdeHesapla = ($anketinIkinciSikkiIcinOySayisi/$anketinToplamOySayisi)*100;
    $ikinciSecenekIcinYuzde = number_format($ikinciSecenekIcinYuzdeHesapla, 2, ",", "");
    $ucuncuSecenekIcinYuzdeHesapla = ($anketinUcuncuSikkiIcinOySayisi/$anketinToplamOySayisi)*100;
    $ucuncuSecenekIcinYuzde = number_format($ucuncuSecenekIcinYuzdeHesapla, 2, ",", "");

    if($kayitSayisi>0){
    ?>
    <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="30">
			<td colspan="2"><p style="margin-top: 19px;margin-left: -2px;"><?php echo $kayit["soru"]; ?></p></td>
		</tr>
		<tr height="30">
			<td width="75">%<?php echo $birinciSecenekIcinYuzde; ?></td>
			<td width="225"><?php echo $kayit["cevapbir"]; ?></td>
		</tr>
		<tr height="30">
			<td width="75">%<?php echo $ikinciSecenekIcinYuzde; ?></td>
			<td width="225"><?php echo $kayit["cevapiki"]; ?></td>
		</tr>
		<tr height="30">
			<td width="75">%<?php echo $ucuncuSecenekIcinYuzde; ?></td>
			<td width="225"><?php echo $kayit["cevapuc"]; ?></td>
		</tr>
		<tr height="30">
			<td colspan="2" align="right">
                <p style="margin-right: -235px;margin-bottom: 13px;"><a href="index.php" class="btn btn-outline-secondary" style="text-decoration: none;" role="button">Ana Sayfaya Dön</a></p>
            </td>
		</tr>
    
    </table>
    
    <?php
    }else{
        header("Location:index.php");
        exit();
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