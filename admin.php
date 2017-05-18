<?php


session_start();
if (!isset($_SESSION["prijavljen"])){
    header("Location:index.php");
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
                <li class="active"><a href ="admin.php?domaca=da">Domaca stran</a></li>

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
    <?php if(!isset($_GET['domaca'])){?>
    <div class="container">
        <div class="vsebina">
            <div class="row">
                <div class="col-md-6">

                <form method="POST" action="upload.php" enctype="multipart/form-data">
                    <p>Izberite sliko: </p><input type="file" name="fileToUpload" /><br/>

                    </br>
                    </br>
                    <p>vnesi tekst: </p><input type="text" name="text1" placeholder="vnesi nekaj" />

                    </br>
                    </br>

                    <p>vnesi tekst: </p><textarea rows="6" cols="70" placeholder="vnesi nekaj" name="text2"></textarea>
                    <input type="submit" name="upload" value="Vnesi"  />
                    </br>
                    </br>

                </form>

                </div>
                <div class="col-md-6">

                    <?php
                    include "povezava.php";
                    $sql = "SELECT * FROM zapis";

                    $rezultat = $povezava->query($sql);
                    if ($rezultat->num_rows > 0) {
                        echo "<table border='1'>";
                        echo "<tr><td>ID</td><td>Naslov</td><td>Tekst</td><td>Slika</td><td>Izbriši</td></tr>";

                        while($vrsta = $rezultat->fetch_assoc()) {
                            echo "<tr><td>".$vrsta["id"]."</td><td>".$vrsta["naslov"]."</td><td>".$vrsta["tekst"]."</td>";
                            echo "<td><img src='".$vrsta["slika"]."'></td>";
                            echo "<td><form method='POST' action='edit.php'><input type='submit' name='edit' value='uredi' />
                            <input type='hidden' name='id' value='".$vrsta["id"]."'/> </form></td></tr>";

                        }
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php }
    else { ?>
        <div class="container">
            <div class="row">

                <div class="col-md-6">

                    <h2>Slika header</h2>
                    <form method="POST" action="upload.php" enctype="multipart/form-data">

                        <input type="file" name="fileToUpload"  />

                        <h2>socialna omrežja</h2>

                        <input type="text" name="fb" placeholder="Facebook povezava..." /><br>
                        <input type="text" name="twitter" placeholder="twitter povezava..." /><br>
                        <input type="text" name="youtube" placeholder="youtube povezava..." /><br>
                        <input type="submit" name="glava" value="shrani spremembe" />

                    </form>
                    <?php if(isset($_GET["posodobljeno"])) {
                        echo "<strong>Uspešno posodbljeno</strong>";
                    }
                    ?>

                </div>

                <div class="col-md-6">

                </div>

            </div>
        </div>

    <?php } ?>
</div>
<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
