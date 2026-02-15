<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'boilerplate-text-domain' ); ?></a>


  
 <nav class="sticky top-0 z-50 bg-[#0a0a0a]/90 backdrop-blur-md border-b border-orange-500/20">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex justify-between items-center h-20">
      
      <div class="flex-shrink-0 group cursor-pointer">
        <h1 class="text-2xl font-black tracking-tighter transition-transform duration-300 group-hover:scale-105">
          <span class="text-white">Sathiya</span><span class="text-orange-500">priyan</span>
        </h1>
      </div>

      <div class="hidden md:flex items-center space-x-10">
        <a href="#projects" class="text-sm font-medium text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">Projects</a>
        <a href="#stack" class="text-sm font-medium text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">Tech Stack</a>
        <a href="#contact" class="text-sm font-medium text-gray-400 hover:text-orange-500 transition-colors uppercase tracking-widest">Contact</a>
        
        <a href="#hire" class="relative inline-flex items-center justify-center px-8 py-2.5 overflow-hidden font-bold text-white transition duration-300 bg-orange-600 rounded-full group hover:bg-orange-500 shadow-[0_0_20px_rgba(234,88,12,0.4)]">
          <span class="relative">Hire Me</span>
        </a>
      </div>

      <div class="md:hidden">
        <button class="p-2 text-orange-500">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
          </svg>
        </button>
      </div>

    </div>
  </div>
</nav>


        





	