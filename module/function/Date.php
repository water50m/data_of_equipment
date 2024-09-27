<?php



function DateTo($date){
if (preg_match('/([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2})(\s([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}))?/', $date, $match)) {
            if (isset($match[4])) {
                return array('y' => $match[1], 'm' => $match[2], 'd' => $match[3], 'h' => $match[5], 'i' => $match[6], 's' => $match[7]);
               
            } else {
                return array('y' => $match[1], 'm' => $match[2], 'd' => $match[3]);
            }
        }

    }

// $date = "2023-11-10 15:30:45";
//     // $day = DateTo($date);
//     // echo''. $day['y'] .'';
// include '../condb.php';
// $sql = "SELECT * FROM history";
// $resulte = mysqli_query($conn,$sql);
// if($resulte){                        
//     echo "success";
// }else{
//     echo 'error '.mysqli_error($conn);
// }
// while($row = mysqli_fetch_array($resulte)) {
// $date = $row['Date_T'];
// // $date2 = "2023-11-10 15:30:45";
// echo $date.'<br>';
// $day = DateTo($date);
// echo $day['y'].'<br>';
// }
        ?>