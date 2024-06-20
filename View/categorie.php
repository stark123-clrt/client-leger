<?php 
include 'include/element.php'; 
include 'include/navigation.php'; //bar de navigation présent sur toute les pages
$idcategorie = $_GET["idcategorie"];
$statement = $pdo ->prepare ("SELECT * from categorie where idc = :idcategorie");
//le 'prepare' prepare la requete 
$statement -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
//bindValue donne la valeur :idcategorie au parametre idc 
$statement->execute();   
$result = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_GET["filtre"])){
    $filtre=$_GET["filtre"];
    if($filtre=="croissant"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie order by prix asc');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

    }
    if($filtre=="decroissant"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie order by prix desc');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
    if($filtre=="livraison"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and livraison = 1');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
    if($filtre=="mainPropre"){
        $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and livraison = 0');
        $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
        $statement2 -> execute();
        $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    }
}elseif(isset($_GET["recherche"])){
    $recherche=$_GET["recherche"];
    $statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie and titre like :recherche');
    $statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
    $statement2 -> bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
    $statement2 -> execute();
    $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
}else{
$statement2 = $pdo -> prepare('SELECT * from annonce where categorie = :idcategorie');
$statement2 -> bindValue(':idcategorie', $idcategorie, PDO::PARAM_INT);
$statement2 -> execute();
$result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
}
?> <!-- élément php présent sur tout les pages (vérification si session ouvert, connexion bdd etc...) -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Electro-Annonce</title>
    <?php include 'include/header.php'; ?>
    <style>
        .card {
            transition: box-shadow 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .product-variation {
            margin-top: 10px;
            text-align: center;
        }
        .product-variation span {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .btn-voir-plus {
            display: block;
            width: 100%;
            margin-top: 15px;
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row mt-4">
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body text-center">
                                <h2 class="card-title text-center">Filtrez mes recherches :</h2>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=croissant">Croissant</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=decroissant">Décroissant</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=livraison">Livraison</a>
                                <a class="btn btn-success" href="categorie.php?idcategorie=<?= $result["idc"] ?>&filtre=mainPropre">Main propre</a>
                            </div>
                        </div>
                    </div>

                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($result2 as $ligne) { ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <img src="../<?= $ligne['photo'] ?>" class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title"><?= $ligne["titre"] ?></h5>
                                                    <p class="card-text"><strong><?= number_format($ligne['prix'], 0, ',', ' ') ?> €</strong></p>
                                                    <div class="product-variation">
                                                        <span class="badge badge-pill badge-info"><?= $ligne['etat'] ?> <i class="fa-solid fa-thumbs-up"></i></span>
                                                        <span class="badge badge-pill badge-danger">Format standard <i class="fa-solid fa-pen-nib"></i></span>
                                                        <?php if ($ligne["livraison"] == 1): ?>
                                                            <span class="badge badge-pill badge-success">Livraison <i class="fa-solid fa-truck"></i></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-pill badge-success">Main propre <i class="fa-solid fa-handshake"></i></span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <a href="detail.php?ida=<?= $ligne["ida"] ?>" class="btn btn-success btn-voir-plus">Voir plus</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php'; // on inclus notre footer à chaque bas de page
include 'include/script.php'; 
?> 
</body>
</html>
