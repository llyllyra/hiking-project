<?php include_once '../view/inc/header.inc.php';?>
<section class="admin">
<?php include_once 'inc/navigation.php';?>

    <section class="admin_content">
        <h2 class="admin_title">ADD TAG</h2>
        <form method="post" action="/admin?page=tag_added" enctype="multipart/form-data">
            <table class="table">
                </thead>
                <tbody>
                        <tr>
                            <td>
                            <div class="mb-3">
                                <label for="tag" class="form-label">Tag</label>
                                <input type="text" name="tag" class="form-control" aria-describedby="tag" required>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                            </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </form>
    </section>
</section>

<?php include '../view/inc/footer.inc.php'; ?>