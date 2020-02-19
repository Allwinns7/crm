<?php
include 'conn.php';

$product = $_POST['search'];
$reg_sql = "SELECT DISTINCT name, price FROM tbl_products WHERE name LIKE '$product%'";
$reg_query = $conn->query($reg_sql);
echo "<ul style='margin-left: 18px;'>";
while($clients = $reg_query->fetch_assoc()){?>
<li onclick='fill_reg("<?php echo $clients['name']."-".$clients['price']; ?>")' style="cursor: pointer">
       <?php echo $clients['name']; ?>
</li>
<?php
}
echo "</ul>";