<?php require_once('inc/header.inc.php'); 

if($_POST){
    //je vérifie 2 choses ici. la 1er cst que le champ est bien renseigné (avc isset, s il ne l est ps, alors causera 1 erreur). Le second parametre concerne la longueur de chaines de caracteres (avc icon_strlen). Si elle est < à 3 ou > à 20 cela causera 1 erreur 
    if (!isset($_POST['title']) || iconv_strlen($_POST['title']) <= 3 || iconv_strlen($_POST['title']) > 20) {
        $erreur .= '<div class="alert alert-danger" role>Erreur format Titre/marque !</div>';
    }

    //je fais la mm vérif que précédemment, si la donnée existe, et la longueur de la chaine de caractères, sauf que j autorise que cette longueur soit pls 1portante
    if (!isset($_POST['description']) || iconv_strlen($_POST['description']) <= 3 || iconv_strlen($_POST['description']) > 200) {
        $erreur .= '<div class="alert alert-danger" role>Erreur format description/marque !</div>';
    }
    
    //je verifie si l envoi de données a été effectué ou non.
    //!preg_match = dire quel caracter j utilise et dns quel quantités, 
    if (!isset($_POST['postal_code']) || !preg_match("#^[0-9]{5}$#", $_POST['postal_code'])) {
        $erreur .= '<div class="alert alert-danger" role>Erreur format code postal !</div>';
    }
    
    
    if (!isset($_POST['city']) || iconv_strlen($_POST['city']) <= 2 || iconv_strlen($_POST['city']) > 30) {
        $erreur .= '<div class="alert alert-danger" role>Erreur format ville !</div>';
    }

    //vérif du champs selecteur. En pls de la donnée qui existe, 7 donnée ne pooura etre diff de 'location' et 'vente'. Si aucune ds 2 ne correspond, alrs msg d erreur 
    if (!isset($_POST['type']) || $_POST['type'] != 'location' && $_POST['type'] != 'vente') {
        $erreur .= '<div class="alert alert-danger" role>Erreur format type !</div>';
    }
    
    //je verifie si l envoi de données a été effectué ou non.
    if (!isset($_POST['price']) || !preg_match("#^[0-9]{1,7}$#", $_POST['price'])) {
        $erreur .= '<div class="alert alert-danger" role>Erreur format prix !</div>';
    }


    if (empty($erreur)) {
        //syntaxe de la requete prepare
        $ajoutAppart = $pdo->prepare("INSERT INTO advert (title, description, postal_code, city, type, price) VALUES(:title, :description,  :postal_code, :city, :type, :price)");
        
        $ajoutAppart->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $ajoutAppart->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
        $ajoutAppart->bindValue(':postal_code', $_POST['postal_code'], PDO::PARAM_INT);
        $ajoutAppart->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
        $ajoutAppart->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
        $ajoutAppart->bindValue(':price', $_POST['price'], PDO::PARAM_INT);
        $ajoutAppart->execute();

        $content .= '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            <strong>Félicitations !</strong> Ajout de l\nappartement réussie !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}

?>

<h1 class="text-center text-primary my-5">Ajouter une annonce</h1>

<!-- formulaire -->
<form class="col-md-6 mb-5" method="POST" action="">

    <div class="form-group my-2">
        <label for="title">Titre *</label>
        <input id="title" name="title" type="text" class="form-control" placeholder="La marque de votre véhicule..." required value="">
    </div>

    <div class="form-group my-2">
        <label for="description">Description *</label>
        <textarea id="description" name="description" id="" cols="30" rows="5" class="form-control" placeholder="Une description sincère de l'état du véhicule et de ses équipements !" required></textarea>
    </div>

    <div class="form-group my-2">
        <label for="postal_code">Code postal *</label>
        <input id="postal_code" name="postal_code" type="text" class="form-control" placeholder="code postal" value="" required>
    </div>

    <div class="form-group my-2">
        <label for="city">Ville *</label>
        <input for="city" name="city" type="text" class="form-control" placeholder="Ville" value="" required>
    </div>

    <div class="form-group my-2">
        <label for="price">Tarif *</label>
        <div class="input-group">
            <input id="price" name="price" type="price" class="form-control" placeholder="prix à la location/jour ou prix de vente" required>
            <div class="input-group-append">
                <div class="input-group-text">€</div>
            </div>
        </div>
    </div>

    <div class="form-group my-2">
        <label for="type">Type *</label>
        <select name="type" id="type" class="form-control" required>
            <option value="location" >Location</option>
            <option value="vente" >Vente</option>
        </select>
    </div>

    <button type="submit" class="btn btn-outline-primary mt-5">Créer une annonce</button>

</form>

<?php require_once('inc/footer.inc.php') ?>
