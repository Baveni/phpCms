<?php
include "povezava.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if( isset($_POST["upload"]) || isset($_POST["uredi"]) || isset($_POST["glava"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if(isset($_POST["upload"])) {
    $naslov = $_POST["text1"];
    $tekst = $_POST["text2"];

    $sql = "INSERT INTO zapis(naslov,tekst,slika) VALUES ('".$naslov."','".$tekst."','".$target_file."')";

    if($povezava->query($sql)) {
        header ("Location:admin.php?vneseno=da");
    } else {
        header ("Location:admin.php?napaka=da");
    }
} elseif (isset($_POST["uredi"])) {
    $sql = "UPDATE zapis SET slika = '".$target_file."' WHERE id = '".$id."'";
    $povezava->query($sql);
}

else {
    header ("Location:admin.php?napaka=DA!");
}

if (isset($_POST["glava"])) {
    include "povezava.php";

    if ($_POST["fb"] != '') {
        $fb = $_POST["fb"];
    }
    else {
        $fb = "ne";
    }

    if ($_POST["twitter"] != '') {
        $twitter = $_POST["twitter"];
    }
    else {
        $twitter = "ne";
    }

    if ($_POST["youtube"] != '') {
        $youtube = $_POST["youtube"];
    }
    else {
        $youtube = "ne";
    }
    if ($target_file == "uploads/") {
        $target_file = "uploads/nislike.jpg";
    }
    $sql = "SELECT * FROM domacastran";
    $rezultat = $povezava->query($sql);
    if($rezultat->num_rows > 0) {
        $sql = "UPDATE domacastran SET slika ='".$target_file."',fb ='".$fb."',twitter='".$twitter."',youtube ='".$youtube."'";
    }
    else {
        $sql = "INSERT INTO domacastran (slika,fb,twitter,youtube) VALUES ('".$target_file."','".$fb."','".$twitter."',
    '".$youtube."')";
    }

    if($povezava->query($sql)) {
        header("Location:admin.php?domaca=da&posodobljeno=da");
    }
    else {
        header("Location:admin.php?napaka=da");
    }
}
?>