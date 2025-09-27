<header 
  x-data="{ scrolled: false }" 
  x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 80 })"
  class="fixed top-0 left-0 w-full z-40 transition-transform duration-500 ease-ease"
>
  <div 
    :class="scrolled ? 'translate-y-0 bg-green-700 shadow-md' : '-translate-y-full'"
    class="transition-transform duration-500 w-full green"
  >
    <div class="w-full mx-auto px-6 flex justify-between items-center py-4">
      <!-- Logo (always red + white text on sticky) -->
      <x-nav-logo logo-color="#ffffff" text-color="text-white" />

      <!-- Links (always white on sticky) -->
      <x-nav-links linkColor="text-white" hoverColor="hover:text-gray-200" />

      <!-- Auth -->
      <x-nav-auth 
        linkColor="text-white" 
        hoverColor="hover:text-red-600" 
        buttonBg="bg-white" 
        buttonText="text-green-700" 
        buttonHoverBg="hover:bg-gray-100"
    />

      <!-- Hamburger (always white on sticky) -->
      <button @click="mobileOpen = true" class="md:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
  </div>
</header>
