#!/usr/bin/php
<?

$str = file_get_contents('out.txt');

$last = time();
while( 1 ){
  system('./shallot '. $argv[1] .' >> out.txt');
  preg_match_all('/[a-z0-9]+\.onion/', file_get_contents('out.txt'), $m);
  $last_found = $m[0][count($m[0])-1];

  echo "\t" . time() - $last . " s\t" . $last_found . "\n";
  $last = time();
}
