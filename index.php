<?php 

    include 'config/db_connect.php';

    //query for sandwiches
    $sql = 'SELECT name, ingredients, id FROM sandwiches ORDER BY created_at';

    //query and get results
    $results = mysqli_query($conn, $sql);

    //fetch resulting rows as array
    $sandwiches = mysqli_fetch_all($results, MYSQLI_ASSOC);

    //freeing results from memory
    mysqli_free_result($results);

    //closing connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html >

    <?php include 'templates/header.php' ?>    

    <h4 class="center grey-text">Sandwiches</h4>
    <div class="container">
        <div class="row" >
        
          <?php foreach($sandwiches as $sandwich) { ?>

            <div class="col s6 md3">
                <div class="card z-depth-1">
                    <img src="img/sandwich.png" class="sandwich">
                    <div class="card-content center ">
                        <h5 style="text-transform: uppercase;"><?php echo htmlspecialchars($sandwich['name']); ?></h5>
                        <ul>
                            <?php foreach(explode(',', $sandwich['ingredients']) as $ingredient){ ?>
                                <li><?php echo htmlspecialchars($ingredient); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-action center">
                        <a href="details.php?id=<?php echo $sandwich['id']?>">More about this sandwich</a>
                    </div>
                </div>
            </div>

          <?php } ?>
        
        </div>
    </div>

    <?php include 'templates/footer.php' ?>

</html> 