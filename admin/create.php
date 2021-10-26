<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$titre = $description = $img = $categorie_id = "";
$titre_err = $description_err = $img_err = $categorie_id_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        // Prepare an insert statement
        $sql = "INSERT INTO video (titre, description, img, categorie_id) VALUES (?, ?, ?, ?)"; // Grace à cette ligne on insérer de manière propre les données 

        /*
            i - integer
            d - double
            s - string
            b - BLOB
        */


        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_titre, $param_description, $param_img, $param_categorie_id);

            // Set parameters
            $param_titre = $titre;
            $param_description = $description;
            $param_img = $img;
            $param_categorie_id = $categorie_id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
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
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>