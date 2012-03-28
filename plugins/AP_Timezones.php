<?php

/** Timezones 1.0.1
* This plugin is used to modify users timezone and DST 
*
* Copyright (C) 2011 Nicolas BUTIN (nicolas.butin@gmail.com)
* License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
*/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);

// Load the prof_reg language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/prof_reg.php';

// Load the AP_Timezones language file (and test if a localized version exist)
if (file_exists(PUN_ROOT.'lang/'.$pun_user['language'].'/AP_Timezones.php'))
{
	require PUN_ROOT.'lang/'.$pun_user['language'].'/AP_Timezones.php';
}
else
{
	require PUN_ROOT.'lang/English/AP_Timezones.php';
}

// Check POST and perform actions
if (isset($_POST['to_hiver']) && isset($_POST['users']))
{
	$user_ids = is_array($_POST['users']) ? array_keys($_POST['users']) : explode(',', $_POST['users']);
	$user_ids = array_map('intval', $user_ids);
	$db->query('UPDATE '.$db->prefix.'users SET `dst`="0" WHERE `id` IN ('.implode(',', $user_ids).')') or error('Unable to update users', __FILE__, __LINE__, $db->error());
	redirect('admin_index.php', $lang_timezones['update_winter']);
}
elseif (isset($_POST['to_ete']) && isset($_POST['users']))
{
	$user_ids = is_array($_POST['users']) ? array_keys($_POST['users']) : explode(',', $_POST['users']);
	$user_ids = array_map('intval', $user_ids);
	$db->query('UPDATE '.$db->prefix.'users SET `dst`="1" WHERE `id` IN ('.implode(',', $user_ids).')') or error('Unable to update users', __FILE__, __LINE__, $db->error());
	redirect('admin_index.php', $lang_timezones['update_summer']);
}
elseif (isset($_POST['to_timezone']) && isset($_POST['sel_timezone']) && isset($_POST['users']))
{
	$user_ids = is_array($_POST['users']) ? array_keys($_POST['users']) : explode(',', $_POST['users']);
	$user_ids = array_map('intval', $user_ids);
	$db->query('UPDATE '.$db->prefix.'users SET `timezone`="'.$_POST['sel_timezone'].'" WHERE `id` IN ('.implode(',', $user_ids).')') or error('Unable to update users', __FILE__, __LINE__, $db->error());
	redirect('admin_index.php', $lang_timezones['update_timezone']);
}
else
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);
	
	// Initialize select timezone menu	
	if(isset($_POST['show_timezone']) && ($_POST['show_timezone'] != "all")) 
	{	
		$timezone_menu=$_POST['show_timezone']; 
	}
	else
	{
		$timezone_menu="all";
	}

	// Show list of users
	?>
	<script type="text/javascript" src="common.js"></script>
	<div id="email_listeur" class="blockform">
		<h2><span>Timezones 1.0</span></h2>
		<div class="box">
			<div class="inbox">
				<form id="search-timez-form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<input type="hidden" name="action" value="email" />
					<div class="inform"><br/><?php echo $lang_timezones['summary']; ?><br/><br/>
						<select name="show_timezone">
							<option value="all"<?php if ($timezone_menu == "all") echo ' selected="selected"'  ?>><?php echo $lang_timezones['select']; ?></option>
							<option value="-12"<?php if ($timezone_menu == -12) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-12:00'] ?></option>
							<option value="-11"<?php if ($timezone_menu == -11) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-11:00'] ?></option>
							<option value="-10"<?php if ($timezone_menu == -10) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-10:00'] ?></option>
							<option value="-9.5"<?php if ($timezone_menu == -9.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-09:30'] ?></option>
							<option value="-9"<?php if ($timezone_menu == -9) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-09:00'] ?></option>
							<option value="-8.5"<?php if ($timezone_menu == -8.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-08:30'] ?></option>
							<option value="-8"<?php if ($timezone_menu == -8) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-08:00'] ?></option>
							<option value="-7"<?php if ($timezone_menu == -7) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-07:00'] ?></option>
							<option value="-6"<?php if ($timezone_menu == -6) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-06:00'] ?></option>
							<option value="-5"<?php if ($timezone_menu == -5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-05:00'] ?></option>
							<option value="-4"<?php if ($timezone_menu == -4) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-04:00'] ?></option>
							<option value="-3.5"<?php if ($timezone_menu == -3.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-03:30'] ?></option>
							<option value="-3"<?php if ($timezone_menu == -3) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-03:00'] ?></option>
							<option value="-2"<?php if ($timezone_menu == -2) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-02:00'] ?></option>
							<option value="-1"<?php if ($timezone_menu == -1) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC-01:00'] ?></option>
							<option value="0"<?php if (($timezone_menu != "all")&&($timezone_menu == 0)) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC'] ?></option>
							<option value="1"<?php if ($timezone_menu == 1) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+01:00'] ?></option>
							<option value="2"<?php if ($timezone_menu == 2) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+02:00'] ?></option>
							<option value="3"<?php if ($timezone_menu == 3) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+03:00'] ?></option>
							<option value="3.5"<?php if ($timezone_menu == 3.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+03:30'] ?></option>
							<option value="4"<?php if ($timezone_menu == 4) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+04:00'] ?></option>
							<option value="4.5"<?php if ($timezone_menu == 4.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+04:30'] ?></option>
							<option value="5"<?php if ($timezone_menu == 5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+05:00'] ?></option>
							<option value="5.5"<?php if ($timezone_menu == 5.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+05:30'] ?></option>
							<option value="5.75"<?php if ($timezone_menu == 5.75) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+05:45'] ?></option>
							<option value="6"<?php if ($timezone_menu == 6) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+06:00'] ?></option>
							<option value="6.5"<?php if ($timezone_menu == 6.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+06:30'] ?></option>
							<option value="7"<?php if ($timezone_menu == 7) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+07:00'] ?></option>
							<option value="8"<?php if ($timezone_menu == 8) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+08:00'] ?></option>
							<option value="8.75"<?php if ($timezone_menu == 8.75) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+08:45'] ?></option>
							<option value="9"<?php if ($timezone_menu == 9) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+09:00'] ?></option>
							<option value="9.5"<?php if ($timezone_menu == 9.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+09:30'] ?></option>
							<option value="10"<?php if ($timezone_menu == 10) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+10:00'] ?></option>
							<option value="10.5"<?php if ($timezone_menu == 10.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+10:30'] ?></option>
							<option value="11"<?php if ($timezone_menu == 11) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+11:00'] ?></option>
							<option value="11.5"<?php if ($timezone_menu == 11.5) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+11:30'] ?></option>
							<option value="12"<?php if ($timezone_menu == 12) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+12:00'] ?></option>
							<option value="12.75"<?php if ($timezone_menu == 12.75) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+12:45'] ?></option>
							<option value="13"<?php if ($timezone_menu == 13) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+13:00'] ?></option>
							<option value="14"<?php if ($timezone_menu == 14) echo ' selected="selected"' ?>><?php echo $lang_prof_reg['UTC+14:00'] ?></option>
						</select>
						<input type="submit" name="to_show_timezone" value="<?php echo $lang_timezones['to_show_timezone']; ?>" /><br/><br/>
						<fieldset>						
							<legend><?php echo $lang_timezones['legend']; ?></legend>						
							<div class="infldset">
								<table class="aligntop" cellspacing="0">
									<tr>
										<?php echo "<td><b>".$lang_timezones['username']."</b></td><td><b>".$lang_timezones['lang']."</b></td><td><b>".$lang_timezones['loc']."</b></td><td><b>".$lang_timezones['timezone']."</b></td><td><b>".$lang_timezones['DST']."</b></td><td><b>&nbsp;</b></td>"; ?>
									</tr>
									<?php
									if (isset($_POST['show_timezone']) && ($_POST['show_timezone'] != "all"))
									{
										$tmp_timezone = floatval($_POST['show_timezone']);
										$filter="WHERE `timezone`=".$tmp_timezone;
									}
									else {
										$filter="";							
									}
									// SQL Select for users informations
									$result = $db->query('SELECT id, username, language, location, timezone, dst FROM '.$db->prefix.'users '.$filter.' ORDER BY timezone,username') or error('Unable to fetch email list', __FILE__, __LINE__, $db->error());
									
									while ($cur_user = $db->fetch_assoc($result))
									{
										echo "<tr><td>".pun_htmlspecialchars($cur_user['username'])."</td><td>".pun_htmlspecialchars($cur_user['language'])."</td><td>".pun_htmlspecialchars($cur_user['location'])."</td><td>".pun_htmlspecialchars($cur_user['timezone'])."</td><td>".pun_htmlspecialchars($cur_user['dst'])."</td><td><b><input name=\"users[".pun_htmlspecialchars($cur_user['id'])."]\" type=\"checkbox\"></b></td></tr>";
									}
									?>
								</table>
							</div>
							<p class="modbuttons" style="text-align:right;margin-right:20px;">
								<a href="#" onclick="return select_checkboxes('search-timez-form', this, '<?php echo $lang_timezones['unselect']; ?>')"><?php echo $lang_timezones['select']; ?></a>
							</p>
						</fieldset>
						<br/><br/>
						<input type="submit" name="to_ete" value="<?php echo $lang_timezones['to_summer']; ?>" />
						<input type="submit" name="to_hiver" value="<?php echo $lang_timezones['to_winter']; ?>" />
						<br/><br/>
						<select name="sel_timezone">
							<option value="-12"><?php echo $lang_prof_reg['UTC-12:00'] ?></option>
							<option value="-11"><?php echo $lang_prof_reg['UTC-11:00'] ?></option>
							<option value="-10"><?php echo $lang_prof_reg['UTC-10:00'] ?></option>
							<option value="-9.5"><?php echo $lang_prof_reg['UTC-09:30'] ?></option>
							<option value="-9"><?php echo $lang_prof_reg['UTC-09:00'] ?></option>
							<option value="-8.5"><?php echo $lang_prof_reg['UTC-08:30'] ?></option>
							<option value="-8"><?php echo $lang_prof_reg['UTC-08:00'] ?></option>
							<option value="-7"><?php echo $lang_prof_reg['UTC-07:00'] ?></option>
							<option value="-6"><?php echo $lang_prof_reg['UTC-06:00'] ?></option>
							<option value="-5"><?php echo $lang_prof_reg['UTC-05:00'] ?></option>
							<option value="-4"><?php echo $lang_prof_reg['UTC-04:00'] ?></option>
							<option value="-3.5"><?php echo $lang_prof_reg['UTC-03:30'] ?></option>
							<option value="-3"><?php echo $lang_prof_reg['UTC-03:00'] ?></option>
							<option value="-2"><?php echo $lang_prof_reg['UTC-02:00'] ?></option>
							<option value="-1"><?php echo $lang_prof_reg['UTC-01:00'] ?></option>
							<option value="0"><?php echo $lang_prof_reg['UTC'] ?></option>
							<option value="1"><?php echo $lang_prof_reg['UTC+01:00'] ?></option>
							<option value="2"><?php echo $lang_prof_reg['UTC+02:00'] ?></option>
							<option value="3"><?php echo $lang_prof_reg['UTC+03:00'] ?></option>
							<option value="3.5"><?php echo $lang_prof_reg['UTC+03:30'] ?></option>
							<option value="4"><?php echo $lang_prof_reg['UTC+04:00'] ?></option>
							<option value="4.5"><?php echo $lang_prof_reg['UTC+04:30'] ?></option>
							<option value="5"><?php echo $lang_prof_reg['UTC+05:00'] ?></option>
							<option value="5.5"><?php echo $lang_prof_reg['UTC+05:30'] ?></option>
							<option value="5.75"><?php echo $lang_prof_reg['UTC+05:45'] ?></option>
							<option value="6"><?php echo $lang_prof_reg['UTC+06:00'] ?></option>
							<option value="6.5"><?php echo $lang_prof_reg['UTC+06:30'] ?></option>
							<option value="7"><?php echo $lang_prof_reg['UTC+07:00'] ?></option>
							<option value="8"><?php echo $lang_prof_reg['UTC+08:00'] ?></option>
							<option value="8.75"><?php echo $lang_prof_reg['UTC+08:45'] ?></option>
							<option value="9"><?php echo $lang_prof_reg['UTC+09:00'] ?></option>
							<option value="9.5"><?php echo $lang_prof_reg['UTC+09:30'] ?></option>
							<option value="10"><?php echo $lang_prof_reg['UTC+10:00'] ?></option>
							<option value="10.5"><?php echo $lang_prof_reg['UTC+10:30'] ?></option>
							<option value="11"><?php echo $lang_prof_reg['UTC+11:00'] ?></option>
							<option value="11.5"><?php echo $lang_prof_reg['UTC+11:30'] ?></option>
							<option value="12"><?php echo $lang_prof_reg['UTC+12:00'] ?></option>
							<option value="12.75"><?php echo $lang_prof_reg['UTC+12:45'] ?></option>
							<option value="13"><?php echo $lang_prof_reg['UTC+13:00'] ?></option>
							<option value="14"><?php echo $lang_prof_reg['UTC+14:00'] ?></option>
						</select>
						<input type="submit" name="to_timezone" value="<?php echo $lang_timezones['to_timezone']; ?>" />
						<br/><br/>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
}
?>
<div class="clearer" />
<?php

