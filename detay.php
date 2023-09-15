
<?php


$makaleId = $_GET["id"];
//echo $makaleId;

if($makaleId==1){
    header("Location:https://www.kampustenevar.com/kategori-spor");
    exit();
}elseif($makaleId==2){
    header("Location:https://www.kampustenevar.com/kategori-kultur-ve-sanat");
    exit();
}elseif($makaleId==3){
    header("Location:https://www.kampustenevar.com/kategori-muzik");
    exit();
}

?>

