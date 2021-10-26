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
                            <a class="nav-link" href="films.php">Films</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="series.php">Séries</a>
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
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/series.jpg" class="d-block w-100 img-carousel-effect" alt="...">

                </div>
            </div>


            <!--  Début du corps de la page
    ================================================== -->
            <!-- tout les sections proposé. -->

            <!--==========================
                    // ! Bloc du menu
                ==========================-->

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



                <!-- FOOTER -->
                <footer class="container">
                </footer>
    </main>



</body>

</html>