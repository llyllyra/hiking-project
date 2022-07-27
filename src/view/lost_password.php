<?php include_once 'inc/header.inc.php'; ?>

<section id="register">
    <h2>Lost password ?</h2>
    <form method="post" action="lost_password" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>     
    </form>
</section>
<?php include_once 'inc/footer.inc.php'; ?>