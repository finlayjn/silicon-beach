<?php

/**
 * The sidebar containing the main widget area
 *
 * @package Silicon_Beach
 */
?>



<?php if (is_active_sidebar('sidebar-2')) : ?>
    <aside id="secondary" class="sidebar widget-area flex flex-col gap-2">

        <?php dynamic_sidebar('sidebar-2'); ?>
    <?php else : ?>
        <div class="widget">
            <h2 class="widget-title text-xl font-bold mb-4">Sidebar</h2>
            <p>Add widgets to this area in Appearance &rarr; Widgets.</p>
        </div>

    </aside>
<?php endif; ?>


