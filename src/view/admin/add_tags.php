<?php
include_once '../view/inc/header.inc.php';
?>
<section class="admin">
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <span class="mb-0 h1">ADMIN</span>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin?page=users">USERS</a>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">HIKES</a>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin?page=tags">TAGS LIST</a>
        </div>
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin?page=add_tag">ADD TAG</a>
        </div>
    </nav>

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