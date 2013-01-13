#!/usr/bin/php
<?


$file = isset($argv[1]) && file_exists($argv[1]) ? $argv[1] : 'out.txt';
$errors = 0;

$cont = file_get_contents($file);
$patt = implode(array(
  '/' .
  '([a-z0-9]+\.onion)\s' .
  '[\-]+\s' .
  '([\-]+BEGIN RSA PRIVATE KEY[\-]+\s' .
  '[^-]+' .
  '[\-]+END RSA PRIVATE KEY[\-]+)' .
  '/'
));

if( preg_match_all($patt, $cont, $m) ){
  for( $i = 0; $i < count($m[0]); ++$i ){
    $fp = fopen('done/' . $m[1][$i], 'w');
    if( $fp ){
      fwrite($fp, $m[2][$i]);
      fclose($fp);
    }else{
      ++$errors;
    }
  }
}

if( $errors === 0 ){
  file_put_contents($file, '');
}
