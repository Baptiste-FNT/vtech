<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VTech</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Mes styles -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!--==========================
            // ! Bloc de la navbar
        ==========================-->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">VTech</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="films.php">Films</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="series.php">Séries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="animes.php">Animes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Fin de la barre de navigation -->
    <main class="w-100 p-3">
        <div id="carouselExampleCaptions" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/films.jpg" class="d-block w-100 img-carousel-effect" alt="...">
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h5>top film</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img src="assets/img/series.jpg" class="d-block w-100 image_carousel" alt="...">
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img src="assets/img/anime.jpg" class="d-block w-100 image_carousel" alt="...">
                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div> -->
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!--  Début du corps de la page
    ================================================== -->
        <!-- tout les sections proposé. -->

        <!-- Les films et séries -->
        <section class="divertissement mt-5 m-5 p-25">
            <!-- Les tendances -->
            <p class="categorie_titre">Tendances</p>
            <section class="section_video tendances mb-5">
                <!-- overflow-scroll -->
                <div class="list d-flex mx-auto">

                    <?php
                    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
                    include('admin/config.php');
                    /* $conn = mysqli_connect("localhost", "cosmoslight", "bJ!7!2bO2x0&", "vtech"); */
                    // Check connection
                    /*  if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        } */
                    // Attempt select query execution
                    $sql = "SELECT * FROM video";
                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo " <a href=\"contenue.php?id=" . $row['id'] . "\"><img class=\"img-tendance\" src=\"" . $row['img'] . "\" alt=\"\"></a>";
                            }
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo "No records matching your query were found.";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>

                </div>
            </section>
            <!--==========================
                    // ! Bloc du menu
                ==========================-->
            <!-- 
                    // !  Fin des tendances 
                -->

            <section class="divertissement-films p-25">
                <!-- Les tendances -->
                <h2 class="categorie_titre">Films</h2>
                <section class="section_video tendances-films mb-5">

                    <div class="list  d-flex mx-auto">

                        <?php
                        /* Attempt MySQL server connection. Assuming you are running MySQL
                            server with default setting (user 'root' with no password) */
                        include('admin/config.php');
                        /* $link = mysqli_connect("localhost", "cosmoslight", "bJ!7!2bO2x0&", "vtech"); */
                        // Check connection
                        /*  if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        } */

                        // Attempt select query execution
                        $sql = "SELECT * FROM video WHERE categorie_id = 1";
                        if ($result = mysqli_query($conn, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<a href=\"contenue.php?id=" . $row['id'] . "\"><img class=\"img-tendance\" src=\"" . $row['img'] . "\" alt=\"\"></a>";
                                }
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else {
                                echo "No records matching your query were found.";
                            }
                        } else {
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                        }

                        // Close connection
                        mysqli_close($conn);
                        ?>

                    </div>
                </section>

                <!-- 
                    // ! fin section films 
                -->

                <section class="divertissement-série p-25">
                    <!-- Les tendances -->
                    <h2 class="categorie_titre">Série</h2>
                    <section class="section_video tendances-série mb-5">

                        <div class="list d-flex mx-auto">

                            <?php
                            /* Attempt MySQL server connection. Assuming you are running MySQL
                            server with default setting (user 'root' with no password) */
                            include('admin/config.php');
                            /* $link = mysqli_connect("localhost", "cosmoslight", "bJ!7!2bO2x0&", "vtech"); */
                            // Check connection
                            /*  if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        } */

                            // Attempt select query execution
                            $sql = "SELECT * FROM video WHERE categorie_id = 2";
                            if ($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo " <a href=\"contenue.php?id=" . $row['id'] . "\"><img class=\"img-tendance\" src=\"" . $row['img'] . "\" alt=\"\"></a>";
                                    }
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else {
                                    echo "No records matching your query were found.";
                                }
                            } else {
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                            }

                            // Close connection
                            mysqli_close($conn);
                            ?>

                        </div>
                    </section>

                    <!-- 
                    // ! fin section série 
                -->

                    <section class="divertissement-anime p-25">
                        <!-- Les tendances -->
                        <h2 class="categorie_titre">Anime</h2>
                        <section class="section_video tendances-anime mb-5">

                            <div class="list d-flex mx-auto">

                                <?php
                                /* Attempt MySQL server connection. Assuming you are running MySQL
                            server with default setting (user 'root' with no password) */
                                include('admin/config.php');
                                /* $link = mysqli_connect("localhost", "cosmoslight", "bJ!7!2bO2x0&", "vtech"); */
                                // Check connection
                                /*  if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        } */

                                // Attempt select query execution
                                $sql = "SELECT * FROM video WHERE categorie_id = 3";
                                if ($result = mysqli_query($conn, $sql)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo " <a href=\"contenue.php?id=" . $row['id'] . "\"><img class=\"img-tendance\" src=\"" . $row['img'] . "\" alt=\"\"></a>";
                                        }
                                        echo "</table>";
                                        // Free result set
                                        mysqli_free_result($result);
                                    } else {
                                        echo "No records matching your query were found.";
                                    }
                                } else {
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                                }

                                // Close connection
                                mysqli_close($conn);
                                ?>

                            </div>
                        </section>

                        <!-- 
                    // ! fin section anime 
                -->

                        <!-- FOOTER -->
                        <footer class="container">
                        </footer>
    </main>



</body>

</html>