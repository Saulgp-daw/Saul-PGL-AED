
<?php

$fp = fopen("fichero.dat", "rw+");

if (flock($fp, LOCK_EX)) {  // acquire an exclusive lock
    if(filesize("fichero.dat") == 0){
        $contador = 0;
    }else{
        $contador = fread($fp, filesize("fichero.dat"));
    }
    
    $contador = $contador ?? 0;
    $contador++;

    ftruncate($fp, 0);      // truncate file
    rewind($fp);
    echo $contador . "\n";
    fwrite($fp, $contador);
    //fflush($fp);            // flush output before releasing the lock
    flock($fp, LOCK_UN);    // release the lock
} else {
    echo "Couldn't get the lock!";
}

fclose($fp);

?>
