<?php 
 include 'header.php';
?>
<table>
    <th>الرقم</th>
    <th>اسم المريض</th>
    <th>البريد الالكتروني</th>
    <th>التاريخ</th>

<?php
$host = 'localhost';
$user = 'mahmood';
$password = 'php';
$dbname = 'hostpital';

$conn = mysqli_connect($host,$user,$password,$dbname);

$query = 'SELECT * FROM patient';
    $result = mysqli_query($conn, $query);
if($result){
    
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr><td>".$row['id']."</td><td>".$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['date'].'</td></tr>';
    }
    echo '</table>';
}

?>