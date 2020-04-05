<?php
include('config/db_connect.php');
$title = $email = $content = $author = "";
$errors = array('email' => '', 'title' => '', 'content' => '', 'author' => '');
if (isset($_POST['submit'])) {
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['books']);
    //checkemail
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'email must be valid';
        }
    }
    if (empty($_POST['title'])) {
        $errors['title'] = 'An title is required';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title))
            $errors['title'] = 'title must be letters and spaces only';
    }
    if (empty($_POST['author'])) {
        $errors['author'] = 'An author name is required';
    } else {
        $author = $_POST['author'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $author))
            $errors['author'] = 'author must be letters and spaces only';
    }
    if (empty($_POST['contents'])) {
        $errors['content'] =  'An content is required<br/>';
    } else {
        $content = $_POST['contents'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $content))
            $errors['content'] = 'content must be comma separated';
    }
    if (!array_filter($errors)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $content = mysqli_real_escape_string($conn, $_POST['contents']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);

        $sql = "INSERT INTO books(title,email,contents,author)VALUES('$title','$email','$content','$author')";
        //save to db and check
        if (mysqli_query($conn, $sql)) {
            //success
            header('Location: index.php');
        } else {
            echo 'query error' . mysqli_error($conn);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include('main/header.php') ?>;
<section class="container grey-text">
    <h4 class="center">Add a book</h4>
    <!--  <form class="white" action="add.php" method="GET">-->
    <form class="white" action="add.php" method="POST">

        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Book Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Author:</label>
        <input type="text" name="author" value="<?php echo htmlspecialchars($author); ?>">
        <div class="red-text"><?php echo $errors['author']; ?></div>
        <label>Content:</label>
        <input type="text" name="contents" value="<?php echo htmlspecialchars($content); ?>">
        <div class="red-text"><?php echo $errors['content']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value-"submit" class="btn brand z-depth-0">
        </div>

    </form>
</section>
<?php include('main/footer.php') ?>;



</html>