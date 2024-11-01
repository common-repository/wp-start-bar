<div class="wrap">

<div class="icon32" id="icon-options-strong"><br></div>
<?php

if(isset($_GET['delete'])){
mysql_query("DELETE FROM `wp_startbar` WHERE `id`='$_GET[delete]'");
echo'<h2>Deleted. Redirecting...</h2>
<script>document.location.href=\'admin.php?page=wpstartbar-manage.php\';</script>';
}

if(!isset($_GET['edit'])){
?>
<br /><div class="startform">
<form method="post" action="">

<fieldset>
<legend>WP Start Bar Management</legend>
<table class="widefat start-table">
<tr><th>S No</th><th>Logo</th><th>Link</th><th>Order</th><th>Category</th><th>Options</th></tr>
<?php
$res = mysql_query("SELECT * FROM `wp_startbar` ORDER BY `pos` ASC");
$i=1;
while($row = mysql_fetch_assoc($res)){
echo'<tr><td>'.$i.'</td><td><img class="wp_startbar_aicon" src="'.$row['logo'].'"></td><td><a target="'.$row['target'].'" href="'.$row['link'].'">'.$row['text'].'</a></td><td>'.$row['pos'].'</td><td>'.$row['cat'].'</td><td>
<a href="admin.php?page=wpstartbar-manage.php&edit='.$row['id'].'">Edit</a> | 
<a href="javascript:start_delete_icon('.$row['id'].')">Delete</a>
</td></tr>';

++$i;
}
?>
</table>
</fieldset>


</form>
</div>
<?php } else {

if($_POST['name']!=''){
mysql_query("UPDATE `wp_startbar` SET `text` = '".$_POST['name']."',
`link` = '".$_POST['link']."',
`logo` = '".$_POST['loginlogo']."',
`cat` = '".$_POST['cat']."',
`target` = '".$_POST['target']."',
`pos` = '".$_POST['pos']."' WHERE `id` ='$_GET[edit]'");
echo'<div class="updated"><p>Updated successfully!</p></div>';
}

$xdata = mysql_fetch_assoc(mysql_query("SELECT * FROM `wp_startbar` WHERE `id`='$_GET[edit]'"));
 ?>





<br /><div class="startform">
<form method="post" action="">

<fieldset>
<legend>Editing Icon &gt;&gt; <?php echo $xdata['text']; ?></legend>

<i>Icon Image</i>
<div class="uploader">
  <input type="text" name="loginlogo" value="<?php echo $xdata['logo']; ?>" id="loginlogo" />
  <input type="button" class="button button-upload" name="loginlogo_button" id="loginlogo_button" value="Choose" />
</div>

<p>
<i>Text to display on icon</i>
<input type="text" value="<?php echo $xdata['text']; ?>" name="name" />
</p>

<p>
<i>Link of icon</i>
<input value="<?php echo $xdata['link']; ?>" type="text" name="link" />
</p>

<p>
<i>Link position on listing</i>
<input value="<?php echo $xdata['pos']; ?>" type="text" name="pos" />
</p>

<p>
<i>Link target</i>
<select id="xtarget" name="target">
<option value="_self">None</option>
<option>_blank</option>
<option>_top</option>
<option>_parent</option>
</select>
</p>
<script>jQuery('#xtarget').val('<?php echo $xdata['target']; ?>');</script>

<p>
<i>Link category</i>
<select id="xcat" name="cat">
<option>StartBar left links</option>
<option>StartBar right links</option>
<option>Links on bar</option>
</select>
</p>
<script>jQuery('#xcat').val('<?php echo $xdata['cat']; ?>');</script>

<br />
<input type="submit" value="Save Changes" class="button button-primary button-large" id="publish" name="publish">

</fieldset>


</form>
</div>

<?php } ?>
</div>