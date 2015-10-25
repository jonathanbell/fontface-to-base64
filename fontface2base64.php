<?php

// ***USAGE (command line):
// php fontface2base64.php </path/to/font/file.[otf|ttf]> <font-name> <font-style[italic|normal]> <font-weight[300|400|700]>
// OTF or TTF? http://superuser.com/questions/96390/difference-between-otf-open-type-or-ttf-true-type-font-formats
// There's no validation because you know what you're doing..

$fontFile = $argv[1]; // $argv[0] is the call to the script itself
$fontName = $argv[2];
$fontStyle = $argv[3];
$fontWeight = $argv[4];

if (substr($fontFile, -3) == 'otf') {
  $fontType = 'opentype';
} elseif (substr($fontFile, -3) == 'ttf') {
  $fontType = 'truetype';
} else {
  echo 'No OTF or TTF font file supplied. Exiting...';
  exit();
}

if (!file_exists($fontFile)) {
  echo 'The file '.$fontFile.' does not exist.';
  exit();
}

$font_face = '@font-face {'.PHP_EOL.'  font-family:\''.$fontName.'\';font-style:'.$fontStyle.';font-weight:'.$fontWeight.';src:url(data:font/'.$fontType.';base64,'.base64_encode(file_get_contents($fontFile)).')'.PHP_EOL.'}'.PHP_EOL;

$html = '<html><head><link rel="stylesheet" type="text/css" href="'.$fontName.'.css"><style>body{font-family: \''.$fontName.'\';font-size: 3rem;}</style></head><body>AbCdEfGhIjKlMnOpQrStUvWxYz</body></html>';

file_put_contents('./'.$fontName.'.css', $font_face);
file_put_contents('./'.$fontName.'-example.html', $html);
