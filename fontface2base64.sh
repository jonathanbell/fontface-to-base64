#!/bin/sh

function fontface2base64() {
    fontName=$1
    fontFace=$2   
     
    WOFF=`base64 $fontName.woff`
    EOT=`base64 $fontName.eot`
    SVG=`base64 $fontName.svg`
    TTF=`base64 $fontName.ttf`

    echo @font-face {
    echo font-family: \'$fontFace\'\;
    
    echo src: url\(\'data:font/eot\;base64:$EOT\'\)\;
    
	echo src: url\(\'data:font/eot\;base64:$EOT\'\) format\(\'embedded-opentype\'\),\n
	echo  url\(\'data:font/woff\;base64:$WOFF\'\) format\(\'woff\'\),\n
	echo  url\(\'data:font/ttf\;base64:$TTF\'\) format\(\'truetype\'\),\n
	echo  url\(\'data:font/svg\;base64:$SVG\'\) format\(\'svg\'\)\;


    echo font-weight: normal\;
	echo font-style: normal\;
    echo }    

}