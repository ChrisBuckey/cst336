<?php 
    session_start();
    
    include "dbConnection.php";
    
    $conn = getDatabaseConnection("ottermart");
    
    if(!isset($_SESSION['adminName'])){
        header("Location:login.php");
    }

    function displayAllProducts(){
        global $conn;
        $sql = "SELECT * FROM om_product ORDER BY productId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $records;
    }
?>

<form action = "addProduct.php">
    <input type="submit" class='btn btn-secondary' id="beginning" name="addproduct" value="Add Product"/>
</form>

<form action="logout.php">
    <input type="submit" class = 'btn btn-secondary' id="beginning" value="Logout"/>
</form>

<?php
    $records = displayAllProducts();
    
    echo "<table class='table table-hover'>";
    echo "<thead>
            <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Name</th>
                <th scope='col'>Description</th>
                <th scope='col'>Price</th>
                <th scope='col'>Update</th>
                <th scope='col'>Remove</th>
            </tr>
            </thead>";  

    echo "<tbody>";
    foreach($records as $record){
        echo "<tr>";
        echo "<td>" .$record['productId']."</td>";
        echo "<td>" .$record['productName']."</td>";
        echo "<td>" .$record['productDescription']."</td>";
        echo "<td>$" .$record['price']."</td>";
        echo "<td><a class='btn btn-primary' href='updateProduct.php?productId=".$record['productId']."'>Update</a></td>";
        
        echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
        echo "<input type='hidden' name='productId' value=" . $record['productId']. " />";
        echo "<td><input type='submit' class='btn btn-danger' value='Remove'></td>";
        }
    echo "</tbody>";
    echo "</table> ";
?>

