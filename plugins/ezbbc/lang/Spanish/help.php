<?php 
// Including common.php file to have access to fluxBB functions
define('PUN_ROOT', '../../../../');
require PUN_ROOT.'include/common.php';
// Retrieving style folder
$config_content = trim(file_get_contents(PUN_ROOT.'plugins/ezbbc/config.txt'));
$config_item = explode(";", $config_content);
$ezbbc_style_folder = $config_item[2];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo PUN_ROOT.'style/'.$pun_user['style'].'.css' ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo PUN_ROOT.'plugins/ezbbc/style/'.$ezbbc_style_folder.'/ezbbc.css' ?>" />
<title>EZBBC Toolbar ayuda</title>
</head>
<body>
<div class="pun">
<div class="punwrap">
<div id="brdmain">
<div  id="ezbbc_help">
        <ul id="menu">
                <li><a href="#common_buttons">Común botones</a></li>
                <li><a href="#color_button">Botón Color</a></li>
                <li><a href="#heading_button">Botones de cabecera</a></li>
                <li><a href="#url_button">Botón de URL</a></li>
                <li><a href="#email_button">Botón de E-mail</a></li>
                <li><a href="#image_button">Botón de Imagen</a></li>
                <li><a href="#quote_button">Botón Citar</a></li>
                <li><a href="#code_button">Botón de Código</a></li>
                <li><a href="#list_buttons">Botones de Lista</a></li>
                <li><a href="#smilies">Emoticones</a></li>
        </ul>

