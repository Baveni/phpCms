<?php
session_start();
if (!isset($_SESSION["prijavljen"])){
    header("Location:index.php");
}

if (isset($_POST["izbris"])) {
    $id = $_POST["id"];

    include "povezava.php";
    $sql = "DELETE FROM zapis where id ='".$id."'";

    $povezava->query($sql);
}
if (isset($_POST["uredi"])) {
    $id = $_POST["id"];
    $naslov = $_POST["naslov"];
    $text = $_POST["text"];

    include "povezava.php";
    include "upload.php";

    $sql = "UPDATE zapis SET naslov = '".$naslov."', tekst = '".$text."' WHERE id = '".$id."'";

    if($povezava->query($sql)) {
        $urejeno = true;
    } else {
        $urejeno = false;
    }
}





?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stil.css" />
</head>
<body>
<nav class="navbar navbar-default navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Domov <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="admin.php">Administracija</a></li>
                <li class="active"><a href ="edit.php">Urejanje vnosov</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if (isset($_SESSION["prijavljen"]) && $_SESSION["prijavljen"] == true){
                            echo $_SESSION["uporabnik"].'<span class="caret"></span>
	          <ul class="dropdown-menu">
	            <li><a href="logout.php">Odjava</a></li>
	          </ul>';}
                        else
                        {echo "Prijavi se";}
                        ?>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container glavna">
    <div class="container">
        <div class="vsebina">
            <div class="row">
                <div class="col-md-6">

                   <h1>EMPTY</h1>
                    <img src="http://placehold.it/400x500"/>
                </div>
                <div class="col-md-6">

                    <?php

                    if (isset($_POST["edit"])) {
                        $id = $_POST["id"];
                    }
                    include "povezava.php";
                    $sql = "SELECT * FROM zapis WHERE id = '".$id."'";

                    $rezultat = $povezava->query($sql);
                    if ($rezultat->num_rows > 0) {
                        echo "<table border='1'>";
                        echo "<tr><td>ID</td><td>Naslov</td><td>Tekst</td><td>Slika</td><td>Izbriši</td><td>Uredi</td></tr>";

                        while($vrsta = $rezultat->fetch_assoc()) {
                            echo "<form method='POST' action='' enctype=\"multipart/form-data\">
<tr><td>".$vrsta["id"]."</td><td><textarea name='naslov'>".$vrsta["naslov"]."</textarea></td><td><textarea name='text'>".$vrsta["tekst"]."</textarea></td>";
                            echo "<td><img src='".$vrsta["slika"]."'>
                            <input type='file' name='fileToUpload'/></td>";
                            echo "<td><input type='submit' name='izbris' value='izbrisi' />
                            <input type='hidden' name='id' value='".$vrsta["id"]."'/></td><td><input type='submit' name='uredi' value='uredi' /></td></form></tr>";

                        }
                        echo "</table>";
                        if (isset($urejeno)) {
                            if ($urejeno) {
                                echo "<p style='color: darkgreen;'>UREJENO</p>";
                            } else {
                                echo "<h1 style='color: darkred;'>NAPAKA PRI UREJANJU!!</h1>";
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>