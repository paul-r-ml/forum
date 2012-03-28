<?php
// Integration of EZBBC Toolbar script only in the pages containing the req_message textarea and in the profile page
$section = isset($_GET['section']) ? $_GET['section'] : null;
if ((isset($required_fields['req_message']) && basename($_SERVER['PHP_SELF']) != 'misc.php') || ($section == 'personality' && $pun_config['o_signatures'] == '1')):

// Language file load
$ezbbc_language_folder = (file_exists(PUN_ROOT.'plugins/ezbbc/lang/'.$pun_user['language'].'/ezbbc_plugin.php')) ? $pun_user['language'] : 'English';    
require PUN_ROOT.'plugins/ezbbc/lang/'.$ezbbc_language_folder.'/ezbbc_plugin.php';

// Retrieving help file
$ezbbc_help_folder = (file_exists(PUN_ROOT.'plugins/ezbbc/lang/'.$ezbbc_language_folder.'/help.php')) ? $ezbbc_language_folder : 'English';
$help_file_path = 'plugins/ezbbc/lang/'.$ezbbc_help_folder.'/help.php';

// Retrieving style folder and smilies set
$config_content = trim(file_get_contents(PUN_ROOT.'plugins/ezbbc/config.txt'));
$config_item = explode(";", $config_content);
$ezbbc_style_folder = $config_item[2];
$ezbbc_smilies_set = $config_item[3];
$smilies_path = ($ezbbc_smilies_set == 'fluxbb_default_smilies') ? 'img/smilies/' : 'plugins/ezbbc/style/smilies/'; 
$plugin_folder = 'plugins/ezbbc/';

