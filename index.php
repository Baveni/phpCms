<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prijava / Registracija</title>
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
                <li class="active"><a href="index.php">Domov <span class="sr-only">(current)</span></a></li>
                <li><a href="admin.php">Administracija</a></li>
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
    <div class="row">
        <?php
        if (isset($_GET["login"]) && $_GET["login"] == "da") {
            echo "<h2>Registracija uspešna prosimo vpišite se spodaj.</h2>";
        }
        if (isset($_SESSION["prijavljen"]) && $_SESSION["prijavljen"] == true) {
            echo "<h2>Pozdravljen ".$_SESSION['uporabnik']."</h2>";
        }
        ?>
        <div class="col-md-6 forma">
            <h2>Vpis</h2>
            <form method="POST" action="loginRegistracija.php">
                <input type="text" name="ime" placeholder="Uporabniško ime:" /><br/>
                <input type="password" name="geslo" placeholder="Geslo:"/><br/>
                <input type="submit" value="Vpisi se" name="vpis" />
            </form>
        </div>
        <div class="col-md-6 forma">
            <h2>Še nimate računa?</h2>
            <form method="POST" action="loginRegistracija.php">
                <input type="text" name="ime" placeholder="Uporabniško ime:" /><br/>
                <input type="password" name="geslo" placeholder="Geslo:"/><br/>
                <input type="password" name="geslo2" placeholder="Ponovi geslo:"/><br/>
                <input type="submit" value="Registriraj se" name="registracija" />
            </form>
            <?php if(isset($_SESSION["failime"]) && $_SESSION["failime"] == true) {
                echo "<strong>To uporabniško ime že obstaja!</strong>";
                $_SESSION["failime"] = false;
            }?>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous">
</script>
<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</body>
</html>