<?php 
include 'include/element.php'; // élément php présent sur toutes les pages (vérification si session ouvert, connexion bdd etc...)

if (!isset($uid)) {
    header("Location: connexion.php");
    exit();
}

date_default_timezone_set('Europe/Paris');

// Marquer les messages comme lus
if (isset($_GET["idc"])) {
    $idc = $_GET["idc"];
    $stmt = $pdo->prepare("UPDATE message SET lu = 1 WHERE idc = :idc AND idu_r = :uid");
    $stmt->bindValue(':idc', $idc, PDO::PARAM_INT);
    $stmt->bindValue(':uid', $uid, PDO::PARAM_INT);
    $stmt->execute();
}

$req = $pdo->prepare('SELECT * FROM conversation WHERE idu = :uid OR idv = :uid ORDER BY time DESC');
$req->bindValue(':uid', $uid, PDO::PARAM_INT);
$req->execute();
$listConv = $req->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["idc"])) {
    $idc = $_GET["idc"];
    
    $req2 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time ASC');
    $req2->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req2->execute();
    $listMessage = $req2->fetchAll(PDO::FETCH_ASSOC);

    $req3 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time DESC LIMIT 1');
    $req3->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req3->execute();
    $result3 = $req3->fetch();
    $lastMessage = $result3["contenu"];

    $req4 = $pdo->prepare('SELECT * FROM conversation WHERE idc = :idc');
    $req4->bindValue(':idc', $idc, PDO::PARAM_INT);
    $req4->execute();
    $infoConv = $req4->fetch();

    $req5 = $pdo->prepare('SELECT * FROM annonce WHERE ida = :ida');
    $req5->bindValue(':ida', $infoConv["idan"], PDO::PARAM_INT);
    $req5->execute();
    $infoAnnonce = $req5->fetch();

    if ($result3["idu_r"] == $uid) {
        $idCorrespondant = $result3["idu_q"];
    } else {
        $idCorrespondant = $result3["idu_r"];
    }
    $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
    $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
    $req6->execute();
    $infoCorrespondant = $req6->fetch();
}

