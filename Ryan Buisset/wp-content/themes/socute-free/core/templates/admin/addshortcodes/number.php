<div class="fieldset number">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<input type="text" id="<?php echo $var[0].'-'.$var[2]; ?>" class="number" name="shortcode-<?php echo $var[0]; ?>" value="<?php echo $var[1]['std']; ?>" />
	<?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?> 
		<span class="description"><?php echo $var[1]['description']; ?></span>
	<?php endif; ?>
</div>

<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($){
		$('#<?php echo $var[0].'-'.$var[2]; ?>').spinner({
			min: -1,
			max: 1000,
			interval: 1,
			defaultValue: <?php if ($var[1]['std'] != '') echo $var[1]['std']; else echo 1; ?>
		})
	});
</script>