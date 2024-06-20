<?php include 'include/element.php'; ?> <!-- élément php présent sur toutes les pages (vérification si session ouverte, connexion bdd etc...) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes annonces - Great Deal</title>
    <?php include 'include/header.php'; ?>  <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
    <style>
        .table-responsive-sm {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        @media (max-width: 576px) {
            .table th, .table td {
                white-space: nowrap;
            }

            .table td img {
                max-width: 100%;
                height: auto;
            }

            .btn {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
            }
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">

    <?php include 'include/navigation.php'; ?> <!-- barre de navigation présente sur toutes les pages -->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h1>Mes annonces</h1>
                                <div class="table-responsive-sm">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Titre</th>
                                                <th>Catégorie</th>
                                                <th>Livraison</th>
                                                <th>Date</th>
                                                <th>Vues</th>
                                                <th>Prix</th>
                                                <th>Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $req = $pdo->prepare('SELECT * FROM annonce WHERE vendeur = ?'); //récupère toutes les annonces de l'utilisateur connecté 
                                            $req->execute(array($uid));
                                            $result = $req->fetchAll();
                                            foreach($result as $row){
                                                $req2 = $pdo->query("SELECT * FROM categorie WHERE idc = ".$row['categorie']);
                                                $ligne2 = $req2->fetch();
                                                ?>
                                                <tr>
                                                    <td><img src='../<?= $row["photo"]?>' width='60'></td>
                                                    <td><?= $row["titre"] ?></td>
                                                    <td><?= $ligne2["nomCat"] ?></td>
                                                    <td>
                                                        <?= $row["livraison"] == 1 ? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>" ?>
                                                    </td>
                                                    <td><?= $row["date"] ?></td>
                                                    <td><?= $row["vue"] ?></td>
                                                    <td><?= $row["prix"] ?>€</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" href="editAnnonce.php?ida=<?= $row["ida"] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href='action_get.php?action=supAnnonce&ida=<?= $row["ida"] ?>' class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'include/footer.php'; ?> <!-- footer présent sur toutes les pages -->
        </div>
    </div>
</div>

<?php include 'include/script.php'; ?> <!-- script présent sur toutes les pages (connexion avec bootstrap) -->

</body>
</html>
