<?php
if(isset($_GET["idcategorie"])){
    if($_GET["idcategorie"] == 1){
        $telephone = "active";
    }else{
        $telephone = null;
    }
    if($_GET["idcategorie"] == 2){
        $ordinateur = "active";
    }else{
        $ordinateur = null;
    }
    if($_GET["idcategorie"] == 3){
        $ordinateurbureau = "active";
    }else{
        $ordinateurbureau = null;
    }
    if($_GET["idcategorie"] == 4){
        $tablette = "active";
    }else{
        $tablette = null;
    }
    if($_GET["idcategorie"] == 5){
        $accessoire = "active";
    }else{
        $accessoire = null;
    }
}else{
    $telephone = null;
    $ordinateur = null;
    $ordinateurbureau = null;
    $tablette = null;
    $accessoire = null;
}
// if(isset($_POST["search"])){
//     $search = $_POST["search"];
//     $statement = $pdo -> prepare("SELECT * from annonce where titre like :search");
//     $statement -> bindValue(':search', "%$search%", PDO::PARAM_STR);
//     $statement -> execute();
//     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//     $_SESSION["search"] = $result;
//     header("Location: recherche.php");
// }

?>

<div class="horizontal-menu">


<?php
include 'include/element.php';

if (isset($uid)) {
    $nbAnnonces = $pdo->query("SELECT COUNT(*) FROM annonce WHERE vendeur = $uid")->fetchColumn();
    $nbFavoris = $pdo->query("SELECT COUNT(*) FROM favoris WHERE idu = $uid")->fetchColumn();
    $nbMessagesNonLus = $pdo->query("SELECT COUNT(*) FROM message WHERE idu_r = $uid AND lu = 0")->fetchColumn();
} else {
    $nbAnnonces = 0;
    $nbFavoris = 0;
    $nbMessagesNonLus = 0;
}
?>

<nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="navbar-brand-wrapper d-flex align-items-center">
            <a class="navbar-brand brand-logo" href="index.php"><img style="height: 30px; width: 60px" src="../image/logo2.png" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.php"><img style="height: 30px; width: 60px" src="../image/logo.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav d-flex align-items-center">
                <li class="nav-item d-none d-lg-block">
                    <a class="btn btn-success btn-sm mx-2" href="<?php if(isset($uid)): ?>nvAnnonces.php <?php else: ?> connexion.php <?php endif; ?>" style="font-size: 12px;">
                        <i class="fa-regular fa-square-plus"></i><span class="menu-title"> Nouvelle Annonce</span>
                    </a>
                </li>
                <li class="nav-item nav-search d-none d-lg-block mx-2">
                  <!--  <div class="input-group input-group-sm">
                        <form action="" method="post" class="d-flex">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search" style="font-size: 12px;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" name="search" placeholder="Chercher une annonce" aria-label="search" aria-describedby="search" style="font-size: 12px;">
                        </form>
                    </div> -->
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?php if(isset($uid)): ?>mesAnnonces.php <?php else: ?>connexion.php <?php endif; ?>" style="font-size: 12px;">
                        <i class="fa-solid fa-list" style="font-size: 16px;"></i><span class="d-none d-lg-inline"> Mes annonces (<?= $nbAnnonces ?>)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark position-relative" href="<?php if(isset($uid)): ?>favoris.php <?php else: ?>connexion.php <?php endif; ?>" style="font-size: 12px;">
                        <i class="fa-regular fa-heart" style="font-size: 16px;"></i><span class="d-none d-lg-inline"> Favoris</span>
                        <?php if($nbFavoris > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= $nbFavoris ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark position-relative" href="<?php if(isset($uid)): ?>message.php <?php else: ?>connexion.php <?php endif; ?>" style="font-size: 12px;">
                        <i class="fa-regular fa-comments" style="font-size: 16px;"></i><span class="d-none d-lg-inline"> Messages</span>
                        <?php if($nbMessagesNonLus > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= $nbMessagesNonLus ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php if(isset($uid)): ?>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                            <div class="nav-profile-img">
                                <img src="<?php if($infoUser["avatar"] == null){ echo "../image/avatarbasique.png";}else{ ?>../<?= $infoUser["avatar"] ?><?php } ?>" alt="image" style="height: 20px; width: 20px;">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="text-black mb-0" style="font-size: 12px;"><?= $infoUser["prenom"] ?> <?= $infoUser["nom"] ?></p>
                            </div>
                            <i class="fa-solid fa-chevron-down mx-1" style="font-size: 12px;"></i>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="profil.php">
                                <i class="fa-solid fa-user"></i> Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="deconnexion.php">
                                <i class="fa-solid fa-right-from-bracket"></i> Déconnexion </a>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="connexion.php" style="font-size: 12px;">
                            <i class="fa-regular fa-user" style="font-size: 16px;"></i><span class="d-none d-lg-inline"> Connexion</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center mx-2" type="button" data-toggle="horizontal-menu-toggle">
                <i class="fa-solid fa-bars text-dark"></i>
            </button>
        </div>
    </div>
</nav>


    <nav class="bottom-navbar bg-success">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item <?= $telephone ?>">
                    <a class="nav-link" href="categorie.php?idcategorie=1">
                    <i class="fa-solid fa-mobile-alt mx-2"></i>

                        <span class="menu-title">Téléphones mobiles</span>
                    </a>
                </li>
                <li class="nav-item <?= $ordinateur ?>">
                    <a class="nav-link" href="categorie.php?idcategorie=2">
                    <i class="fa-solid fa-laptop mx-2"></i>

                        <span class="menu-title">Ordinateurs portables</span>
                    </a>
                </li>
                <li class="nav-item <?= $sciencefiction ?>">
                    <a class="nav-link" href="categorie.php?idcategorie=3">
                    <i class="fa-solid fa-desktop mx-2"></i>

                        <span class="menu-title">Ordinateurs de bureau</span>
                    </a>
                </li>
                <li class="nav-item <?= $developpementpersonnel ?>">
                    <a class="nav-link" href="categorie.php?idcategorie=4">
                    <i class="fa-solid fa-tablet mx-2"></i>

                        <span class="menu-title">Tablettes</span>
                    </a>
                </li>
                <li class="nav-item <?= $accessoire ?>">
                    <a class="nav-link" href="categorie.php?idcategorie=5">
                    <i class="fa-solid fa-plug mx-2"></i>

                        <span class="menu-title">Accessoires électroniques</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>