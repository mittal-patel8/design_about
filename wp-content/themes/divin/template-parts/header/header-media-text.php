<?php
/**
 * Display Header Media Text
 *
 * @package High_Responsive
 */
?>

<?php $description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<div class="custom-header-content wrapper">
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	</div><!-- .custom-header-contentwrapper -->
<?php endif; ?>
