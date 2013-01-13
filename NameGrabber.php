<?

class NameGrabber {
    public static function grab($filename,$num=1) {
        $file = fopen($filename,'r');
        $lines = trim(fgets($file));
        $lines--;
        for($i = 0; $i != $num; $i++)
            $index[] = rand(0,$lines);

        $output = array();
        $currline = 0;
        while($currline != $lines) {
            $line = fgets($file);
            if(in_array($currline,$index)) {
                $output[]=trim($line);
                if($currline == end($index))
                    return $output;
            }
            $currline++;
        }
        return $output;
    }

}
?>