<?php

function izpis($ime) {
    include ("povezava.php");

    $sql = "SELECT ".$ime." FROM domacastran";
    $rezultat = $povezava->query($sql);
    $vrsta = $rezultat->fetch_assoc();
    return $vrsta[$ime];
}

?>
