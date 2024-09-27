<?php
session_start();
if(isset($_SESSION['user_name'])){


include '../module/condb.php';
$typeAr = array();
$typeArid = array();

$sql4 = "SELECT * FROM type_durable_articles ";
$result2=mysqli_query($conn,$sql4);

while ($row = mysqli_fetch_array($result2)) {//=====================================================================================
    $type_id = $row['type_id'];
    $type_name = $row['type_name'];
    $sql3 = "SELECT * FROM equipment_inspection_report WHERE type_id = '$type_id'";
    $hand2 = mysqli_query($conn, $sql3);
    ${$type_id . "_num"} = 0;

    // ใช้ลูป while เพื่อแสดงผลลัพธ์
    
    while ($product = mysqli_fetch_array($hand2)) {
        // ทำสิ่งที่คุณต้องการกับข้อมูลจากตาราง "product"
        
        ${$type_id . "_num"} = ${$type_id . "_num"}+1; // ตัวอย่าง: แสดงชื่อสินค้า
                
    }

    // echo 'num of '.$type_name .' is '.${$type_id . "_num"}.'<br>';
    $typeAr[$type_id] = ${$type_id . "_num"};
    $typeArid[$type_id] = $type_name;
    
}

$jsonTypeAr = json_encode($typeAr);
$jsonTypeArid = json_encode($typeArid);





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../static/css/style1.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</head>
<body>
<?php include '../navbar/navbar.php'; ?><br>
<div class="container">
<a href="matherial_graph.php" class="btn btn-secondary">วัสดุ</a>
    <div class="graphbox">
        
     <div class="box">
     <canvas id="myChart"></canvas>

     </div>
        <div class="box">
        <canvas id="myChart2"></canvas>
        </div>
    </div>

    </div>
</body>
<script>
    
  var typeAr = <?php echo $jsonTypeAr; ?>;
  var typeArid = <?php echo $jsonTypeArid; ?>;
  const ctx = document.getElementById('myChart');
  var color = {
                '1': 'rgba(255, 99, 132, 1)',
                '2': 'rgba(54, 162, 235, 1)',
                '3': 'rgba(255, 206, 86, 1)',
                '4': 'rgba(153, 102, 255, 1)',
                '5': 'rgba(255, 159, 64, 1)',
                '6': '#FDFD95',
                '7': '#B19CD8',
                '8': '#836953',
                '9': '#FFD10A',
                '0': 'rgba(75, 192, 192, 1)'
                
};
  var nametype = []; 
  var idtype =[];
  var valuetype = [];
  var colortype = [];
  
  for (var key in typeAr)  {
  if (typeAr.hasOwnProperty(key)) {
    idtype.push(key);
    var value = typeAr[key]
    valuetype.push(value)
    
    var lastid = key.slice(-1);
    
    
    var colorid = color[lastid];
    
    colortype.push(colorid);
  }
}
console.log(colortype);


  for (var keyid in typeArid) {
  if (typeArid.hasOwnProperty(keyid)) {
    var value2 = typeArid[keyid]
    nametype.push(value2)
    
  }
}
  new Chart(ctx, {
    type: 'doughnut',
    data: {
        
      labels: nametype,
      datasets: [{
        label: '',
        data: valuetype,
        backgroundColor: colortype,

        borderColor:colortype,

        borderWidth: 1
      }]
    },
    options: {
      responsive:true,
    }
  });
</script>
<script>
    var jsonData = <?php echo $jsonTypeAr; ?>;
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: nametype,
      datasets: [{
        label: '',
        data: valuetype,
        backgroundColor: colortype,
        
        borderColor:colortype,

        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</html>

<?php
}else{
    header('location: ui_login/Ui_login.php')  ;
}
?>