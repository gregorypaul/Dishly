@extends('layouts.app')

@section('content')
  <!-- Hero Section -->
  <section class="relative h-80 md:h-[28rem] bg-gray-700 text-white overflow-hidden">
    <img src="/images/bbq.avif" alt="Contact Dishly Hero" 
         class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
      <h1 class="text-4xl md:text-5xl font-bold">Contact Us</h1>
      <p class="mt-4 text-lg md:text-xl max-w-2xl">
        Have a question, idea, or feedback? We’d love to hear from you.
      </p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="relative max-w-6xl mx-auto px-6 py-16 space-y-20">

    <!-- Get in Touch -->
    <div 
      x-data="{ show: false }" 
      x-init="window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="grid md:grid-cols-2 gap-12 items-center transform transition duration-700"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

      <div>
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">Get in Touch</h2>
        <p class="text-gray-700 leading-relaxed">
          Whether you’re looking for help with a recipe, want to share your own, 
          or just want to say hi—we’re always excited to connect with fellow food lovers.
        </p>
      </div>
      <div class="relative">
        <img src="/images/contact.avif" alt="Contact workspace" 
             class="rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-green-200 rounded-lg -z-10"></div>
      </div>
    </div>

    <!-- Our Team -->
    <div 
      x-data="{ show: false }" 
      x-init="setTimeout(() => show = true, 200); window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="grid md:grid-cols-2 gap-12 items-center transform transition duration-700 delay-150"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

      <div class="relative order-2 md:order-1">
        <img src="/images/kitchen.avif" alt="Our team" 
             class="rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
        <div class="absolute -top-6 -right-6 w-28 h-28 bg-pink-200 rounded-lg -z-10"></div>
      </div>
      <div class="order-1 md:order-2">
        <h2 class="text-3xl font-semibold text-gray-900 mb-4">Our Team</h2>
        <p class="text-gray-700 leading-relaxed">
          Behind Dishly is a passionate team of food enthusiasts, developers, 
          and designers working to make discovering and sharing recipes effortless and inspiring.
        </p>
      </div>
    </div>

    <!-- Contact Form -->
    <div 
      x-data="{ show: false }" 
      x-init="window.addEventListener('scroll', () => { 
          if ($el.getBoundingClientRect().top < window.innerHeight - 100) show = true 
      })"
      class="relative text-center transform transition duration-700 delay-300"
      :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

      <h2 class="text-3xl font-semibold text-gray-900 mb-6">Send Us a Message</h2>
      <form action="#" method="POST" class="max-w-2xl mx-auto grid gap-4 text-left">
        <input type="text" name="name" placeholder="Your Name" 
               class="px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">
        <input type="email" name="email" placeholder="Your Email" 
               class="px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600">
        <textarea name="message" rows="4" placeholder="Your Message"
               class="px-5 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600"></textarea>
        <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg transition">
          Send Message
        </button>
      </form>
    </div>
  </section>
@endsection
