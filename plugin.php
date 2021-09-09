<?php
/*
Plugin Name: Simple Image Generation
Plugin URI: https://github.com/LeoColomb/yourls-image-placeholder
Description: A quick and simple image placeholder service &mdash; <a href="http://placehold.it">placehold.it</a>
Version: 1.2
Author: Leo Colombaro
Author URI: https://colombaro.fr/
Template: <code>http://sho.rt/[width]x[height]?c=[color]&f=[format]</code><br />Parameters are optional (e.g. http://sho.rt/320x50?c=ffffff).
*/

// no direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// you can modify the character before number
define( 'SEPARATOR_CHAR', 'x' );

// try something, if yourls doesn't recognise a valid short link
yourls_add_action( 'redirect_keyword_not_found', 'lpc_generate_image' );

// so prepare generation
function lpc_generate_image( $request ) {
    // shorturl is like '200x50'?
    if ( preg_match( "@^([0-9]+)" . SEPARATOR_CHAR . "([0-9]+)$@", $request[0], $matches ) ) {
        // declare the content file
        switch ($_GET["f"]) {
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;

            case 'gif':
                header('Content-Type: image/gif');
                break;

            case 'png':
            default:
                header('Content-Type: image/png');
                break;
        }
        // image generation
        $image =  imagecreate( $matches[1], $matches[2] );
        // get background coloration
        $color = array(
            'r' => hexdec( ( $_GET["c"] ) ? substr($_GET["c"], 0, 2) : 26 ),
            'g' => hexdec( ( $_GET["c"] ) ? substr($_GET["c"], 2, 2) : 26 ),
            'b' => hexdec( ( $_GET["c"] ) ? substr($_GET["c"], 4, 2) : 26 )
        );
        imagecolorallocate( $image, $color['r'], $color['g'], $color['b'] );
        // print the request on image
        imagestring( $image, 3, 10, 10, $matches[1] . ' x ' . $matches[2], imagecolorallocate( $image, 0, 0, 0 ) );
        // show image
        switch ($_GET["f"]) {
            case 'jpg':
            case 'jpeg':
                imagejpeg( $image );
                break;

            case 'gif':
                imagegif( $image );
                break;

            case 'png':
            default:
                imagepng( $image );
                break;
        }
        // clean memory
        imagedestroy( $image );
        die();
    }
}
