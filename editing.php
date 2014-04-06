<?php

/**
 * Copyright (C) 2008-2012 FluxBB
 * based on code by Rickard Andersson copyright (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */

define('PUN_ROOT', dirname(__FILE__).'/');
define('PUN_ACTIVE_PAGE', 'edited');
require PUN_ROOT.'include/common.php';
require PUN_ROOT.'lang/'.$pun_user['language'].'/index.php';

if ($pun_config['o_feed_type'] == '1')
	$page_head = array('feed' => '<link rel="alternate" type="application/rss+xml" href="extern.php?action=feed&amp;type=rss" title="'.$lang_common['RSS active topics feed'].'" />');
else if ($pun_config['o_feed_type'] == '2')
	$page_head = array('feed' => '<link rel="alternate" type="application/atom+xml" href="extern.php?action=feed&amp;type=atom" title="'.$lang_common['Atom active topics feed'].'" />');

$page_title = array( pun_htmlspecialchars( 'Messages récemment édités' ), $pun_config['o_board_title'] );
require PUN_ROOT.'header.php';

$is_admmod = ($pun_user['g_id'] == PUN_ADMIN || ($pun_user['g_moderator'] == '1' && array_key_exists($pun_user['username'], $mods_array))) ? true : false;

if ( !$is_admmod )
    message( $lang_common['No permission'] );

$posts = array();
$timestamp = time() - 5184000; //60*24*3600

$q = 'SELECT * FROM posts WHERE edited > '.$timestamp.' AND edited_by != "NULL" ORDER BY edited';
$result = $db->query( $q ) or error( 'Impossible de retrouver la liste des messages !', __FILE__, __LINE__, $db->error() );
while( $r = $db->fetch_assoc( $result ) )
    $posts[] = array( 'id' => $r['id'],
                      'poster' => $r['poster'],
                      'poster_id' => $r['poster_id'],
                      'posted' => $r['posted'],
                      'edited' => $r['edited'],
                      'edited_by' => $r['edited_by'] );

krsort( $posts );

$total = count( $posts );
$s = ( $total > 1 ? 's' : '' );

?>
                <div id="msg" class="block">
                  <h2 id="post_title" style="border-bottom:1px solid #333"><?php echo "$total Message$s édité$s récemment"; ?></h2>
                  <div id="posts">
                    <table style="background:#fefefe;padding:5px;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Auteur</th>
                          <th>Date</th>
                          <th>Édité le </th>
                          <th>Édité par</th>
                        </tr>
                      </thead>
                      <tbody>
<?php foreach( $posts as $post ) : ?>
                        <tr>
                          <td style="padding:2px 5px;"><a href="<?php echo $pun_config['o_base_url']."/viewtopic.php?pid=".$post['id']."#p".$post['id']; ?>">#<?php echo $post['id']; ?></a></td>
                          <td style="padding:2px 5px;"><a href="<?php echo $pun_config['o_base_url']."/profile.php?id=".$post['poster_id']."#p".$post['id']; ?>"><?php echo $post['poster']; ?></a></td>
                          <td style="padding:2px 5px;"><?php echo date( 'j F Y \à H\:i', $post['posted'] ); ?></td>
                          <td style="padding:2px 5px;"><strong><?php echo date( 'j F Y \à H\:i', $post['edited'] ); ?></strong></td>
                          <td style="padding:2px 5px;"><?php echo $post['edited_by']; ?></td>
                        </tr>
<?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
<?php

$footer_style = 'index';
require PUN_ROOT.'footer.php';