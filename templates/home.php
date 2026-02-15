<?php 
/* 
Template Name: Home
*/
 

get_header() ; 



?>



<main id="main" class="site-main test">
    <?php 
  // ✅ Load hero section from template-parts folder
 // get_template_part('template-parts/hero_section');
  ?>

<?php
// get_template_part('template-parts/slider');
 ?>

<?php 
get_template_part('template-parts/banner');
get_template_part('template-parts/sec1');
get_template_part('template-parts/sec2');
get_template_part('template-parts/sec3');
get_template_part('template-parts/sec4');
get_template_part('template-parts/sec5');
 //   $selected_department = ''; // empty = show 6 random nurses
  //  include locate_template('template-parts/related_nurse.php'); 
    ?>

</main>

<?php
get_footer();
?>