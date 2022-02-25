<?php require_once('inc/header.inc.php'); 

//je vérifie que je reçois dns L URL (avc $_GET) 1 valeur (avc isset), qu elle est de type numérique (avc ctype_digit) et qu elle ne soit ps inf à 1 (la valeur minimal pr 1 id auto-incrémenté)
if (!isset($_GET['id']) || !ctype_digit($_GET['id']) || $_GET['id'] < 1) {
    
    //si ce n est pas le cas, j empeche d acceder a la page show avc 1 mauvaise valeur en renvoyant vers la page list.php
    header('location:list.php'); //header pr la redirection et location renvoie vers la page list.php
}

if ($_POST) {
    //je verif le contenu du champs reservation_msg 
    //qu il existe et qu il n a pas reçu moins de 3 caracteres et pls de 200 sinn je génère 1 msg d erreur
    if(!isset($_POST['reservation_message']) || iconv_strlen($_POST['reservation_message']) < 3 || iconv_strlen($_POST['reservation_message'])> 200) {
        $erreur .= '<div class="alert alert-danger"role="alert">Erreur format message !</div>'; 
    }

    
    if (empty($erreur)) {
        //j utilisie mn objet $pdo pr interagir avc la BDD
        //je fais 1 requete préparé pr sécuriser l envoie ds données
        $ajoutMessage = $pdo->prepare("UPDATE advert SET id = :id, reservation_message = :reservation_message WHERE id = :id");
        $ajoutMessage->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $ajoutMessage->bindValue(':reservation_message', $_POST['reservation_message'], PDO::PARAM_STR);
        $ajoutMessage->execute();
    }
}

//on select tte ls infos du advert avc l objet $pdo. je le fais avc 1 requete de type query.
$afficheInformations = $pdo->query("SELECT * FROM advert WHERE id = $_GET[id]"); 
$information = $afficheInformations->fetch(PDO::FETCH_ASSOC);
//fetch = search tte ls infos en BDD

//je calcul le délai entre le jour ou l user voit l annonce et le day ou elle a été publiée
$date_debut = strtotime($information['created_at']);
$date_fin = time();
//je vais dnc soustraire la valeur de date_fin à date_début, puis convertir ce résultat exrimé en seconde et en jours.
$delai = round(($date_fin - $date_debut) / 86400); 
?>

<!-- je met entre crochet l indice du tableau 'title' dont j'ai besoin pr avoir 1 h1 dynamique. le titre généré sera diff selon la voiture sur laquelle on aura cliqué -->
<h1 class="text-center text-primary my-5">Appartement <?=$information['title']?> en <?= $information['type'] ?></h1>

<?php $erreur ?>

<a href="list.php"><button class="btn btn-outline-primary">Retour à la liste des biens</button></a>
<hr>
<div class="card col-md-6 my-5 border border-warning text-center">
    <div class="card-header">
    L'appartement' <?= $information['title'] ?> est disponible à <?= $information['city'] ?> (code postal: <?= $information['code_postal'] ?> )
    </div>
    <div class="card-body">
        <h5 class="card-title">Cet appartement est proposé à la <?= $information['type'] ?>  au prix de
         <!-- je fais 1 condition pr avoir 1 affichage diff pr le prix si cst 1 vente ou 1 location -->
        <?php if($information['type'] == 'vente'){
            echo $information['price'] . " €";
        } else {
            echo $information['price'] . " €/j";
        }       
        ?>
        </h5>
        <p class="card-text"></p>
    </div>
    <div class="card-footer text-muted">
        <!-- je fais 1 condition pr prendre en compte 2 cas de figure : -->
        <!-- si le nombre de jrs écoulés depuis la publication de l annonce est égal à 0 -->
        <?php if ($delai == 0) {
            // alors je ne veux ps afficher 0 jrs, mais ojd
            echo "Annonce postée Aujourd'hui";
        }else {
            echo "<p>Annonce postée il ya " . $delai . " jour(s)</p>" ;
        }
    
    ?></p> 
    </div>

    
    <?php if(empty($information['reservation_message'])): ?>
        <p>
            <strong>
                Cet appartement n'est pas réservé ! Soyez les premiers à laisser un message afin que le propriétaire vous recontacte.
            </strong>

            <form class="mx-5" action="" method="post">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <div class="form-group">
                    <label for="formReservationMessage">Message de réservation</label>
                    <textarea name="reservation_message" id="formReservationMessage" rows="5" class="form-control" placeholder="Donnez un maximum de coordonnées pour que le propriétaire vous recontacte !"></textarea>
                </div>

                <button class="btn btn-outline-danger mt-3">Je réserve cet appartement !</button>
            </form>
        </p>
    <?php else: ?>
        <div class="alert alert-warning">
            <p>               
                <hr>
                <em></em>
                Cet appartement a été reservé, voici le message du futur conducteur:
            </p>
        </div>
    <?php endif; ?>
    
</div>

<?php require_once('inc/footer.inc.php');