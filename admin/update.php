<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$titre = $description = $img = $categorie_id = "";
$titre_err = $description_err = $img_err = $categorie_id_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate titre
    $input_titre = trim($_POST["titre"]);
    if (empty($input_titre)) {
        $titre_err = "Please enter a titre.";
    } else {
        $titre = $input_titre;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter an description.";
    } else {
        $description = $input_description;
    }

    // Validate img
    $input_img = trim($_POST["img"]);
    if (empty($input_img)) {
        $img_err = "Please enter the img.";
    } else {
        $img = $input_img;
    }

    // Validate categorie_id
    $input_categorie_id = trim($_POST["categorie_id"]);
    if (empty($input_categorie_id)) {
        $categorie_id_err = "Please enter the categorie_id.";
    } else {
        $categorie_id = $input_categorie_id;
    }

    // Check input errors before inserting in database
    if (empty($titre_err) && empty($description_err) && empty($img_err) && empty($categorie_id_err)) {
        // Prepare an update statement
        $sql = "UPDATE video SET titre=?, description=?, img=?, categorie_id=? WHERE id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssii", $param_titre, $param_description, $param_img, $param_categorie_id, $param_id);

            // Set parameters
            $param_titre = $titre;
            $param_description = $description;
            $param_img = $img;
            $param_categorie_id = $categorie_id;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM video WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

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
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>titre</label>
                            <input type="text" name="titre" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $titre; ?>">
                            <span class="invalid-feedback"><?php echo $titre_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>img</label>
                            <input type="text" name="img" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $img; ?>">
                            <span class="invalid-feedback"><?php echo $img_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>categorie ( 1 = film / 2 = série / 3 = anime )</label>
                            <input type="text" name="categorie_id" class="form-control <?php echo (!empty($categorie_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $categorie_id; ?>">
                            <span class="invalid-feedback"><?php echo $categorie_id_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>