<?phpif($_POST['name']!=''){$text = wpstartbar_clean($_POST['name']);$link = wpstartbar_clean($_POST['link']);mysql_query("INSERT INTO `wp_startbar` (`id`, `text`, `link`, `logo`, `cat`, `target`, `pos`) VALUES (NULL, '$text', '$link', '$_POST[loginlogo]', '$_POST[cat]', '$_POST[target]', '$_POST[pos]')");echo'<div class="updated"><p>Link added successfully!</p></div>';}?><div class="wrap"><div class="icon32" id="icon-options-strong"><br></div><br /><div class="startform"><form method="post" action=""><fieldset><legend>Create New Icon</legend><i>Icon Image</i><div class="uploader">  <input type="text" name="loginlogo" id="loginlogo" />  <input type="button" class="button button-upload" name="loginlogo_button" id="loginlogo_button" value="Choose" /></div><p><i>Text to display on icon</i><input type="text" name="name" /></p><p><i>Link of icon</i><input type="text" name="link" /></p><p><i>Link position on listing</i><input type="text" name="pos" /></p><p><i>Link target</i><select name="target"><option value="_self">None</option><option>_blank</option><option>_top</option><option>_parent</option></select></p><p><i>Link category</i><select name="cat"><option>StartBar left links</option><option>StartBar right links</option><option>Links on bar</option></select></p><br /><input type="submit" value="Create Link" class="button button-primary button-large" id="publish" name="publish"></fieldset></form></div></div>