<?php
/**
 * The template for displaying the footer
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 */

?>
<!-- footer -->

<footer class="bg-[#050505] pt-20 pb-10 border-t border-white/5 relative overflow-hidden">
  
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-[1px] bg-gradient-to-r from-transparent via-orange-500/50 to-transparent"></div>

  <div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
      
      <div class="md:col-span-2">
        <h2 class="text-2xl font-black tracking-tighter mb-4 text-white">
          Sathiya<span class="text-orange-500">priyan</span>
        </h2>
        <p class="text-gray-500 max-w-sm leading-relaxed mb-6">
          Designing and coding high-performance digital experiences. Based in India, working globally.
        </p>
        <div class="flex gap-4">
          <span class="flex items-center gap-2 text-[10px] font-bold tracking-widest text-orange-500 uppercase">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
            </span>
            Available for freelance
          </span>
        </div>
      </div>

      <div>
        <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-[0.2em]">Navigation</h4>
        <ul class="space-y-4">
          <li><a href="#projects" class="text-gray-500 hover:text-orange-500 transition-colors text-sm">Featured Works</a></li>
          <li><a href="#experience" class="text-gray-500 hover:text-orange-500 transition-colors text-sm">Career Path</a></li>
          <li><a href="#education" class="text-gray-500 hover:text-orange-500 transition-colors text-sm">Education</a></li>
          <li><a href="#contact" class="text-gray-500 hover:text-orange-500 transition-colors text-sm">Contact Me</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-bold mb-6 uppercase text-xs tracking-[0.2em]">Social Connect</h4>
        <ul class="space-y-4">
          <li><a href="#" class="text-gray-500 hover:text-white transition-colors text-sm flex items-center gap-2">LinkedIn <span class="text-orange-500">↗</span></a></li>
          <li><a href="#" class="text-gray-500 hover:text-white transition-colors text-sm flex items-center gap-2">GitHub <span class="text-orange-500">↗</span></a></li>
          <li><a href="#" class="text-gray-500 hover:text-white transition-colors text-sm flex items-center gap-2">Twitter <span class="text-orange-500">↗</span></a></li>
          <li><a href="#" class="text-gray-500 hover:text-white transition-colors text-sm flex items-center gap-2">Instagram <span class="text-orange-500">↗</span></a></li>
        </ul>
      </div>
    </div>

    <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
      <p class="text-gray-600 text-[10px] uppercase tracking-widest">
        © 2026 Sathiyapriyan. All rights reserved.
      </p>
      
      <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="group flex items-center gap-3 text-gray-500 hover:text-white transition-colors">
        <span class="text-[10px] uppercase tracking-widest font-bold">Back to top</span>
        <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-orange-500/50 group-hover:bg-orange-500 group-hover:text-black transition-all">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
        </div>
      </button>
    </div>
  </div>
</footer>


<?php wp_footer(); ?>





</body>
</html>
