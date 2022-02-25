<?php require_once('inc/header.inc.php'); 

$afficheAppart = $pdo->query("SELECT * FROM advert ORDER BY id DESC LIMIT 15");

?>

<div class="jumbotron">
    <h1 class="text-center text-primary my-5">LeBonAppart.com</h1>
    <p class="lead">Vendez, achetez, louez un appartement facilement avec LeBonAppart.com !</p>
    <hr class="my-5">
    <div class="row">
        <img src="img/appart.jpg" alt="appartement" title="appartement">
    </div>
    <div class="row text-center mt-5">
        <p class="col-12">
            <a class="btn btn-outline-primary btn-lg me-5" href="add.php" role="button">J'ajoute mon annonce !</a>
            <a class="btn btn-primary btn-lg ms-5" href="list.php" role="button">Voir la liste des annonces</a>
        </p>
    </div>
</div>

<h1 class="mt-5">Nos 15 dernières annonces ajoutées</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Annonce</th>
            <th>Lieu</th>
            <th>Prix et type</th>
        </tr>
    </thead>
    <tbody>
         <?php while($appart = $afficheAppart->fetch(PDO::FETCH_ASSOC)): ?> 
            <tr>
                <td>
                    <strong><?= strtoupper($appart['title']) ?></strong>
                    <p>
                        <small>
                            <?= $appart['description'] ?>
                        </small>
                    </p>
                </td>
                <td>
                    <?= $appart['postal_code']?>
                    <?= $appart['city'] ?>   
                </td>
                <td>
                    <span class="badge bg-primary"><?= $appart['type'] ?></span>
                    <span class="badge bg-secondary"><?= $appart['price'] ?> €</span>
                </td>
            </tr>
        <?php endwhile ?>
    </tbody>
</table>

<?php require_once('inc/footer.inc.php') ?>