<h1>EZBBC Toolbar ayuda</h1>

        <h2 id="common_buttons">Línea común botones de formateo</h2>
                <h3>Usar</h3>
                        <p>
                        Estos botones sólo insertan una etiqueta de inicio y una final al texto seleccionado. Si no se selecciona texto, las etiquetas se insertan y parpadea el cursor entre las etiquetas inicial y final.<br />
                        Esto es lo que debe ser similar para el botón Negrita: <code>[b]Texto seleccionado[/b]</code>
                        </p>
                <h3>Sumario</h3>
                        <table>
                                <tbody>
                                        <tr>
                                        <th>Botones</th>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/bold.png" alt="Negrita" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/underline.png" alt="Subrayar" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/italic.png" alt="Itálica" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/strike-through.png" alt="Tachado" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/delete.png" alt="Borar" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/insert.png" alt="Insertar" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/emphasis.png" alt="Enfasis" /></td>
                                        </tr>
                                        <tr>
                                        <th>Usar</th>
                                        <td>Negrita</td>
                                        <td>Subrayar</td>
                                        <td>Ítalica</td>
                                        <td>Tachado</td>
                                        <td>Borrar</td>
                                        <td>Insertar</td>
                                        <td>Enfasis</td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas BBCode</th>
                                        <td><code>[b]…[/b]</code></td>
                                        <td><code>[u]…[/u]</code></td>
                                        <td><code>[i]…[/i]</code></td>
                                        <td><code>[s]…[/s]</code></td>
                                        <td><code>[del]…[/del]</code></td>
                                        <td><code>[ins]…[/ins]</code></td>
                                        <td><code>[em]…[/em]</code></td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas HTML</th>
                                        <td><code>&lt;strong&gt;…&lt;/strong&gt;</code></td>
                                        <td><code>&lt;span…&gt;…&lt;/span&gt;</code></td>
                                        <td><code>&lt;span…&gt;…&lt;/span&gt;</code></td>
                                        <td><code>&lt;span…&gt;…&lt;/span&gt;</code></td>
                                        <td><code>&lt;del&gt;…&lt;/del&gt;</code></td>
                                        <td><code>&lt;ins&gt;…&lt;/ins&gt;</code></td>
                                        <td><code>&lt;em&gt;…&lt;/em&gt;</code></td>
                                        </tr>
                                </tbody>
                        </table>

        <h2>Color y los botones de cabecera</h2>
                <h3 id="color_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/color.png" alt="Colorear" /> Botón Color</h3>
                        <p>
                        The color button will be used to colorize the selected text. First select the text you want to change the color of, then you have to enter in the displaying popup window a color name (red, green, blue, purple, …) - if you want to know them all have a look to <a href="http://www.somacon.com/p142.php" onclick="window.open(this.href, 'Color_name', 'height=500, width=310, top=10, left=650, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=yes, status=no'); return false;">this page</a> - or a hexadecimal color code (ex.: #DDDDDD) - you can find this hex code by using the Color Picker. If no text is selected, then the text "Text that has to be colorized" enclosed in <code>[color]</code> tags will be displayed and highlighted so that you can change it.<br/>
                        Esto es lo que debe ser similar a un texto en rojo: <code>[color=red]Texto seleccionado[/color]</code>.
                        </p>
                <h3 id="heading_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/heading.png" alt="Cabecera" /> Botones de cabecera</h3>
                        <p>
                        El título botones de cabecera en el texto seleccionado en un elemento de título. Sólo tienes que seleccionar el texto que debe convertirse en un título y pulsar en este botón o pulsar en el botón (sin seleccionar nada), introducir un título, y validar.
                        </p>
                <h3>Sumario</h3>
                        <table>
                                <tbody>
                                        <tr>
                                        <th>Botones</th>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/color.png" alt="Colorear" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/heading.png" alt="Cabecera" /></td>
                                        </tr>
                                        <tr>
                                        <th>Usar</th>
                                        <td>Colorear</td>
                                        <td>Título</td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas BBCode</th>
                                        <td><code>[color=color_code]…[/color]</code></td>
                                        <td><code>[h]…[/h]</code></td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas HTML</th>
                                        <td><code>&lt;span…&gt;…&lt;/span&gt;</code></td>
                                        <td><code>&lt;h5&gt;…&lt;/h5&gt;</code></td>
                                        </tr>
                                </tbody>
                        </table>

        <h2>Dirección Web, E-mail y Botones de Imagen</h2>
                <h3 id="url_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/link.png" alt="URL" /> Botón de URL</h3>
                        <p>
                        If you've selected text, before clicking on the URL button, you should see appear a window displaying the text as the label, a few radio buttons to define which type of link should be inserted and a field asking for the URL or the id. The supported URL types are those who begins with: <code>http://</code>, <code>https://</code>, <code>ftp://</code>, or <code>www.</code>. The id must be an integer. If you didn't select any text, clicking on the URL button will popup a window asking for the link type (Web, Topic, Post, Forum, or User), the link label (optional) and the address.<br />
                        Esto es lo que debe ser similar: <code>[url=la_URL_que_introdujiste]La Etiqueta[/url]</code>.
                        </p>
                <h3 id="email_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/email.png" alt="E-mail" /> Botón de E-mail</h3>
                        <p>
                        If you selected text, before clicking on the E-mail button, this will be considered as the label of the link, you should then define the Address. You have to enter a valid E-mail address (containing a <code>@</code> and a <code>.</code>). If you didn't select any text, yopu must define both the E-mail address and the link label (optional).<br />
                        Esto es lo que debe ser similar: <code>[email=la_direccion@que_introdujiste]La etiqueta[/email]</code>.
                        </p>
                <h3 id="image_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/image.png" alt="Imagen" /> Botón de Imagen</h3>
                        <p>
                        If you selected text, before clicking on the Image button, you should see appear a window containing the alternative text (<code>alt</code> attribute in HTML language) and asking for the URL of the image. If nothing has been selected, you had to define both alternative text (optional) and Image URL.<br />
                        Esto es lo que debe ser similar: <code>[img=Your alt text]http://image_url.en[/img]</code>.
                        </p>
                <h3>Summary</h3>
                        <table>
                                <tbody>
                                        <tr>
                                        <th>Botones</th>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/link.png" alt="URL" /></td>
										<td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/link.png" alt="Topic, Post, Forum, or User" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/email.png" alt="E-mail" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/image.png" alt="Imagen" /></td>
                                        </tr>
                                        <tr>
                                        <th>Usar</th>
                                        <td>Un Enlace Web</td>
										<td>A Topic, Post, Forum, or User link</td>
                                        <td>Un Enlace E-mail</td>
                                        <td>Una imagen</td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas BBCode</th>
                                        <td><code>[url=http://website.com]…[/url]</code></td>
										<td><code>[topic=id]…[/topic], [post=id]…[/post], [forum=id]…[/forum], [user=id]…[/user]</code></td>
                                        <td><code>[email=your_email@somewhere.com]…[/email]</code></td>
                                        <td><code>[img=Texto alternativo]…[/img]</code></td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas HTML</th>
                                        <td><code>&lt;a href="http://…"&gt;…&lt;/a&gt;</code></td>
										<td><code>&lt;a href="http://…"&gt;…&lt;/a&gt;</code></td>
                                        <td><code>&lt;a href="mailto:…"&gt;…&lt;/a&gt;</code></td>
                                        <td><code>&lt;img src="…" alt="…" /&gt;</code></td>
                                        </tr>
                                </tbody>
                        </table>
        
        <h2>Botones de Código y Citar</h2>
                <h3 id="quote_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/quote.png" alt="Quote" /> Botón Citar</h3>
                        <p>
                        In the popup window that appears you can set the author (optional) of the quotation and the text you want to cite. If something was selected before clicking on the quote button, the selected text will be added to the code textarea of the popup window.<br />
                        Esto es lo que debe ser similar:<br />
                        <code>[quote=Nombre autor]<br />
                        Citado<br />
                        [/quote]</code>
                        </p>
                <h3 id="code_button"><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/code.png" alt="Código" /> Botón de Código</h3>
                        <p>
                        The popup window that appears when clicking on that button provides a dropdown menu where you can choose the language (php, html, Javascript… - optional) and a textarea for pasting the code lines you want to insert. If something was selected before clicking on that button, it will be considered as the code.<br />
                        Esto es como debe verse:<br />
                        <code>[code]<br />
                        [== idioma ==]<br />
                        Código<br />
                        [/code]</code>
                        </p>
                <h3>Sumario</h3>
                        <table>
                                <tbody>
                                        <tr>
                                        <th>Botones</th>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/quote.png" alt="Citar" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/code.png" alt="Código" /></td>
                                        </tr>
                                        <tr>
                                        <th>Usar</th>
                                        <td>Citar</td>
                                        <td>Código</td>
                                        </tr>
                                        <tr>
                                        <th>Etiquets BBCode</th>
                                        <td><code>[quote=Nombre del autor]…[/quote]</code></td>
                                        <td><code>[code]…[/code]</code></td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas HTML</th>
                                        <td><code>&lt;blockquote&gt;…&lt;/blockquote&gt;</code></td>
                                        <td><code>&lt;pre&gt;&lt;code&gt;…&lt;/code&gt;&lt;/pre&gt;</code></td>
                                        </tr>
                                </tbody>
                        </table>
        
        <h2 id="list_buttons">Botones de Lista</h2>
                <h3>Use</h3>
                        <p>
                        Si ha seleccionado varias líneas y pulsó en un botón de la lista, cada línea será considerada como un elemento de la lista. Por ejemplo, si ha seleccionado 3 líneas, obtendrá una lista con 3 elementos. If you didn't select anything, a prompt will popup and ask you for the first item of the list. You can then add more items by clicking on the "Add an item" link or by pressing the "enter" key. When finished, validate the list by clicking on the right button (the fields left blank will be ignored).
                        </p>
                <h3>Sumario</h3>
                        <table>
                                <tbody>
                                        <tr>
                                        <th>Botones</th>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/list-unordered.png" alt="Lista desordenada" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/list-ordered.png" alt="Lista ordenada" /></td>
                                        <td><img class="button" src="../../style/<?php echo $ezbbc_style_folder ?>/images/list-ordered-alpha.png" alt="Lista ordenada alfabeticamente" />										</td>
                                        </tr>
                                        <tr>
                                        <th>Usar</th>
                                        <td>Una lista desordenada</td>
                                        <td>Una lista ordenada</td>
                                        <td>Una lista ordenada alfabeticamente</td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas BBCode</th>
                                        <td style="text-align: left;"><code>[list=*]<br />[*]…[/*]<br />[*]…[/*]<br />[*]…[/*]<br />[/list]</code></td>
                                        <td style="text-align: left;"><code>[list=1]<br />[*]…[/*]<br />[*]…[/*]<br />[*]…[/*]<br />[/list]</code></td>
                                        <td style="text-align: left;"><code>[list=a]<br />[*]…[/*]<br />[*]…[/*]<br />[*]…[/*]<br />[/list]</code></td>
                                        </tr>
                                        <tr>
                                        <th>Etiquetas HTML</th>
                                        <td style="text-align: left;"><code>&lt;ul&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;/ul&gt;</code></td>
                                        <td style="text-align: left;"><code>&lt;ol&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;/ol&gt;</code></td>
                                        <td style="text-align: left;"><code>&lt;ol type="a"&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;li&gt;…&lt;/li&gt;<br />&lt;/ol&gt;</code></td>
                                        </tr>
                                </tbody>
                        </table>

         <h2 id="smilies">Emoticón</h2>
                <table>
                                <tbody>
                                        <tr>
                                        <th>BBCode</th>
                                        <td><code>:)</code><br />o<br /><code>=)</code></td>
                                        <td><code>:|</code><br />o<br /><code>=)</code></td>
                                        <td><code>:(</code><br />o<br /><code>=(</code></td>
                                        <td><code>:D</code><br />o<br /><code>=D</code></td>
                                        <td><code>:o</code><br />o<br /><code>:O</code></td>
                                        <td><code>;)</code></td>
                                        <td><code>:/</code></td>
                                        <td><code>:P</code><br />r<br /><code>:p</code></td>
                                        <td><code>:lol:</code></td>
                                        <td><code>:mad:</code></td>
                                        <td><code>:rolleyes:</code></td>
                                        <td><code>:cool:</code></td>
                                        </tr>
                                        <tr>
                                        <th>FluxBB emoticones por defecto</th>
                                        <td><img src="../../../../img/smilies/smile.png" alt=":)" /></td>
                                        <td><img src="../../../../img/smilies/neutral.png" alt=":|" /></td>
                                        <td><img src="../../../../img/smilies/sad.png" alt=":(" /></td>
                                        <td><img src="../../../../img/smilies/big_smile.png" alt=":D" /></td>
                                        <td><img src="../../../../img/smilies/yikes.png" alt=":o" /></td>
                                        <td><img src="../../../../img/smilies/wink.png" alt=";)" /></td>
                                        <td><img src="../../../../img/smilies/hmm.png" alt=":/" /></td>
                                        <td><img src="../../../../img/smilies/tongue.png" alt=":P" /></td>
                                        <td><img src="../../../../img/smilies/lol.png" alt=":lol:" /></td>
                                        <td><img src="../../../../img/smilies/mad.png" alt=":mad:" /></td>
                                        <td><img src="../../../../img/smilies/roll.png" alt=":rolleyes:" /></td>
                                        <td><img src="../../../../img/smilies/cool.png" alt=":cool:" /></td>
                                        </tr>
                                        <tr>
                                         <th>EZBBC emoticones personalizados</th>
                                        <td><img src="../../style/smilies/smile.png" alt=":)" /></td>
                                        <td><img src="../../style/smilies/neutral.png" alt=":|" /></td>
                                        <td><img src="../../style/smilies/sad.png" alt=":(" /></td>
                                        <td><img src="../../style/smilies/big_smile.png" alt=":D" /></td>
                                        <td><img src="../../style/smilies/yikes.png" alt=":o" /></td>
                                        <td><img src="../../style/smilies/wink.png" alt=";)" /></td>
                                        <td><img src="../../style/smilies/hmm.png" alt=":/" /></td>
                                        <td><img src="../../style/smilies/tongue.png" alt=":P" /></td>
                                        <td><img src="../../style/smilies/lol.png" alt=":lol:" /></td>
                                        <td><img src="../../style/smilies/mad.png" alt=":mad:" /></td>
                                        <td><img src="../../style/smilies/roll.png" alt=":rolleyes:" /></td>
                                        <td><img src="../../style/smilies/cool.png" alt=":cool:" /></td>
                                        </tr>
                                        
                                </tbody>
                        </table>
                        
                        <table>
                                <tbody>
                                        <tr>
                                        <th>BBCode</th>
                                        <td><code>O:)</code><br />o<br /><code>:angel:</code></td> 
                                        <td><code>8.(</code><br />o<br /><code>:cry:</code></td> 
                                        <td><code>]:D</code><br />o<br /><code>:devil:</code></td> 
                                        <td><code>8)</code><br />o<br /><code>:glasses:</code></td>
                                        <td><code>{)</code><br />o<br /><code>:kiss:</code></td>
                                        <td><code>8o</code><br />o<br /><code>:monkey:</code></td> 
                                        <td><code>:8</code><br />o<br /><code>:ops:</code></td>
                                        </tr>
                                        <tr>
                                        <th>FluxBB emoticones por defecto</th>
                                        <td>O:)</td> 
                                        <td>8.(</td> 
                                        <td>]:D</td> 
                                        <td>8)</td>
                                        <td>{)</td>
                                        <td>8o</td> 
                                        <td>:8</td>
                                        </tr>
                                        <tr>
                                         <th>EZBBC emoticones personalizados</th>
                                        <td><img src="../../style/smilies/angel.png" alt="O:)" /></td> 
                                        <td><img src="../../style/smilies/cry.png" alt="8.(" /></td> 
                                        <td><img src="../../style/smilies/devil.png" alt="]:D" /></td>
                                        <td><img src="../../style/smilies/glasses.png" alt="8)" /></td>
                                        <td><img src="../../style/smilies/kiss.png" alt="{)" /></td>
                                        <td><img src="../../style/smilies/monkey.png" alt="8o" /></td> 
                                        <td><img src="../../style/smilies/ops.png" alt=":8" /></td>
                                        </tr>
                                        
                                </tbody>
                        </table>
</div>
</div>
</div>
</div>
</body>
</html>
