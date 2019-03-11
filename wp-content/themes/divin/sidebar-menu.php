<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Divin
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
    return;
}
?>
<aside id="tertiary" class="widget-area-menu" role="complementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #tertiary -->