// Identifying the name of the current page textatera
$textarea_name = (PUN_ACTIVE_PAGE == 'profile') ? 'signature' : 'req_message';
?>
<!-- EZBBC Toolbar integration -->
<link rel="stylesheet" type="text/css" href="plugins/ezbbc/style/<?php echo $ezbbc_style_folder ?>/ezbbc.css" />
<script type="text/javascript">
/* <![CDATA[ */
// Preloading the smilies images
var preload = ( function ( ) {
	var images = [ ];
	function preload( ) {
		var i = arguments.length,
		image;
		while ( i-- ) {
			image = new Image;
			images.src = arguments[ i ];
			images.push( image );
		}
	}
	return preload;
}( ) );
<?php if ($ezbbc_smilies_set == 'ezbbc_smilies'): ?>
preload(
	"<?php echo $smilies_path ?>smile.png",
    "<?php echo $smilies_path ?>neutral.png",
    "<?php echo $smilies_path ?>sad.png",
    "<?php echo $smilies_path ?>big_smile.png",
    "<?php echo $smilies_path ?>yikes.png",
    "<?php echo $smilies_path ?>wink.png",
    "<?php echo $smilies_path ?>hmm.png",
    "<?php echo $smilies_path ?>tongue.png",
    "<?php echo $smilies_path ?>lol.png",
    "<?php echo $smilies_path ?>mad.png",
    "<?php echo $smilies_path ?>roll.png",
    "<?php echo $smilies_path ?>cool.png",
	"<?php echo $smilies_path ?>angel.png",
    "<?php echo $smilies_path ?>cry.png",
    "<?php echo $smilies_path ?>devil.png",
    "<?php echo $smilies_path ?>glasses.png",
    "<?php echo $smilies_path ?>kiss.png",
    "<?php echo $smilies_path ?>monkey.png",
    "<?php echo $smilies_path ?>ops.png"
);
<?php else: ?>
preload(
	"<?php echo $smilies_path ?>smile.png",
    "<?php echo $smilies_path ?>neutral.png",
    "<?php echo $smilies_path ?>sad.png",
    "<?php echo $smilies_path ?>big_smile.png",
    "<?php echo $smilies_path ?>yikes.png",
    "<?php echo $smilies_path ?>wink.png",
    "<?php echo $smilies_path ?>hmm.png",
    "<?php echo $smilies_path ?>tongue.png",
    "<?php echo $smilies_path ?>lol.png",
    "<?php echo $smilies_path ?>mad.png",
    "<?php echo $smilies_path ?>roll.png",
    "<?php echo $smilies_path ?>cool.png"
);
<?php endif; ?>
// Function to insert the tags in the textarea       
function insertTag(startTag, endTag, tagType) {
        var field  = document.getElementsByName('<?php echo $textarea_name ?>')[0]; 
        var scroll = field.scrollTop;
        field.focus();
        
        
        /* === Part 1: get the selection === */
        if (window.ActiveXObject) { //For IE
                var textRange = document.selection.createRange();
                var currentSelection = textRange.text;
        } else { //For other browsers
                var startSelection   = field.value.substring(0, field.selectionStart);
                var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
                var endSelection     = field.value.substring(field.selectionEnd);
        }
        
        /* === Part 2: what Tag type ? === */
        if (tagType) {
                switch (tagType) {
					case "smiley":
       		            if (window.ActiveXObject) { //For IE
       		                //Calculating the start point of the selection
	                        var storedRange = textRange.duplicate();
	                        storedRange.moveToElementText(field);
	                        storedRange.setEndPoint('EndToEnd', textRange);
	                        field.selectionStart = storedRange.text.length - currentSelection.length;
                            if (field.selectionStart == 0) { //We are at the beginning of the textarea
       		                    startTag = ' ' + startTag + ' ';
       		                    currentSelection = '';
							} else { //We are not at the beginning of the textarea, extending the text selection to handle the previous and next character
       		                    textRange.moveStart('character', -1);
       		                    textRange.moveEnd('character');
       		                    textRange.select();
       		                    currentSelection = textRange.text;
       		                    if (currentSelection.length == 1) { //Case caret at the end of a line
       		                        startTag = currentSelection + ' ' + startTag + '\n';
       		                        currentSelection = '';
       		                    }
       		                }
       		                       
       		            } else { //For other browsers
       		                if (startSelection.length == 0) { //Looking if we are at the beginning of the textarea
       		                    startTag = ' ' + startTag + ' ';
       		                    currentSelection = '';
       		                } else { //Textarea not empty, extending the text selection to handle the previous and next character
       		                    field.setSelectionRange(startSelection.length -1, startSelection.length + currentSelection.length +1);
       		                    startSelection = field.value.substring(0, field.selectionStart);
       		                    currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
       		                    endSelection = field.value.substring(field.selectionEnd);
       		                    if (currentSelection.length == 1) { //Case at the end of a line
       		                        startTag = currentSelection + ' ' + startTag + ' ';
       		                        currentSelection = '';
       		                    }
       		                }
       		            }
       		                       
       		            //Common situations for all browsers
       		            if (currentSelection.length >= 2) {
							//To ease checking, variable definition
       		                var charBefore = currentSelection.substr(0,1);
       		                var charAfter = currentSelection.substr(currentSelection.length-1,1);
       		                //Parsing and treating the new selection
       		                if (charBefore != ' ' && charAfter != ' ') {
       		                    //Adding a space before and after the smiley
       		                    startTag = charBefore + ' ' + startTag + ' ';
       		                    endTag = charAfter;
       		                } else if (charBefore != ' ') {
       		                    //Adding a space before the smiley
       		                    startTag = charBefore + ' ' + startTag + ' ';
       		                } else if (charAfter != ' ') {
       		                    //Adding a space after the smiley
       		                    currentSelection = startTag;
       		                    startTag = ' ' + startTag + ' ';
       		                    endTag = charAfter;
       		                } else {
       		                    startTag = ' ' + starTag + ' ';
       		                }
       		                currentSelection = '';
       		            } 
					break;
				}
        }
        
        /* === Part 3: adding what was produced === */
        if (window.ActiveXObject) { //For IE
                textRange.text = startTag + currentSelection + endTag;
                textRange.moveStart('character', -endTag.length - currentSelection.length);
                textRange.moveEnd('character', -endTag.length);
                textRange.select();     
        } else { //For other browsers
                field.value = startSelection + startTag + currentSelection + endTag + endSelection;
                field.focus();
                field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
        } 
		field.scrollTop = scroll;
		
}
//Function to make an element with a certain id visible or not
function ezbbcVisibility(id) {
	var element = document.getElementById(id);
	if (element.style.display == "none") {
		element.style.display = "inline";
	} else {
		element.style.display = "none";
	}
}
		
