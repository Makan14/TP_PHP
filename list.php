<?php require_once('inc/header.inc.php'); 

$afficheAppart = $pdo->query("SELECT * FROM advert ORDER BY id DESC LIMIT 15");

?>
 
<h1 class="text-center text-primary my-5">Consultez toutes nos annonces</h1>

<!-- tableau des annonces -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>Annonce</th>
            <th>Lieu</th>
            <th>Prix et type</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
         <?php while($appart = $afficheAppart->fetch(PDO::FETCH_ASSOC)): ?> 
            <tr>
                <td>
                    <strong></strong>
                    <p>
                        <small>
                        <?= $appart['description'] ?>
                            
                        </small>
                    </p>
                </td>
                <td>
                    <?= $appart['postal_code']?>
                    <?= $appart['city'] ?>
                <?php if(!empty($appart['reservation_message'])):?>
                    <span class="badge bg-success">Ce bien a déjà été réservé !</span>
                <?php endif ?>                   
                </td>
                <td>
                    <span class="badge bg-danger"><?= $appart['type'] ?></span>
                    <span class="badge bg-warning"><?= $appart['price'] ?> €</span>
                </td>
                <td>
                    <a href="show.php?id=<?= $appart['id'] ?>" class="btn btn-danger">Voir l'annonce</a>
                </td>
            </tr>
        <?php endwhile ?>
    </tbody>
</table>

<?php require_once('inc/footer.inc.php') ?>


