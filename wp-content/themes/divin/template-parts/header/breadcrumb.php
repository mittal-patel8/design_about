<?php
/**
 * Display Breadcrumb
 *
 * @package Divin
 */
?>

<?php
$enable_breadcrumb = get_theme_mod( 'divin_breadcrumb_option', 1 );

if ( $enable_breadcrumb ) {
    divin_breadcrumb();
}
