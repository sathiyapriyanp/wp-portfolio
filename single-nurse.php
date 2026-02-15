<?php get_header(); ?>

<div class="max-w-5xl mx-auto px-4 py-10">

    <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10 flex flex-col md:flex-row gap-10 items-start">

        <!-- Nurse Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="w-full md:w-1/3">
                <div class="rounded-xl overflow-hidden shadow-md">
                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-auto']); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Nurse Details -->
        <div class="w-full md:w-2/3">

            <!-- Name -->
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                <?php the_title(); ?>
            </h2>

            <!-- Description -->
            <div class="prose max-w-none text-gray-700 mb-6">
                <?php the_content(); ?>
            </div>

            <!-- Details List -->
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-center gap-2">
                    <span class="font-semibold w-32">Department:</span>
                    <span><?php the_field('department'); ?></span>
                </li>

                <li class="flex items-center gap-2">
                    <span class="font-semibold w-32">Experience:</span>
                    <span><?php the_field('experience'); ?> years</span>
                </li>

                <li class="flex items-center gap-2">
                    <span class="font-semibold w-32">Qualification:</span>
                    <span><?php the_field('qualification'); ?></span>
                </li>

                <li class="flex items-center gap-2">
                    <span class="font-semibold w-32">Email:</span>
                    <span><?php the_field('email'); ?></span>
                </li>

                <li class="flex items-center gap-2">
                    <span class="font-semibold w-32">Phone:</span>
                    <span><?php the_field('phone'); ?></span>
                </li>
            </ul>

        </div>
    </div>

</div>
<?php 
    $selected_department = ''; // empty = show 6 random nurses
    include locate_template('template-parts/related_nurse.php'); 
    ?>

<?php get_footer(); ?>
