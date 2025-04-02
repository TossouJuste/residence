<!doctype html>
<html lang="fr" dir="ltr">
	
<!-- Mirrored from laravel.spruko.com/zanex/ltr/datatable by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Feb 2025 06:56:39 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Laravel Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, admin dashboard template, bootstrap 5, dashboard, laravel, laravel admin, laravel admin panel, laravel admin template, laravel blade, laravel dashboard, laravel dashboard template, laravel mvc, laravel php, laravel ui template, ui kit">
<!-- Font Awesome (dernière version) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- TITLE -->
        <title>Zanex – Laravel Admin & Dashboard Template </title>

        <!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico" />

		<!-- BOOTSTRAP CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="assets/css/style.css" rel="stylesheet"/>
		<link href="assets/css/dark-style.css" rel="stylesheet"/>
		<link href="assets/css/skin-modes.css" rel="stylesheet" />

		<!-- SIDE-MENU CSS -->
		<link href="assets/css/sidemenu.css" rel="stylesheet" id="sidemenu-theme">
		
		<!--C3 CHARTS CSS -->
		<link href="assets/plugins/charts-c3/c3-chart.css" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="assets/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="assets/plugins/icons/icons.css" rel="stylesheet"/>

		<!-- SIDEBAR CSS -->
		<link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet"/>

		
        <!-- SELECT2 CSS -->
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet"/>

        <!-- DATA TABLE CSS -->
        <link href="assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
        <link href="assets/plugins/datatable/css/buttons.bootstrap5.min.css"  rel="stylesheet">
        <link href="assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

        <!-- INTERNAL SELECT2 CSS -->
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet"/>


		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="assets/colors/color1.css"/>

		<!-- INTERNAL Switcher css -->
		<link href="assets/switcher/css/switcher.css" rel="stylesheet"/>
		<link href="assets/switcher/demo.css" rel="stylesheet"/>
	</head>

<body class="app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- navbar -->
            <?php include('nav.php'); ?>

            <!-- header -->
            <?php include('header.php'); ?>

            <!-- app-content open -->
            <div class="app-content">
                <div class="side-app">

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <div>
                            <h1 class="page-title">Data Table</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                            </ol>
                        </div>
                        <div class="ms-auto pageheader-btn">
                            <a href="#" class="btn btn-primary btn-icon text-white me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <span>
                                    <i class="fe fe-plus"></i>
                                </span> Ajouter un utilisateur
                            </a>
                        </div>
                    </div>

                    <!-- Row -->
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">File Export</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive export-table">
                                        <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom w-100">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-warning me-2" title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" title="Supprimer">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->

                </div>
            </div>
            <!-- CONTAINER END -->
        </div>

        <!-- MODAL POUR AJOUTER UN UTILISATEUR -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Ajouter un Utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="ajouter_utilisateur.php" method="POST">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="" disabled selected>-- Sélectionner un rôle --</option>
                                    <option value="admin">Admin</option>
                                    <option value="editeur">Éditeur</option>
                                    <option value="utilisateur">Utilisateur</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include("footer.php"); ?>

    </div>

    <?php include("js.php"); ?>

</body>
</html>
