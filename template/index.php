<?php
include('../funkcije.php');
include('header.php');
?>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

            <div class="container">
                <?php
                include "../povezava.php";
                $sql = "SELECT naslov,id,tekst FROM zapis";
                if ($rezultat = $povezava->query($sql)) {
                    if ($rezultat->num_rows > 0) {
                        while($vrsta = $rezultat->fetch_assoc()) { ?>
                            <section class='post-preview'>
                            <a href="post.php?id=<?php echo $vrsta['id']; ?>">
                                <h2 class='post-title'><?php echo $vrsta["naslov"]; ?></h2>
                                <h3 class='post-subtitle'><?php echo substr($vrsta["tekst"], 0, 50) ?>...</h3>
                            </a>
                            </section><?php
                        } ?>
                        </section> <hr><?php
                    }
                    else {
                        echo "<h1>Ni še nobenega članka</h1>";
                    }
                }
                else {
                    echo "NAPAKA PRI POVEZOVANJU NA BAZO";
                }



                ?>
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <?php
    include('footer.php');
    ?>
