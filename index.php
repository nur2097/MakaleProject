
<?php

try{
    $hostingName = "localhost";
    $dbName = "php_education";
    $username = "root";
    $password = "";

    $pdo = new PDO("mysql:host=$hostingName;dbname=$dbName", $username, $password);
}catch(PDOException $e){
    echo "Hata : " . $e->getMessage();
    die();
}

$sql  = "SELECT * FROM banner ORDER BY gosterim_sayisi ASC LIMIT 1";
$query = $pdo->prepare($sql);
$query->execute();
$add = $query->fetch(PDO::FETCH_ASSOC);


$updateSql = "UPDATE banner SET gosterim_sayisi=? WHERE id=?";
$updateQuery = $pdo->prepare($updateSql);
$updateQuery->execute([$add["gosterim_sayisi"]+1, $add["id"]]);


$sqlMakaleler = "SELECT * FROM makale";
$makalelerQuery = $pdo->prepare($sqlMakaleler);
$makalelerQuery->execute();

$makaleler = $makalelerQuery->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hobbies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div>
    <img src="<?php echo $add["file_path"] ?>" alt="" style="margin-left: 233px;margin-bottom: 37px;">
</div>
    
<div style="display: flex; max-width: 1000px; margin-left: auto; margin-right: auto">
<?php
foreach ($makaleler as $makale)
{
?>
    <div style="width: 300px; height: auto; border: 1px solid #E9E9E9; margin-left: 15px">
        <div>
            <img style="max-width: 300px; height: auto" src="<?php echo $makale["image"]; ?>" alt="">
        </div>

        <div style="text-align: center; border-bottom: 1px dashed #E9E9E9">
            <h4 style="padding: 5px; margin: 0"><?php echo $makale["title"]; ?></h4>
        </div>

        <div style="text-align: center">
            <p><?php echo $makale["description"]; ?></p>
        </div>

        <div style="text-align: right;">
<!--            <form action="detay.php" method="post">-->
<!--                <input type="hidden" name="makale_id" value="--><?php //echo $makale["id"]; ?><!--">-->
<!--                <button type="submit">Git</button>-->
<!--            </form>-->
            <a class="btn btn-outline-secondary" href="detay.php?id=<?php echo $makale["id"]; ?>" role="button" style="text-decoration: none;">İncele</a>
        </div>
    </div>
<?php
}
?>
</div>


<?php
require_once("baglan.php");
?>
<div class="card" style="width: 58rem;margin-left: 276px;margin-top: 21px;background-color: ghostwhite;">

    <?php
        $anketSorgusu = $veritabaniBaglantisi->prepare("SELECT * FROM anket LIMIT 1");
        $anketSorgusu->execute();
        $kayitSayisi = $anketSorgusu->rowCount();
        $kayit = $anketSorgusu->fetch(PDO::FETCH_ASSOC);

        if($kayitSayisi>0){
    ?>
    <form action="oyver.php" method="post">
        <table width="300" align="center" border="0" cellpadding="0" cellspacing="0" style="margin-left: 50px;margin-top: 13px;">
            <tr height="30">
                <td colspan="2"><?php echo $kayit["soru"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="1"></td>
                <td width="275"><?php echo $kayit["cevapbir"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="2"></td>
                <td width="275"><?php echo $kayit["cevapiki"]; ?></td>
            </tr>
            <tr height="30">
                <td width="25"><input type="radio" name="cevap" value="3"></td>
                <td width="275"><?php echo $kayit["cevapuc"]; ?></td>
            </tr>
            <tr height="30">
                <td colspan="2"><input type="submit" class="btn btn-outline-secondary" style="height: 36px;margin-top: 9px;margin-bottom: -21px;" value="Oyumu Gönder"></td>
            </tr>
            <tr height="30">
                <td colspan="2" align="right">
                    <p style="margin-top: -21px;"><a href="sonuclar.php" class="btn btn-outline-secondary" style="text-decoration: none;margin-right: -565px;" role="button">Anket Sonuçlarını Göster</a></p>
                </td>
            </tr>
        </table>
    </form>
    <?php
        }else{
        echo "Anket Bulunmuyor.";
        }
    ?>

</div>
    

    
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
<?php
$veritabaniBaglantisi = null;

?>