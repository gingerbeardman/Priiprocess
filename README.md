# Priiprocess

So the goals of my tool:

* Easier theme creation
* Easier theme management
* Smaller themes
* Modular themes

It does this by introducing:

* variables
* includes

The result is kind of like a cross between INI and CSS. 

You can define a single *.color_heading* and then use it in many places. To change the colour of all those elements, simply change the single definition and you're done!

To show that the tool works, I have deconstructed *Rhapsodii 2.0* which in the process became a more organised theme. By reusing definitions for positions and reusable elements I was able to consolidate and improved consistency. Thanks for your kind support @Hakaisha!

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

We can replce with user definitions, easier to write but still repetitive:

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

And by go further by using a single include:

	[ABOUT/TITLE]
	.title

The best results would come from building a theme from a scratch with the tool in mind, as my deconstruction of Rhapsodii 2.0 could be optimised further still.

So... the tool! I'm calling it [B]Priiprocess[/B] and it is less than 100 lines of PHP code. It could easily be ported to Python or even C (if WFL wanted to add support for this type of theme structure). 

Let's call this a first test vision, to get feedback. If it's something people would use then I will create my own thread for it.

Thanks for your time and have fun!
