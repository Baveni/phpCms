<?php
include "povezava.php";
session_start();
if(isset($_POST["besedilo1"])) {
    $naslov = $_POST["text1"];
    $tekst = $_POST["text2"];



    $sql = "INSERT INTO zapis(naslov,tekst) VALUES ('".$naslov."','".$tekst."')";


    if($povezava->query($sql)) {
        echo "Vnešeno!";
        header ("Location:admin.php?vnos uspel=da");
    } else {
        echo "Ni uspelo!";
        //header ("Location:admin.php?napaka=da");
    }
} else {
    echo "Napaka!";
    header ("Location:admin.php?napaka=da");
}
?>