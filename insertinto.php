<?php
if ($_FILES["./newfilename.csv"][size] > 0) { 
    echo 'ok';

    require('../lib/conn.php');
    $dbconn = pg_connect($conn_rain) or die('Could not connect');
    //get the csv file 
    $file = $_FILES["./newfilename.csv"][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            pg_query("INSERT INTO contacts (latitude,longitude,brightness,scan,track,acq_date,acq_time,satellite,confidence,version,bright_t31,frp,daynight) VALUES( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."', 
                    '".addslashes($data[3])."', 
                    '".addslashes($data[4])."', 
                    '".addslashes($data[5])."', 
                    '".addslashes($data[6])."', 
                    '".addslashes($data[7])."', 
                    '".addslashes($data[8])."', 
                    '".addslashes($data[9])."', 
                    '".addslashes($data[10])."', 
                    '".addslashes($data[11])."', 
                    '".addslashes($data[12])."', 
                    '".addslashes($data[13])."'
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //pg_query($sql);
    pg_close($dbconn);
    //redirect 
    header('Location: insertinto.php?success=1'); die; 

    echo 'ok';

} 
?>