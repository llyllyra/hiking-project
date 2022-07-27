<?php include_once 'inc/header.inc.php'; ?>

<section id="register">
    <h2>Update hike</h2>
    <form method="post" action="hike_update" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Departure</label>
            <input type="text" name="departure" class="form-control" aria-describedby="firstnameHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Arrive</label>
            <input type="text" name="arrive" class="form-control" aria-describedby="firstnameHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Difficulty</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Very easy</option>
                <option value="2">Easy</option>
                <option value="3">Medium</option>
                <option value="4">Hard</option>
                <option value="5">Very hard</option>
                <option value="6">Only for warriors</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Distance</label>
            <input type="text" name="distance" class="form-control" aria-describedby="firstnameHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Duration</label>
            <input type="text" name="duration" class="form-control" aria-describedby="lastnameHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Elevation gain</label>
            <input type="text" name="elevation_gain" class="form-control" aria-describedby="loginHelp" placeholder="<?="Contenu"?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <textarea class="form-control" aria-label="With textarea" name="description"><?="Contenu"?></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tags</label>
            <textarea class="form-control" aria-label="With textarea" name="tags"><?="Contenu"?></textarea>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Update</button>
        </div>     
    </form>
</section>
<?php include_once 'inc/footer.inc.php'; ?>