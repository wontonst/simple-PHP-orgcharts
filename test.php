<?

function test() {
    $v = 4;
    $b = $v++;
    return $b;
}
function test2() {
    $v = 4;
    $b = ++$v;
    return $b;
}

echo test()."\n".test2();
?>