<?php
include('config/db_connect.php');
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM books WHERE $id_to_delete=id";
    if (mysqli_query($conn, $sql)) {
        //success
        header('Location:index.php');
    } else {
        echo 'error :' . mysqli_error($conn);
    }
}
//check GET request id param
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']); //prevents sql database
    $sql = "SELECT * FROM books WHERE id=$id";
    //get the query result
    $result = mysqli_query($conn, $sql);
    //fetch result in form of an array
    $book = mysqli_fetch_assoc($result);
    //free resut from memory
    mysqli_free_result($result);
    //freedatabase connection
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('main/header.php'); ?>
<div class="container center grey-text">
    <?php if ($book) { ?>
        <h4><?php echo htmlspecialchars($book['title']); ?></h4>
        <p>Created by :<?php echo htmlspecialchars($book['email']); ?></p>
        <p><?php echo date($book['created_at']); ?></p>
        <h5>contents :</h5>
        <p> <?php echo htmlspecialchars($book['contents']); ?></p>
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $book['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">

        </form>
    <?php } else { ?>
        <h5>No Such book</h5>
    <?php } ?>
</div>
<?php include('main/footer.php'); ?>
</body>

</html>