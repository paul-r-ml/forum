<?php
define('PUN_ROOT', '../../');
require PUN_ROOT.'include/common.php';
// Retrieving style folder
$config_content = trim(file_get_contents(PUN_ROOT.'plugins/ezbbc/config.txt'));
$config_item = explode(";", $config_content);
$ezbbc_style_folder = $config_item[2];
// Getting the textarea name from get string
$textarea_name = pun_htmlspecialchars($_GET['textarea_name']);
// Language file load
$ezbbc_language_folder = (file_exists(PUN_ROOT.'plugins/ezbbc/lang/'.$pun_user['language'].'/ezbbc_plugin.php')) ? $pun_user['language'] : 'English';    
require PUN_ROOT.'plugins/ezbbc/lang/'.$ezbbc_language_folder.'/ezbbc_plugin.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title><?php echo $lang_ezbbc['EZBBC Link chooser'] ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php echo PUN_ROOT.'style/'.$pun_user['style'].'.css' ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo PUN_ROOT.'plugins/ezbbc/style/'.$ezbbc_style_folder.'/ezbbc.css' ?>" />
	<!-- Adding JS function to send the link value to the opener -->
	<script type="text/javascript">
	/* <![CDATA[ */
	// Function to display the form matching the link type
	function lVisibility() {
		var webForm = document.getElementById('cweb');
		var idForm = document.getElementById('cid');
		if (document.linkform.radiolink[0].checked) {
			webForm.style.display = "block";
			document.linkform.web_link.focus();
		} else {
			webForm.style.display = "none";
		}
		if (document.linkform.radiolink[1].checked || document.linkform.radiolink[2].checked || document.linkform.radiolink[3].checked || document.linkform.radiolink[4].checked) {
			idForm.style.display = "block";
			document.linkform.id_link.focus();
		} else {
			idForm.style.display = "none";
		}
	}
	// Function to retrieve the selection in opener and add it to the right field    
	function getSelection() {
        var field  = window.opener.document.getElementsByName('<?php echo $textarea_name ?>')[0]; 
        var scroll = field.scrollTop;
        field.focus();
        /* get the selection */
        if (window.ActiveXObject) { //For IE
                var textRange = window.opener.document.selection.createRange();
                var currentSelection = textRange.text;
        } else { //For other browsers
                var startSelection   = field.value.substring(0, field.selectionStart);
                var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
                var endSelection     = field.value.substring(field.selectionEnd);
        }
        /* Add the selection to the label field */
		document.linkform.link_label.value = currentSelection;
		document.linkform.web_link.focus(); // Focus forthe URL field
	}
	// Function to insert The linktags and selection in opener Window
	function insertLinkTag() {
        var field  = window.opener.document.getElementsByName('<?php echo $textarea_name ?>')[0]; 
        var scroll = field.scrollTop;
        field.focus();
        
        
        /* === Part 1: get the selection === */
        if (window.ActiveXObject) { //For IE
                var textRange = window.opener.document.selection.createRange();
                var currentSelection = textRange.text;
        } else { //For other browsers
                var startSelection   = field.value.substring(0, field.selectionStart);
                var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
                var endSelection     = field.value.substring(field.selectionEnd);
        }
		
        
        /* === Part 2: what Tag type ? === */
		var startTag = endTag = '';
		var exp = new RegExp("^[0-9]*$","g");
		var label = document.linkform.link_label.value;
		// Treating each link case (url, topic, post, forum, user, links)
        if (document.linkform.radiolink[0].checked) { //url
				var url = document.linkform.web_link.value;
				if (label != '') { //A label has been entered
       				if (url.indexOf('http://') == 0 || url.indexOf('https://') == 0 || url.indexOf('ftp://') == 0 || url.indexOf('www.') == 0) {
       				    startTag = '[url=' + url + ']';
						currentSelection = label;
						endTag = '[/url]';
       				} else {
       				    alert("<?php echo $lang_ezbbc['Invalid url'] ?>");
						document.linkform.web_link.focus();
						return false;
       				}
       			} else { //No label entered
       				if (url.indexOf('http://') == 0 || url.indexOf('https://') == 0 || url.indexOf('ftp://') == 0 || url.indexOf('www.') == 0) {
       				    startTag = '[url=' + url + ']';
						currentSelection = url;
						endTag = '[/url]';
       				} else {
       				    alert("<?php echo $lang_ezbbc['Invalid url'] ?>");
						document.linkform.web_link.focus();
						return false;
       				}
       			}
		}
			
		if (document.linkform.radiolink[1].checked) { //topic
			var id = document.linkform.id_link.value;
			if (label != '') { //A label has been entered
				if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[topic=' + id + ']';
					currentSelection = label;
					endTag = '[/topic]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
       		} else { //No label entered
       			if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[topic]';
					currentSelection = id;
					endTag = '[/topic]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
			}
		}
			
		if (document.linkform.radiolink[2].checked) { //post
			var id = document.linkform.id_link.value;
			if (label != '') { //A label has been entered
				if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[post=' + id + ']';
					currentSelection = label;
					endTag = '[/post]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
       		} else { //No label entered
       			if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[post]';
					currentSelection = id;
					endTag = '[/post]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
			}
		}
			
		if (document.linkform.radiolink[3].checked) { //forum
			var id = document.linkform.id_link.value;
			if (label != '') { //A label has been entered
				if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[forum=' + id + ']';
					currentSelection = label;
					endTag = '[/forum]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
       		} else { //No label entered
       			if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[forum]';
					currentSelection = id;
					endTag = '[/forum]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
			}
		}
			
		if (document.linkform.radiolink[4].checked) { //user
			var id = document.linkform.id_link.value;
			if (label != '') { //A label has been entered
				if (exp.test(id) && id > 0) { // Is the id a numerical value > 0?
       				startTag = '[user=' + id + ']';
					currentSelection = label;
					endTag = '[/user]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
       		} else { //No label entered
       			if (exp.test(id) && id > 0) { // Is the id a numerical value >0?
       				startTag = '[user]';
					currentSelection = id;
					endTag = '[/user]';
       			} else {
       				alert("<?php echo $lang_ezbbc['Invalid id'] ?>");
					document.linkform.id_link.focus();
					return false;
       			}
			}
		}
        		
        /* === Part 3: adding what was produced to the opener === */
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
		self.close();		
	}
	/* ]]> */
	</script>
</head>
<body onload="getSelection();">
<div class="pun">
	<div class="punwrap">
		<div id="brdmain">
			<div id="ezbbclink">
				<form name="linkform">
				<p>
					<?php echo $lang_ezbbc['Ask url type'] ?><br />
					<input type="radio" value="web" name="radiolink" checked="checked" onclick="lVisibility()" /><?php echo $lang_ezbbc['Web link'] ?>
					<input type="radio" value="topic" name="radiolink" onclick="lVisibility()" /><?php echo $lang_ezbbc['Topic link'] ?>
					<input type="radio" value="post" name="radiolink" onclick="lVisibility()" /><?php echo $lang_ezbbc['Post link'] ?> 
					<input type="radio" value="forum" name="radiolink" onclick="lVisibility()" /><?php echo $lang_ezbbc['Forum link'] ?> 
					<input type="radio" value="user" name="radiolink" onclick="lVisibility()" /><?php echo $lang_ezbbc['User link'] ?>
				</p>
				<p>
				<?php echo $lang_ezbbc['Ask label'] ?><br />
					<input type="text" name="link_label" size="45" />
					</p>
				<div id="cweb">
					<p>
					<?php echo $lang_ezbbc['Ask url'] ?><br />
					<input type="text" name="web_link" size="60" /><br />
					</p>
				</div>
				<div id="cid" style="display: none">
					<p>
					<?php echo $lang_ezbbc['Ask id'] ?><br />
					<input type="text" name="id_link" size="5" /><br />
					</p>
				</div>
					<p class="buttons"><input type="button" value="<?php echo $lang_ezbbc['OK'] ?>" onclick="insertLinkTag()" /> <input type="button" value="<?php echo $lang_ezbbc['Cancel'] ?>" onclick="self.close()" /></p>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
