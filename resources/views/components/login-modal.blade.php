<div 
      x-show="loginOpen"
      x-cloak
      class="fixed inset-0 z-50 flex items-center justify-center"
      @click.self="loginOpen = false"
  >
      <div class="absolute inset-0 {{ $overlayColor }}"></div>

      <div id="loginModalContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
          <!-- Close Button -->
          <button 
              @click="loginOpen = false" 
              class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
          >
              ✕
          </button>

          <h2 class="text-2xl font-bold mb-4">Login</h2>

          <div id="loginError" class="hidden mb-4 p-2 bg-red-100 text-red-700 rounded"></div>

          <form id="loginForm" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input id="email" type="email" name="email" required autofocus 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500">
              </div>

              <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input id="password" type="password" name="password" required 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-green-500 focus:border-green-500">
              </div>

              <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                  Log in
              </button>
          </form>
      </div>
  </div>