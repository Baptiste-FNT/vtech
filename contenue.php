
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contenue</title>
    <!--Boostrap Links & Scripts-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css"> <!-- icons boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--=========================-->
    <!-- Mes styles -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
require_once "admin/config.php";
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Prepare a select statement
    $sql = "SELECT * FROM video WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        // Set parameters
        $param_id = trim($_GET["id"]);
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // Retrieve individual field value
                $titre = $row["titre"];
                $description = $row["description"];
                $img = $row["img"];
                $categorie_id = $row["categorie_id"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: admin/error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection
    mysqli_close($conn);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: admin/error.php");
    exit();
}
?>
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

    <!--==========================
            // ! Bloc Bannière
        ==========================-->
    <div class="banner">
        <img src="<?php require_once "admin/config.php";
                    echo $row["img"]; ?>" class="d-block w-100" alt="...">
    </div>


    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3 text-white"><p><b><?php echo $row["titre"]; ?></b></p></h1>
                    
                    <div class="form-group">
                    <h2><label class="text-white">description</label></h2>
                        <p><b class="text-white"><?php echo $row["description"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>