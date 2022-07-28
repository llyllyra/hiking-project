<?php
include_once 'inc/header.inc.php';

//Si l'utilisateur n'est pas connecté : message d'erreur / Exit
if (!isset($_SESSION['user_id'])) {
    echo 'Veuillez vous connecter';
    exit();
}
// on teste la déclaration de nos variables
if (isset($_POST['name']) && isset($_POST['departure']) && isset($_POST['arrive']) &&  isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['elevationgain']) && isset($_POST['description'])){

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
        require_once '../core/db.php';
        //enregistrer les données dans la base de données
        $stmt = $pdo->prepare("INSERT INTO hikes (name, depature, arrive, difficulty, distance, duration, elevationGain, description, tags_id) VALUES (:name, :depature, :arrive, :difficulty, :distance, :duration, :elevationgain, :description, :tags)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':arrive', $arrive);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':elevationgain', $elevationgain);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':tags', $tags);

        // insertion d'une ligne
        $name = $_POST['name'];
        $departure = $_POST['departure'];
        $arrive = $_POST['arrive'];
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $elevationgain = $_POST['elevationgain'];
        $description = $_POST['description'];
        $tags = $_POST['tags'];
    echo "<pre>";
    echo$name, $departure, $arrive, $difficulty, $distance, $duration, $elevationgain, $description, $tags;
    echo "</pre>";
        $stmt->execute();

        //Redicrection
        header('Location: home');
        exit();
    //Si les champs ne sont pas tous remplis    
} else {
    echo "Veuillez remplir tous les champs";
}

?>

<section id="register">
    <h2>Add hike</h2>
    <form method="post" action="add_hike" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="name" placeholder="Enter the name of your hike" required>
        </div>
        <div class="mb-3">
            <label for="departure" class="form-label">Departure</label>
            <input type="text" name="departure" class="form-control" aria-describedby="departure" placeholder="Enter departure point" required>
        </div>
        <div class="mb-3">
            <label for="arrive" class="form-label">Arrive</label>
            <input type="text" name="arrive" class="form-control" aria-describedby="arrive" placeholder="Enter arrived point" required>
        </div>
        <div class="mb-3">
            <label for="difficulty" class="form-label">Difficulty</label>
            <select name="difficulty" class="form-select" aria-label="difficulty">
                <option selected>Open this select menu</option>
                <option value="Very easy">Very easy</option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
                <option value="Very hard">Very hard</option>
                <option value="Only for warriors">Only for warriors</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="distance" class="form-label">Distance</label>
            <input type="text" name="distance" class="form-control" aria-describedby="distance" placeholder="Enter distance" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <input type="text" name="duration" class="form-control" aria-describedby="duration" placeholder="Enter duration" required>
        </div>
        <div class="mb-3">
            <label for="elevationgain" class="form-label">Elevation gain</label>
            <input type="text" name="elevationgain" class="form-control" aria-describedby="elevationgain" placeholder="Enter elevation gain" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
        </div>

        <!-- ajout de tags -->
        <?php
        // reprendre la db car inconnue
        require_once '../core/db.php';
        try {
            $q = $pdo->prepare("SELECT * from tags");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tags as $tag) :
        ?>
            <div class="form-check">
                <input name="tags" value="<?= $tag['id']; ?>" class="form-check-input" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                <?= $tag['name']; ?>
                </label>
            </div>
        <?php
        endforeach;
        ?>
        <div class="btn_box">
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
        </div>
    </form>
</section>
<?php include_once 'inc/footer.inc.php'; ?>