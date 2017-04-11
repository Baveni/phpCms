<?php
/**
 * Created by PhpStorm.
 * User: Jernej
 * Date: 07-Apr-17
 * Time: 18:37
 */
function izpis($ime) {
    include ("povezava.php");

    $sql = "SELECT ".$ime." FROM domacastran";
    $rezultat = $povezava->query($sql);
    $vrsta = $rezultat->fetch_assoc();
    return $vrsta[$ime];
}

?>