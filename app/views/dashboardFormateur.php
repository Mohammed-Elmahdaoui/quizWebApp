<?php

namespace app\views;

use app\modules\Module;
use app\modules\Assurer;
use app\modules\Competence;
use app\modules\Formateur;

session_start();

$user = unserialize($_SESSION['user']);
$filieres = [];
$modules = [];
$competences = [];
$examens = [];

$idFiliere = null;
$idModule = null;
$idCompetence = null;

echo "<pre>";
var_dump($user);
echo "</pre>";

$filieres = $user->getFilieres();

if (isset($_POST["filiere"], $_POST["module"], $_POST["competence"])) {
    if (!empty($_POST["filiere"])) {
        $idFiliere = $_POST["filiere"]; // filiere id
        $_SESSION['filiere'] = $idFiliere;

        $modules = Assurer::getModules($user->getId(), $idFiliere);

        if (!empty($_POST["module"])) {
            $idModule = $_POST["module"];
            $_SESSION['module'] = $idModule;

            $competences = Module::getCompetences($idModule);

            if (!empty($_POST["competence"])) {
                $idCompetence = $_POST["competence"];
                $_SESSION['competence'] = $idCompetence;

                $examens = Competence::getExamens($idCompetence);
            }
        }
    }
}

function optionSelected($choix, $currentId)
{
    return (isset($_SESSION[$choix]) && $_SESSION[$choix] == $currentId) ? "selected" : "";
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
</head>

<body>

    <!-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"> -->
    <header>
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary p-0 shadow">
            <div class="container-fluid">

                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                    <div>
                        <h1 class="text-light h4 ms-2">QuizApp</h1>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-secondary bg-transparent border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Paramètres</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>

                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown d-flex">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        
                    </ul> -->

                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky p-1 pt-3 ">
                    <form action="" method="POST">

                        <!-- select filiere -->
                        <label class="form-label mb-0 ms-1" for="filiere">Filiere:</label>
                        <select class="form-select form-select-sm mb-2" name="filiere" onchange="submit()" id="filiere">
                            <?php if ($idFiliere == null) : ?>
                                <option value="" selected>Select filiere</option>
                            <?php else : ?>
                                <?php foreach ($filieres as $filiere) : ?>
                                    <option value="<?= $filiere->idFiliere ?>" <?php if ($idFiliere == $filiere->idFiliere) {echo "selected";} ?>><?= $filiere->label ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>


                        <!-- select module -->
                        <label class="form-label mb-0 ms-1" for="filiere">Module:</label>
                        <select class="form-select form-select-sm mb-2" name="module" onchange="submit()" id="module">
                            <?php if ($idModule == null) : ?>
                                <option value="" selected>Select module</option>
                            <?php else : ?>
                                <?php foreach ($modules as $module) : ?>
                                    <option value="<?= $module->idModule ?>" <?php if ($idModule == $module->idModule) {echo "selected";} ?>><?= $module->label ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>


                        <!-- select competence -->
                        <label class="form-label mb-0 ms-1" for="filiere">Competence:</label>
                        <select class="form-select form-select-sm mb-2" name="competence" onchange="submit()" id="competence">
                            <?php if ($idCompetence == null) : ?>
                                <option value="" selected>Select competence</option>
                            <?php else : ?>
                                <?php foreach ($competences as $competence) : ?>
                                    <option value="<?= $competence->idCompetence ?>" <?php if ($idCompetence == $competence->idCompetence) {echo "selected";} ?>><?= $competence->label ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </form>
                </div>

            </nav>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Examens:</h1>
                <button type="button" onclick="ajouterExamen()" class="btn btn-sm btn-outline-success me-2">Ajouter</button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th class="col">id</th>
                            <th class="col flex-fill">label</th>
                            <th class="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($examens as $examen) : ?>
                            <tr>
                                <td><?= $examen->idExamen ?></td>
                                <td><?= $examen->label ?></td>
                                <td>
                                    <button type="button" onclick="modifierExamen()" class="btn btn-sm btn-outline-primary me-2">Modifier</button>
                                    <button type="button" onclick="supprimerExamen()" class="btn btn-sm btn-outline-danger me-2">Supprimer</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>



    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script>
        function ajouterExamen() {
            window.location.href = "./ajouterExamen.php";
        }

        // function modifierExamen() {
        //     var redirect = './gererExamen.php';
        //     $.redirectPost(redirect, {
        //         x: 'example',
        //         y: 'abc'
        //     });
        //     // jquery extend function
        //     $.extend(
        //     {
        //         redirectPost: function(location, args)
        //         {
        //             var form = '';
        //             $.each( args, function( key, value ) {
        //                 value = value.split('"').join('\"')
        //                 form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        //             });
        //             $('<form action="' + location + '" method="POST">' + form + '</form>').appendTo($(document.body)).submit();
        //         }
        //     });
        // }

        function supprimerExamen() {

        }
    </script>

</body>

</html>