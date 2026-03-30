<?php

/**
 * The sidebar containing the hero widgets area
 *
 * @package Silicon_Beach
 */
?>


<?php if (is_active_sidebar('hero-widgets')) : ?>
        <?php dynamic_sidebar('hero-widgets'); ?>
    <?php else : ?>
        <div class="widget">
            <h2 class="widget-title text-xl font-bold mb-4">Hero Widgets</h2>
            <p>Add widgets to this area in Appearance &rarr; Widgets.</p>
        </div>
<?php endif; ?>