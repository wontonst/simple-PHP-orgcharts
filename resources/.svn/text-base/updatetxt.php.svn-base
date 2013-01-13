<?

$files = array('americannames.txt','chinesenamerandom.txt','europeannames.txt','indiannames.txt','lastnameamerican.txt','lastnamechinese.txt','lastnameeuropean.txt','lastnameindian.txt','weirdlastnamerandom.txt','weirdnamesrandom.txt');

foreach($files as $filename) {
    $file = fopen($filename,'r');

    $lines = 0;
    $array = array();
    while($line = fgets($file)) {
        $array[] = $line;
        $lines++;
    }
    $array[0] = ($lines-1)."\n";
    $file = fopen($filename,'w');
    fwrite($file,implode($array));

}

?>