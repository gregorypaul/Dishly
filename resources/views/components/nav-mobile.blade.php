<div x-show="mobileOpen" class="fixed inset-0 z-50 flex">
    <!-- Backdrop -->
    <div @click="mobileOpen = false" class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Sidebar -->
    <div x-show="mobileOpen"
         x-transition:enter="transform transition ease-in-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="relative bg-green-700 text-white w-64 p-6 space-y-4">

        <!-- Close Button -->
        <button @click="mobileOpen = false" class="absolute top-4 right-4 text-white">✕</button>

        <!-- Logo -->
        <x-nav-logo variant="white" />

        <!-- Links (vertical layout) -->
        <x-nav-links variant="white" layout="vertical" />

        <!-- Auth -->
        <x-nav-auth variant="white" layout="vertical" />
    </div>
</div>