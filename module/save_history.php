<?php




// $what_do = 'A212';
// $what_was = 'B212';
// $user ="me";
// $note = 'C212';
 function saveToHistory($what_do,$what_was,$user, $note = null) {
    

    include('condb.php');
        global $conn; 
        // echo 'success';
        
        
        $time = time();
        $newTimestamp = strtotime('+7 hours', $time);
        $date = date("Y/m/d H:i:s", $newTimestamp);

        $hs = "INSERT INTO history (Date_T,  what_do, note_hs,what_was, user_id) VALUES ('$date',  '$what_do', '$note','$what_was','$user')";
        
        if (mysqli_query($conn, $hs)) {
            return true;
        } else {
            return false;
        }
    }
    
    // saveToHistory('$what_do', '$what_was','$user','$note')
   
    // if (saveToHistory($what_do, $what_was,$user,$note))  {
    //     echo 'success2<br>';
    // } else {
    //     echo 'Error: Cannot save to history<br>';
    // }
    
?>