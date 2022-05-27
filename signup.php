<?php
session_start();
ob_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shopee</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container my-5">
    <h1 class="text-center text-info">Inscription</h1>

    <?php

function checkIfExists($select, $from, $value)
{
    global $db;
    $statement = $db->prepare(("SELECT $select FROM $from WHERE $select = ?"));
    $statement->execute(array($value));

    $check = $statement->rowCount();
    return $check;
}

    if (isset($_SESSION['admin'])) {
        header('location: dashbord.php');
        exit();
    } elseif (isset($_SESSION['user'])) {
        header('location: accueil.php');
        exit();
    } else {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            if (checkIfExists("user_username", "user", $username) > 0) {
                echo '<div class="container">
            <div class="alert alert-danger alert-dismissible m-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Danger!</strong> Nom d\'utilisateur deja kayn</div>
            </div>';
            } else {
                if ($password == $confirmpassword) {
                    $stmt = $db->prepare("INSERT INTO user ( user_username, user_password) VALUES (?, ?)");
                    $stmt->execute(array($username, $password));
                    $count = $stmt->rowCount();
                    if ($count > 0) {
                        echo '<div class="container"><div class="alert alert-success alert-dismissible m-0">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Vous avez enregistré avec succès</div></div>';
                    }
                } else {
                    echo '<div class="container"><div class="alert alert-danger alert-dismissible m-0">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Danger!</strong> Confirmer votre mot de passe</div></div>';
                }
            }
        }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="username" class="mr-sm-2">Nom D'Utilisateur</label>
        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter email" name="username" required autocomplete="off">
        <label for="password" class="mr-sm-2">Mot De Passe:</label>
        <input type="password" class="form-control mb-2 mr-sm-2" placeholder="Enter password" name="password" required autocomplete="off">
        <label for="password" class="mr-sm-2">Confirmer Mot De Passe:</label>
        <input type="password" class="form-control mb-2 mr-sm-2" placeholder="Enter password" name="confirmpassword" required autocomplete="off">
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Owl Carousel Js file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <!--  isotope plugin cdn  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

    <!-- Custom Javascript -->
    <script src="index.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>