//Function to create the Toolbar
function doToolbar() {
        var toolbar = '';
// Toolbar for common textareas
<?php if ($textarea_name == 'req_message'): ?>
  <?php if ($pun_config['o_smilies'] == '1'): ?>
        // Smileys
        toolbar += '<span id="ezbbc_s">';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>smile.png" title=":)" alt=":)" onclick="insertTag(\':)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>neutral.png" title=":|" alt=":|" onclick="insertTag(\':|\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>sad.png" title=":(" alt=":(" onclick="insertTag(\':(\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>big_smile.png" title=":D" alt=":D" onclick="insertTag(\':D\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>yikes.png" title=":o" alt=":o" onclick="insertTag(\':o\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>wink.png" title=";)" alt=";)" onclick="insertTag(\';)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>hmm.png" title=":/" alt=":/" onclick="insertTag(\':/\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>tongue.png" title=":p" alt=":p" onclick="insertTag(\':p\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>lol.png" title=":lol:" alt=":lol:" onclick="insertTag(\':lol:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>mad.png" title=":mad:" alt=":mad:" onclick="insertTag(\':mad:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>roll.png" title=":rolleyes:" alt=":rolleyes:" onclick="insertTag(\':rolleyes:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>cool.png" title=":cool:" alt=":cool:" onclick="insertTag(\':cool:\',\'\',\'smiley\'); return false;" />';
    <?php if ($ezbbc_smilies_set == 'ezbbc_smilies'): ?>
    // Additional smilies if ezbbc smilies enabled
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>angel.png" title="O:)" alt="O:)" onclick="insertTag(\'O:)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>cry.png" title="8.(" alt="8.(" onclick="insertTag(\'8.(\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>devil.png" title="]:D" alt="]:D" onclick="insertTag(\']:D\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>glasses.png" title="8)" alt="8)" onclick="insertTag(\'8)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>kiss.png" title="{)" alt="{)" onclick="insertTag(\'{)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>monkey.png" title="8o" alt="8o" onclick="insertTag(\'8o\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>ops.png" title=":8" alt=":8" onclick="insertTag(\':8\',\'\',\'smiley\'); return false;" />';
    <?php endif; ?>
	toolbar += '<\/span>';
	toolbar += '<br />';
  <?php endif; ?>  
  
  <?php if ($pun_config['p_message_bbcode'] == '1'): ?>
  // if BBcode enabled
	// Text style
	toolbar += '<a href="#" id="bold" title="<?php echo $lang_ezbbc['Bold'] ?>"  onclick="insertTag(\'[b]\',\'[/b]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Bold'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="underline" title="<?php echo $lang_ezbbc['Underline'] ?>" onclick="insertTag(\'[u]\',\'[/u]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Underline'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="italic" title="<?php echo $lang_ezbbc['Italic'] ?>" onclick="insertTag(\'[i]\',\'[/i]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Italic'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="strike" title="<?php echo $lang_ezbbc['Strike-through'] ?>" onclick="insertTag(\'[s]\',\'[/s]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Strike-through'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="delete" title="<?php echo $lang_ezbbc['Delete'] ?>" onclick="insertTag(\'[del]\',\'[/del]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Delete'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="insert" title="<?php echo $lang_ezbbc['Insert'] ?>" onclick="insertTag(\'[ins]\',\'[/ins]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Insert'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="emphasis"  title="<?php echo $lang_ezbbc['Emphasis'] ?>" onclick="insertTag(\'[em]\',\'[/em]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Emphasis'] ?>\/span><\/a>';

	// Color and heading
	toolbar += '<a href="#" id="color"  title="<?php echo $lang_ezbbc['Colorize'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>colorpicker.php?textarea_name=<?php echo $textarea_name ?>\', \'Colorpicker\', \'height=400, width=400, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Colorize'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="heading" title="<?php echo $lang_ezbbc['Heading'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>heading.php?textarea_name=<?php echo $textarea_name ?>\', \'Header\', \'height=220, width=500, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Heading'] ?>\/span><\/a>';

	// Links and images
	toolbar += '<a href="#" id="url" title="<?php echo $lang_ezbbc['URL'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>link.php?textarea_name=<?php echo $textarea_name ?>\', \'Link\', \'height=350, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['URL'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="email" title="<?php echo $lang_ezbbc['E-mail'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>email.php?textarea_name=<?php echo $textarea_name ?>\', \'Email\', \'height=300, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['E-mail'] ?>\/span><\/a>';
    
    <?php if ($pun_config['p_message_img_tag'] == '1'): ?>
    // if image tag enabled
	toolbar += '<a href="#" id="image" title="<?php echo $lang_ezbbc['Image'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>image.php?textarea_name=<?php echo $textarea_name ?>\', \'Image\', \'height=300, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Image'] ?>\/span><\/a>';
    <?php endif; ?>
	toolbar += '&#160;';

	// Quote and code
	toolbar += '<a href="#" id="quote" title="<?php echo $lang_ezbbc['Quote'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>quote.php?textarea_name=<?php echo $textarea_name ?>\', \'Quote\', \'height=450, width=750, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Quote'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="code" title="<?php echo $lang_ezbbc['Code'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>code.php?textarea_name=<?php echo $textarea_name ?>\', \'Code\', \'height=450, width=750, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Code'] ?>\/span><\/a>';

	// Lists
	toolbar += '<a href="#" id="ulist" title="<?php echo $lang_ezbbc['Unordered List'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>list.php?textarea_name=<?php echo $textarea_name ?>&amp;list_type=*\', \'List\', \'height=350, width=600, top=100, left=100, toolbar=yes, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Unordered List'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="olist" title="<?php echo $lang_ezbbc['Ordered List'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>list.php?textarea_name=<?php echo $textarea_name ?>&amp;list_type=1\', \'List\', \'height=350, width=620, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Ordered List'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="aolist" title="<?php echo $lang_ezbbc['Alphabetical Ordered List'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>list.php?textarea_name=<?php echo $textarea_name ?>&amp;list_type=a\', \'List\', \'height=350, width=620, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Alphabetical Ordered List'] ?>\/span><\/a>';
  <?php endif; ?>
  // End if BBCode enabled
  
   <?php if ($pun_config['o_smilies'] == '1'): ?>
        // Smilies button
	toolbar += '<a href="#" id="smiliesb" title="<?php echo $lang_ezbbc['Smilies toggle'] ?>" onclick="ezbbcVisibility(\'ezbbc_s\'); return false;"><span<?php echo $lang_ezbbc['Smilies toggle'] ?>\/span><\/a>';
  <?php endif; ?>
  <?php if ($pun_config['o_smilies'] == '1' || $pun_config['p_message_bbcode'] == '1'): ?>
	// Help link
	toolbar += '<a href="#" id="help" title="<?php echo $lang_ezbbc['Toolbar help'] ?>" onclick="window.open(\'<?php echo $help_file_path ?>\', \'Toolbar_help\', \'height=400, width=750, top=50, left=50, toolbar=yes, menubar=yes, location=no, resizable=yes, scrollbars=yes, status=no\'); return false;"><span<?php echo $lang_ezbbc['Toolbar help'] ?>\/span><\/a>';
	
	toolbar += '<br />';
  <?php endif; ?>
// End Toolbar for common teaxtareas
<?php endif; ?>

<?php if ($textarea_name == 'signature'): ?>
// Toolbar for signature textarea
  <?php if ($pun_config['o_smilies_sig'] == '1'): ?>
        // Smileys
        toolbar += '<span id="ezbbc_s" style="display: none;">';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>smile.png" title=":)" alt=":)" onclick="insertTag(\':)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>neutral.png" title=":|" alt=":|" onclick="insertTag(\':|\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>sad.png" title=":(" alt=":(" onclick="insertTag(\':(\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>big_smile.png" title=":D" alt=":D" onclick="insertTag(\':D\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>yikes.png" title=":o" alt=":o" onclick="insertTag(\':o\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>wink.png" title=";)" alt=";)" onclick="insertTag(\';)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>hmm.png" title=":/" alt=":/" onclick="insertTag(\':/\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>tongue.png" title=":p" alt=":p" onclick="insertTag(\':p\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>lol.png" title=":lol:" alt=":lol:" onclick="insertTag(\':lol:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>mad.png" title=":mad:" alt=":mad:" onclick="insertTag(\':mad:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>roll.png" title=":rolleyes:" alt=":rolleyes:" onclick="insertTag(\':rolleyes:\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>cool.png" title=":cool:" alt=":cool:" onclick="insertTag(\':cool:\',\'\',\'smiley\'); return false;" />';
    <?php if ($ezbbc_smilies_set == 'ezbbc_smilies'): ?>
        // Additional smilies if ezbbc smilies enabled
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>angel.png" title="O:)" alt="O:)" onclick="insertTag(\'O:)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>cry.png" title="8.(" alt="8.(" onclick="insertTag(\'8.(\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>devil.png" title="]:D" alt="]:D" onclick="insertTag(\']:D\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>glasses.png" title="8)" alt="8)" onclick="insertTag(\'8)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>kiss.png" title="{)" alt="{)" onclick="insertTag(\'{)\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>monkey.png" title="8o" alt="8o" onclick="insertTag(\'8o\',\'\',\'smiley\'); return false;" />';
        toolbar += '<img class="smiley" src="<?php echo $smilies_path ?>ops.png" title=":8" alt=":8" onclick="insertTag(\':8\',\'\',\'smiley\'); return false;" />';
    <?php endif; ?>
	toolbar += '<\/span>';
	toolbar += '<br />';
  <?php endif; ?>
  
  <?php if ($pun_config['p_sig_bbcode'] == '1'): ?>
  // if BBcode enabled
	// Text style
	toolbar += '<a href="#" id="bold" title="<?php echo $lang_ezbbc['Bold'] ?>"  onclick="insertTag(\'[b]\',\'[/b]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Bold'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="underline" title="<?php echo $lang_ezbbc['Underline'] ?>" onclick="insertTag(\'[u]\',\'[/u]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Underline'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="italic" title="<?php echo $lang_ezbbc['Italic'] ?>" onclick="insertTag(\'[i]\',\'[/i]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Italic'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="strike" title="<?php echo $lang_ezbbc['Strike-through'] ?>" onclick="insertTag(\'[s]\',\'[/s]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Strike-through'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="delete" title="<?php echo $lang_ezbbc['Delete'] ?>" onclick="insertTag(\'[del]\',\'[/del]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Delete'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="insert" title="<?php echo $lang_ezbbc['Insert'] ?>" onclick="insertTag(\'[ins]\',\'[/ins]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Insert'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="emphasis"  title="<?php echo $lang_ezbbc['Emphasis'] ?>" onclick="insertTag(\'[em]\',\'[/em]\',\'\'); return false;"><span<?php echo $lang_ezbbc['Emphasis'] ?>\/span><\/a>';

	// Color
	toolbar += '<a href="#" id="color"  title="<?php echo $lang_ezbbc['Colorize'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>colorpicker.php?textarea_name=<?php echo $textarea_name ?>\', \'Colorpicker\', \'height=400, width=400, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Colorize'] ?>\/span><\/a>';

	// Links and images
	toolbar += '<a href="#" id="url" title="<?php echo $lang_ezbbc['URL'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>link.php?textarea_name=<?php echo $textarea_name ?>\', \'Link\', \'height=350, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['URL'] ?>\/span><\/a>';
	toolbar += '<a href="#" id="email" title="<?php echo $lang_ezbbc['E-mail'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>email.php?textarea_name=<?php echo $textarea_name ?>\', \'Email\', \'height=300, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['E-mail'] ?>\/span><\/a>';
    // if image tag enabled
    <?php if ($pun_config['p_sig_img_tag'] == '1'): ?>
	toolbar += '<a href="#" id="image" title="<?php echo $lang_ezbbc['Image'] ?>" onclick="window.open(\'<?php echo $plugin_folder ?>image.php?textarea_name=<?php echo $textarea_name ?>\', \'Image\', \'height=300, width=600, top=100, left=100, toolbar=no, menubar=no, location=no, resizable=yes, scrollbars=no, status=no\'); return false;"><span<?php echo $lang_ezbbc['Image'] ?>\/span><\/a>';
    <?php endif; ?>
  // End if BBCode enabled
  <?php endif; ?>
  
  <?php if ($pun_config['o_smilies_sig'] == '1'): ?>
        //  smilies button
	toolbar += '<a href="#" id="smiliesb" title="<?php echo $lang_ezbbc['Smilies toggle'] ?>" onclick="ezbbcVisibility(\'ezbbc_s\'); return false;"><span<?php echo $lang_ezbbc['Smilies toggle'] ?>\/span><\/a>';
  <?php endif; ?>
  
  <?php if ($pun_config['o_smilies_sig'] == '1' || $pun_config['p_sig_bbcode'] == '1'): ?>
	// Help link
	toolbar += '<a href="#" id="help" title="<?php echo $lang_ezbbc['Toolbar help'] ?>" onclick="window.open(\'<?php echo $help_file_path ?>\', \'Toolbar_help\', \'height=400, width=750, top=50, left=50, toolbar=yes, menubar=yes, location=no, resizable=yes, scrollbars=yes, status=no\'); return false;"><span<?php echo $lang_ezbbc['Toolbar help'] ?>\/span><\/a>';
  <?php endif; ?>
// End for Signature textarea
<?php endif; ?>

// Returning the right Toolbar
	return toolbar;
}

//Adding the Toolbar on the right place
function addToolbar(){
    var textarea = document.getElementsByName('<?php echo $textarea_name ?>')[0];
	var span = document.createElement('span');
	span.setAttribute("id","ezbbctoolbar");
	span.setAttribute("idName","ezbbctoolbar"); /* For IE */
	span.innerHTML = doToolbar();
	var html = textarea.parentNode;
	html.insertBefore(span,textarea);
}
window.addEventListener?window.addEventListener('load',addToolbar,false):window.attachEvent('onload',addToolbar);
/* ]]> */
</script>
<!-- EZBBC Toolbar integration end -->
<?php endif; ?>