if (isset($_POST["bout_mess"])) {
    if (isset($_GET["idc"])) {
        $idc = $_GET["idc"];
        $message = $_POST["message"];
        $time = date('U');
        $req = $pdo->prepare("INSERT INTO message VALUES(null, :idu_q, :idu_r, :idc, :message, :time, 0)"); // Assurez-vous que la colonne 'lu' a une valeur par défaut de 0
        $req->execute([
            ':idu_q' => $uid,
            ':idu_r' => $infoCorrespondant["idu"],
            ':idc' => $idc,
            ':message' => $message,
            ':time' => $time,
        ]);
        header("Location: message.php?idc=$idc");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Message Electro-Annonce</title>
    <?php include 'include/header.php'; ?>  <!-- header présent sur toutes les pages (connexion avec bootstrap) -->
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">
    <?php include 'include/navigation.php'; ?> <!-- barre de navigation présente sur toutes les pages -->
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary py-3 mb-4 text-center d-md-none aside-toggler">
                            <i class="mdi mdi-menu mr-0 icon-md"></i>
                        </button>
                        <div class="card chat-app-wrapper">
                            <div class="row mx-0">
                                <div class="col-lg-3 col-md-4 chat-list-wrapper px-0">
                                    <div class="chat-list-item-wrapper">
                                        <?php foreach($listConv as $conv): ?>
                                            <?php
                                            $req3 = $pdo->prepare('SELECT * FROM message WHERE idc = :idc ORDER BY time DESC LIMIT 1');
                                            $req3->bindValue(':idc', $conv["idc"], PDO::PARAM_INT);
                                            $req3->execute();
                                            $result3 = $req3->fetch(PDO::FETCH_ASSOC);
                                            $lastMessage = $result3["contenu"];
                                            $idCorrespondant = $result3["idu_r"] == $uid ? $result3["idu_q"] : $result3["idu_r"];
                                            $req6 = $pdo->prepare('SELECT * FROM user WHERE idu = :idu');
                                            $req6->bindValue(':idu', $idCorrespondant, PDO::PARAM_INT);
                                            $req6->execute();
                                            $infoCorresConv = $req6->fetch();
                                            ?>
                                            <a style="outline: none; text-decoration: none;" href="message.php?idc=<?=$conv["idc"]?>">
                                                <div class="list-item">
                                                    <div class="profile-image">
                                                        <img class="img-sm rounded-circle" src="../<?= $infoCorresConv["avatar"] ? $infoCorresConv["avatar"] : "image/avatarbasique.png" ?>" alt="">
                                                    </div>
                                                    <p class="user-name"><?= $infoCorresConv["prenom"] . " " . $infoCorresConv["nom"] ?></p>
                                                    <p class="chat-time">
                                                        <?php
                                                        $timeConv = date('U') - $result3["time"];
                                                        if($timeConv < 3600){
                                                            echo "il y a ".date("i", $timeConv)." minutes";
                                                        }elseif($timeConv < 86400){
                                                            echo "il y a ".date("H", $timeConv)." heures";
                                                        }else{
                                                            echo "il y a ".date("d", $timeConv)." jours";
                                                        }
                                                        ?>
                                                    </p>
                                                    <p class="chat-text"><?= $lastMessage ?></p>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-8 px-0 d-flex flex-column">
                                    <div class="chat-container-wrapper" style="height: 350px">
                                        <?php if(isset($_GET["idc"])): ?>
                                            <?php foreach($listMessage as $mess): ?>
                                                <div class="chat-bubble <?= $mess["idu_q"] == $idCorrespondant ? 'incoming-chat' : 'outgoing-chat' ?>">
                                                    <div class="chat-message" <?= $mess["idu_q"] == $uid ? 'style="background-color: #DCDD54"' : '' ?>>
                                                        <p class="font-weight-bold"><?= $mess["idu_q"] == $uid ? $infoUser["prenom"] . " " . $infoUser["nom"] : $infoCorrespondant["prenom"] . " " . $infoCorrespondant["nom"] ?></p>
                                                        <p><?= $mess["contenu"] ?></p>
                                                    </div>
                                                    <div class="sender-details">
                                                        <img class="sender-avatar img-xs rounded-circle" src="../<?= $mess["idu_q"] == $uid ? ($infoUser["avatar"] ? $infoUser["avatar"] : "image/avatarbasique.png") : ($infoCorrespondant["avatar"] ? $infoCorrespondant["avatar"] : "image/avatarbasique.png") ?>" alt="profile image">
                                                        <p class="seen-text">Message envoyé : <?php
                                                            $timeMess = date('U') - $mess["time"];
                                                            if($timeMess < 3600){
                                                                echo "il y a ".date("i", $timeMess)." minutes";
                                                            }elseif($timeMess < 86400){
                                                                echo "il y a ".date("H", $timeMess)." heures";
                                                            }else{
                                                                echo "il y a ".date("d", $timeMess)." jours";
                                                            }
                                                            ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="chat-text-field mt-auto">
                                        <form action="" method="post">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="message" placeholder="Entrer votre message">
                                                <div class="input-group-append">
                                                    <input class="btn btn-success" type="submit" name="bout_mess" value="Envoyer">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php if(isset($_GET["idc"])): ?>
                                <div class="col-lg-3 d-none d-lg-block px-0 chat-sidebar">
                                    <img class="img-fluid w-100" src="../<?= $infoAnnonce["photo"] ?>" alt="profile image">
                                    <div class="px-4">
                                        <div class="d-flex pt-4">
                                            <div class="wrapper">
                                                <h5 class="font-weight-medium mb-0 ellipsis"><?= $infoAnnonce["titre"] ?></h5>
                                            </div>
                                            <div class="badge badge-gradient-success mb-auto ms-auto"><?= $infoAnnonce["prix"] ?> €</div>
                                        </div>
                                        <div class="pt-3">
                                            <div class="d-flex align-items-center py-1">
                                                <p class="mb-0 font-weight-medium"><?= $infoAnnonce["detail"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
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
