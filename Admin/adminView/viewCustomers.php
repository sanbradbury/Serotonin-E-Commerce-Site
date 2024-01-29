<div >
  <h2>All Customers</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Name </th>
        <th class="text-center">Email</th>
        <th class="text-center">Contact Number</th>
        <th class="text-center">Street</th>
        <th class="text-center">Suburb</th>
        <th class="text-center">Postal Code</th>
      </tr>
    </thead>
    <?php
      include_once "../config/dbconnect.php";
      $sql="SELECT * from users where email != 'admin@serotonin.com'";
      $result=$conn-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["full_name"]?> <?=$row["surname"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["phone"]?></td>
      <td><?=$row["street"]?></td>
      <td><?=$row["suburb"]?></td>
      <td><?=$row["postal_code"]?></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>