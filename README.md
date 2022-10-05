# Simple Image Generation

Plugin for [YOURLS](http://yourls.org) 1.6+. 

## Description

A quick and simple image placeholder service as [placehold.it](http://placehold.it).

## Requirements

In addition to YOURLS core requirements, the following PHP extensions are required:
* [GD](https://www.php.net/manual/en/book.image.php)

## Installation

1. In `/user/plugins`, create a new folder named `image-placeholder`.
2. Drop these files in that directory.
3. Go to the Plugins administration page ( *eg* `http://sho.rt/admin/plugins` ) and activate the plugin.
4. Have fun!

## How to use

### Template
`http://sho.rt/[width]x[height]?c=[color]&f=[format]`

### Parameters
*Both parameters are optional*  

* Coloration
	* 262626 is default
	* Declare it in Hex (RRGGBB)
* Format
	* PNG is default
	* Formats available:
		* PNG
		* JPEG
		* GIF

### Examples
* `http://sho.rt/320x50`
* `http://sho.rt/320x50?c=ffffff`
* `http://sho.rt/320x50?f=jpeg`
* `http://sho.rt/320x50?c=25f0ff&f=gif`
