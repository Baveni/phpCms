<?php
session_start();
if(isset($_POST["registracija"])) {

    $ime = $_POST["ime"];
    $geslo = $_POST["geslo"];
    $geslo2 = $_POST["geslo2"];


    if($geslo == $geslo2) {
        $enkripcija = md5($geslo);

        include 'povezava.php';

        $sql2 = "SELECT uporabnisko_ime FROM login WHERE uporabnisko_ime='".$ime."' ";

        $rezultat = $povezava->query($sql2);

        if($rezultat->num_rows > 0) {
            $_SESSION["failime"] = true;
            header("Location:index.php");
            die();		}

        $sql = "INSERT INTO login(uporabnisko_ime,geslo) VALUES ('".$ime."','".$enkripcija."')";

        if($povezava->query($sql)) {
            echo "Vnešeno!";
            header('Location:index.php?login=da');
        }
        else {
            echo "Napaka pri vnosu:".$povezava->error();
        }
    }
    else {
        header('Location:index.php?napaka=da');
    }
}
else {
    if(!isset($_POST["vpis"]))
        header('Location:index.php');
}

if(isset($_POST["vpis"])) {
    $ime = $_POST["ime"];
    $geslo = $_POST["geslo"];
    $enkripcija = md5($geslo);

    $sql = "SELECT * FROM login WHERE uporabnisko_ime='".$ime."' AND geslo='".$enkripcija."'";

    include 'povezava.php';

    $rezultat = $povezava->query($sql);

    if($rezultat->num_rows > 0) {
        $vrsta = $rezultat->fetch_assoc();
        $_SESSION["prijavljen"] = true;
        $_SESSION["uporabnik"] = $ime;
        header("Location:admin.php");

    }

}else {
    header("Location:index.php");
}

?>