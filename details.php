<?php

    include 'config/db_connect.php';

    // check POST request delete
    if(isset($_POST['delete'])){

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM sandwiches WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }

    }

    // check GET request ID
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM sandwiches WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $sandwich = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html>

<?php include 'templates/header.php'; ?>

    <div class="container center grey-text">
        <?php if($sandwich){ ?>
            <h3 style="text-transform: uppercase;"><?php echo htmlspecialchars($sandwich['name']); ?></h3>
            <img src="img/sandwich.png" style="width: 160px; margin: 0 auto -10px;">
            <h5>Ingredients:</h5>
            <p><?php echo htmlspecialchars($sandwich['ingredients']); ?></p>
            <p>Created by: <?php echo htmlspecialchars($sandwich['email']); ?></p>
            <p><?php echo date($sandwich['created_at']); ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $sandwich['id'] ?>">
                <input type="submit" name="delete" value="throw away this sandwich" class="btn z-depth-0">
            </form>

        <?php } else { ?>
            <h5>Oh no!</h5>
            <h6>This sandwich does not exist :(</h6>
        <?php } ?>
    
    </div>

<?php include 'templates/footer.php'; ?>

</html>