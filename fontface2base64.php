<?php

if (!php_sapi_name() === 'cli') {
  echo 'This PHP script is meant to be run from the PHP command line, not in browser.';
  exit();
}

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

$html = '<!DOCTYPE html><html><head><title>'.$fontName.' example</title><link rel="stylesheet" type="text/css" href="'.$fontName.'.css"><style>body{font-family: \''.$fontName.'\';font-size: 3rem;}</style></head><body>AbCdEfGhIjKlMnOpQrStUvWxYz</body></html>';

file_put_contents('./'.$fontName.'.css', $font_face);
file_put_contents('./'.$fontName.'-example.html', $html);
