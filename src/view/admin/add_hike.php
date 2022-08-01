<?php
include_once 'inc/header.inc.php';
include_once 'model/Sql.php';

$sql = new Sql();

//Si l'utilisateur n'est pas connecté : message d'erreur / Exit
if (!isset($_SESSION['user_id'])) {
    echo 'Veuillez vous connecter';
    exit();
}
?>

    <section id="register">
        <h2>Add hike</h2>
        <form method="post" action="add_hike" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" aria-describedby="name"
                       placeholder="Enter the name of your hike" required>
            </div>
            <div class="mb-3">
                <label for="departure" class="form-label">Departure</label>
                <input type="text" name="departure" class="form-control" aria-describedby="departure"
                       placeholder="Enter departure point" required>
            </div>
            <div class="mb-3">
                <label for="arrive" class="form-label">Arrive</label>
                <input type="text" name="arrive" class="form-control" aria-describedby="arrive"
                       placeholder="Enter arrived point" required>
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
                <input type="number" name="distance" class="form-control" aria-describedby="distance"
                       placeholder="Enter distance" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="number" name="duration" class="form-control" aria-describedby="duration"
                       placeholder="Enter duration" required>
            </div>
            <div class="mb-3">
                <label for="elevationgain" class="form-label">Elevation gain</label>
                <input type="number" name="elevationgain" class="form-control" aria-describedby="elevationgain"
                       placeholder="Enter elevation gain" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
            </div>

            <!-- ajout de tags -->
            <?php
            // reprendre la db car inconnue
            $tags = $sql->getTag();
            foreach ($tags as $tag) :
                ?>
                <div class="form-check">
                    <input name="tags[]" value="<?= $tag['id']; ?>" class="form-check-input" type="checkbox"
                           id="flexCheckDefault">
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
<?php
include_once 'inc/footer.inc.php'; ?>