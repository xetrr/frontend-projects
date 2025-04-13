<?php
//connect to the rdbms 
$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    echo "faild to connect to the database" . mysqli_connect_error($conn);
}

$sql = "CREATE DATABASE IF NOT EXISTS todoApp";
// to execute the query
$result = mysqli_query($conn, $sql);

mysqli_close($conn);


// connect to the created database and make a table 
$conn = mysqli_connect("localhost", "root", "", "todoApp");

$sql = "CREATE TABLE tasks(
    `id` INT PRIMARY KEY AUTO_INCREMENT, 
    `title` VARCHAR(200) NOT NULL
)";

$result  = mysqli_query($conn, $sql);

echo mysqli_error($conn);
?>

<pre>
<?php var_dump($conn); ?>
</pre>