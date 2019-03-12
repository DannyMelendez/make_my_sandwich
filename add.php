<?php 

include 'config/db_connect.php';

$email = $name = $ingredients = '';
$errors = array('email'=>'', 'name'=>'', 'ingredients'=>'');

    if(isset($_POST['submit'])){

        if(empty($_POST['email'])){
            $errors['email'] = 'Email is required. <br/>';
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Please enter a valid email.';
            }
        }

        if (empty($_POST['name'])){
            $errors['name'] = 'Sandwich name is required. <br/>';
        } else {
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-z\s]+$/', $name)){
                $errors['name'] = 'Name of the sandwich can only include letters or spaces.';
            }
        }

        if (empty($_POST['ingredients'])){
            $errors['ingredients'] = 'Atleast one ingredient is required. <br/>';
        } else {
            $ingredients = $_POST['ingredients'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'Ingredients must be separated by comma.';
            }
        }

        if(!array_filter($errors)){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            $sql = "INSERT INTO sandwiches(name, email, ingredients) VALUES('$name', '$email', '$ingredients')";

            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            } else {
                echo 'Query error: ' . mysqli_error($conn);
            }
        } 
    } //end of POST

?>

<!DOCTYPE html>
<html>

    <?php include 'templates/header.php' ?>    

    <section class="container grey-text">
        <h4 class="center">Add a Sandwich<h4>
        <form action="add.php" method="POST" class="white">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
                <div class="red-text">
                    <?php
                        echo $errors['email']; 
                    ?>
                </div>
            <label>Sandwich Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
                <div class="red-text">
                    <?php
                        echo $errors['name']; 
                    ?>
                </div>
            <label>Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
                <div class="red-text">
                    <?php
                        echo $errors['ingredients']; 
                    ?>
                </div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn z-depth-0">
            </div>
        </form>
    </section>

    <?php include 'templates/footer.php' ?>

</html> 