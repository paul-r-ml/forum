<?php

// Language definitions used in EZBBC Toolbar Plugin
$lang_ezbbc = array(

//For the admin plugin page
'Plugin in action'		=>	'Plugin in action!',
'Plugin disabled'		=>	'The plugin has been disabled.',
'Plugin wrong installation'     =>      'The plugin seems not to be installed properly. Please click on the enable button to reinstall it.',
'Not writable'                  =>      'The <code>header.php</code>, <code>include/parser.php</code>, <code>plugins/ezbbc/style/.../ezbbc.css</code>, and <code>plugins/ezbbc/config.txt</code> files should be writeable to perform installation or removing. Please change the permissions of these files to have this action work.',
'Wrong version'			=>		'This plugin has been developed for FluxBB 1.4.6.*+, please <a href="http://fluxbb.org/downloads/archive/">update first your FluxBB installation</a>.',
'Style changed'                 =>      'The style has been modified!',
'Date format'		        =>	'Y/m/d \a\t H:m',
'Plugin title'		        =>	'EZBBC Toolbar',
'Description title'		=>	'Description',
'Explanation'		        =>	'This plugin allows the users to use a simple BBCode insertion toolbar.<br />To have it work, the <code>header.php</code>, <code>include/parser.php</code>, and <code>plugins/ezbbc/config.txt</code> files must be writable. To have the possibility to manage the style folders directly from the administration page, the <code>plugins/ezbbc/style/</code> folder and all its contents must be writable (chmod 777).<br />Each time you update the installation of the FluxBB boards, you should go back to this page to reinstall this plugin.',
'Form title'		        =>	'Information and actions',
'Change style'                  =>      'Change the style',
'Legend style'                  =>      'Please select the Toolbar style',
'Legend status'		        =>	'Here are all the information you have to know about the plugin status.',
'Toolbar preview'               =>      'Toolbar preview',
'No preview'                    =>      'No preview available',
'Plugin version'                =>      'EZBBC Toolbar plugin version:',
'Installation date'		=>	'This version of the plugin has been installed on',
'Plugin status'		        =>	'Plugin status:',
'Available languages'           =>      'Available languages:',
'Enable'			=>	'Enable EZBBC Toolbar',
'Disable'			=>	'Disable EZBBC Toolbar',
'Buttons'                       =>      'Buttons',
'Smilies'                       =>      'Smilies',
'Default smilies'               =>      'FluxBB default smilies',
'EZBBC smilies'                 =>      'EZBBC custom smilies',
'Smiley'                        =>      'Smiley',
'Current style'                 =>      'Current style:',
'OK'                            =>      'OK',
'Edit css'                      =>      'Edit CSS file',
'Rename'                        =>      'Rename',
'Remove'                        =>      'Remove',
'Copy'                          =>      'Copy',
'Remove confirm'                =>      'Do you really want to remove this folder?',

//For popup windows
'Ask title'					=>	'What is the title?',
'Web link'					=>	'Web',
'Topic link'				=>	'Topic',
'Post link'				=>	'Post',
'Forum link'				=>	'Forum',
'User link'				=>	'User',
'Ask label'                     =>	'What is the label? (optional)',
'Ask url type'				=>	'What type of link?',
'Ask url'	                =>	'What is the URL? (beginning with "http://", "https://", "ftp://" or "www.")',
'Ask id'					=>	'What is the ID? (integer)',
'Invalid url'				=>	'Invalid URL!',
'Invalid id'				=>	'Invalid ID!',
'Ask author'	                =>	'What is the author? (optional)',
'Ask quotation'		        =>	'What is the quotation?',
'Ask code'                      =>      'What is the code?',
'Ask language'                  =>      'What is the language?',
'Ask rltable param'                  =>      'Table parameter (like <em>lr</em> for left right)',
'Ask rltable'                  =>      'Table content',
'HTML'							=>		'HTML',
'XHTML'							=>		'XHTML',
'CSS'							=>		'CSS',
'PHP'							=>		'PHP',
'JavaScript'					=>		'JavaScript',
'Java'							=>		'Java',
'XML'							=>		'XML',
'Undefined'						=>		'Undefined',
'Ask color'                     =>      'What is the Color?',
'Ask color explanation'         =>      'Enter a color code like blue, green, red, purple or click on the ColorPicker to choose a color.',
'Ask colorized text'            =>      'Text that has to be colorized',
'Ask email'                     =>      'What is the E-mail address? (containing "@")',
'Invalid email'					=>		'Invalid email address!',
'Ask url img'	                =>	'What is the URL? (beginning with "http://", "https://" or "ftp://")',
'Ask alt'                       =>      'What is the alternative text? (this text displays in case the image doesn\'t display for any reason - optional)',
'Add item'						=>	'Add an Item',

// Titles of the popup pages
'EZBBC Heading'			=>  'EZBBC - Intestazioni',
'EZBBC ColorPicker'             =>  'EZBBC - Tavolozza',
'EZBBC Link chooser'            =>  'EZBBC - Selettore di link',
'EZBBC List creator'            =>  'EZBBC - Creatore di link',
'EZBBC Code insertion'          =>  'EZBBC - Codice',
'EZBBC Image'                   =>  'EZBBC - Immagini',
'EZBBC Quote'                   =>  'EZBBC - Citazione',
'EZBBC RLTable'					=>		'RL Table',
'EZBBC Email'                   =>  'EZBBC - Email',
'Cancel'                        =>  'Cancella',

//For the toolbar
'Bold'		                =>	'Bold » [b]…[/b]',
'Underline'		        =>	'Underline » [u]…[/u]',
'Italic'		        =>	'Italic » [i]…[/i]',
'Strike-through'	        =>	'Strike-through » [s]…[/s]',
'Delete'		        =>	'Delete » [del]…[/del]',
'Insert'			=>	'Insert » [ins]…[/ins]',
'Emphasis'			=>	'Emphasis » [em]…[/em]',
'Colorize'		        =>	'Colorize » [color=…]…[/color]',
'Heading'		        =>	'Heading » [h]…[/h]',
'URL'		                =>	'URL Link » [url=…]…[/url]',
'E-mail'		        =>	'E-mail Link » [email=…]…[/email]',
'Image'			        =>	'Image » [img=…]…[/img]',
'Quote'                         =>      'Quote » [quote=…]…[/quote]',
'RLtable'                         =>      'RL Table » [rltable=…]…[/rltable]',
'Code'                          =>      'Code » [code]…[/code]',
'Unordered List'                =>      'Unordered List » [list=*][*]…[/*][*]…[/*][/list]',
'Ordered List'                  =>      'Numbered Ordered List » [list=1][*]…[/*][*]…[/*][/list]',
'Alphabetical Ordered List'     =>      'Alphabetical Ordered List » [list=a][*]…[/*][*]…[/*][/list]',
'Smilies toggle'		=>	'Toggle the smilies Bar',
'Toolbar help'                  =>      'EZBBC Toolbar help' //This string is also used in admin page

);