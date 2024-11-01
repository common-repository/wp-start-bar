<div class="wrap">

<div class="icon32" id="icon-options-strong"><br></div><h2>WP Start Bar Settings</h2>

<form method="post" action="options.php">
<?php settings_fields( 'wpstartbar-options' ); ?>
<table class="form-table">
<tr valign="top">
<th scope="row">Position of start-bar</th>
<td>
<select name="position">
<option value="">Bottom</option>
<option value="sc-top">Top</option>
</select>
<script>jQuery('select[name="position"]').val('<?php echo get_option('position'); ?>');</script>
</td>
</tr>
 
<tr valign="top">
<th scope="row">Name to display when not logged in</th>
<td><input type="text" name="nouser-name" value="<?php echo get_option('nouser-name'); ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">All Pages text</th>
<td><input type="text" name="allpgm" value="<?php echo get_option('allpgm'); ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">Text on start button</th>
<td><input type="text" name="starttext" value="<?php echo get_option('starttext'); ?>" /></td>
</tr>
<tr valign="top">
<th scope="row">Skin (Look and feel)</th>
<td>
<select name="skin">
<option value="">Modern Blue</option>
<option value="sc-maroon">Modern Maroon</option>
<option value="sc-gold">Modern Gold</option>
<option value="sc-silver">Modern Silver</option>
<option value="sc-green">Modern Green</option>
<option value="sc-purple">Modern Purple</option>
<option value="sc-pink">Modern Pink</option>
<option value="sc-red">Modern Red</option>
</select>
<script>jQuery('select[name="skin"]').val('<?php echo get_option('skin'); ?>');</script>
</td>
</tr>

<tr valign="top">
<th scope="row">Start button color</th>
<td>
<select name="btnskin">
<option value="">Green</option>
<option value="sc-blue-btn">Blue</option>
<option value="sc-maroon-btn">Maroon</option>
<option value="sc-gold-btn">Gold</option>
<option value="sc-silver-btn">Silver</option>
<option value="sc-purple-btn">Purple</option>
<option value="sc-pink-btn">Pink</option>
<option value="sc-red-btn">Red</option>
</select>
<script>jQuery('select[name="btnskin"]').val('<?php echo get_option('btnskin'); ?>');</script>
</td>
</tr>
</table>

<?php submit_button(); ?>

</form>

</div>