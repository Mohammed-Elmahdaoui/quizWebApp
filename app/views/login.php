<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <style>
        body{
            background: #F5F5F5;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center text-center" style="height: 100vh">


    <form action="../routers/loginRouter.php" method="POST">
        <legend class="h1 mb-5 fw-normal ">Please login</legend>

        <!-- error message if user/password not valid -->
        <?php
        if (isset($_GET['error']) && $_GET['error'] == true) {
            echo '
        <div class="alert alert-danger" role="alert">
            Erreur: user ou password incorrect
        </div>
        ';
        }
        ?>

        <!-- user input -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <span class="input-group-text" id="username">@ofppt-edu.ma</span>
        </div>

        <!-- password input -->
        <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <!-- check if formateur or stagiaire  -->
        <div class="text-start m-3 ps-5 fs-5">
            <!-- case formateur -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="formateur" value="formateur" checked>
                <label class="form-check-label" for="formateur">
                    Formateur
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="stagiaire" value="stagiaire">
                <label class="form-check-label" for="stagiaire">
                    Stagiaire
                </label>
            </div>
        </div>

        <!-- submit button -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary rounded-2 bg-opacity-75">Login</button>
        </div>
    </form>

</body>

</html>