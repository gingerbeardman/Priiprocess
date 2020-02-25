# Priiprocess

> This tool was created to help make it easier to create, edit and maintain .ini files for software that doesn't manage them itself

The goals were:

* Easier theme creation/editing/management
* Smaller & Modular themes

It does this by introducing:

* Variables
* Includes

The result is kind of like a cross between INI and CSS. 

You can define a single *.color_heading* and then use it in many places. To change the colour of all those elements, simply change the single definition and you're done!

To show that the tool works, I have deconstructed *Rhapsodii 2.0* - a theme for [WiiFlow Lite](https://github.com/Fledge68/WiiFlow_Lite) - which in the process became a more organised. By reusing definitions for common positions and reusable elements I was able to consolidate and improve consistency. Thanks to [@Hakaisha](https://github.com/Hakaisha) the creator of that theme for their kind support!

## Capabilities

**Variable (Long)**

    ;.example_1	: key=value

  _Usage:_

    [SECTION]
    .example_1

**Variable (Short)**


    ;.example_2	: value

  _Usage:_

    [SECTION]
    key=.example_2

**Includes**

    ;.example_3	: inc.file_name.ini

  _Usage:_

    [SECTION]
    .example_3

## Example

As an example, every title has the same code:

	[ABOUT/TITLE]
	color=#FFFFFFFF
	effect_scale_x=1
	effect_scale_y=0
	effect_x=0
	effect_y=-200
	font_line_height=0
	font_size=0
	font_weight=0
	height=60
	width=600
	x=20
	y=15

We can replace this with the names of (unshown) user definitions, which is easier to read/write but still repetitive:

	[ABOUT/TITLE]
	.white
	.fixed_scale_x
	.zero_scale_y
	.fixed_left
	.from_off_top
	.no_line_height
	.no_font_size
	.no_font_weight
	.title_height
	.title_width
	.title_x
	.title_y

But we can go even further by using a single include to reuse the definitions in multiple places:

	[ABOUT/TITLE]
	.title

	[PLUGIN/TITLE]
	.title

The best results would come from building a theme from a scratch with the tool in mind, as my deconstruction of *Rhapsodii 2.0* could be optimised further still.

So... the tool! I'm calling it **Priiprocess** and it is less than 100 lines of PHP code. It could easily be ported to Python or even C (if WFL wanted to add support for this type of theme structure).

## Usage

    php priiprocess.php

It spits out a .prii.ini file (includes merged, variables untouched) and an .ini (incudes merged, variables replaced).
