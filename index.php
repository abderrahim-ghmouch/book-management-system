<?php


require_once"db.php" ;



?>


<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>

  <body class="bg-cyan-800 min-h-screen flex flex-col items-center justify-center gap-8 p-8">
    
    <!-- Header -->
    <header class="text-center">
      <h1 class="text-4xl font-bold text-white mb-2">📚 Book Manager</h1>
      <p class="text-cyan-100">Add and manage your book collection</p>
    </header>

    <!-- Main Form Container -->
    <main class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-2xl">
      
      <form action="add.php" method="POST" class="space-y-6">
        
        <!-- Book Title -->
        <div class="space-y-2">
          <label class="block text-gray-700 font-medium">Book Title</label>
          <input 
            type="text" 
            name="title" 
            placeholder="Enter book title..."
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            required
          >
        </div>

        <!-- Author -->
        <div class="space-y-2">
          <label class="block text-gray-700 font-medium">Author</label>
          <input 
            type="text" 
            name="author" 
            placeholder="Enter author name..."
            class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
            required
          >
        </div>

        <!-- Two-column row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- Published Year -->
          <div class="space-y-2">
            <label class="block text-gray-700 font-medium">Published Year</label>
            <input 
              type="number" 
              name="published" 
              min="1000" 
              max="2025"
              placeholder="2024"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500"
            >
          </div>

          <!-- Genre -->
          <div class="space-y-2">
            <label class="block text-gray-700 font-medium">Genre</label>
            <select 
              name="genre"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Select a genre</option>
              <option value="Fiction">Fiction</option>
              <option value="Non-Fiction">Non-Fiction</option>
              <option value="Programming">Programming</option>
              <option value="Fantasy">Fantasy</option>
              <option value="Mystery">Mystery</option>
            </select>
          </div>

        </div>

        <!-- Read Status -->
        <div class="flex items-center space-x-3">
          <input 
            type="checkbox" 
            name="is_read" 
            value="1"
            class="h-5 w-5 text-blue-600"
          >
          <label class="text-gray-700">I have read this book</label>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-bold py-4 px-6 rounded-lg hover:from-orange-500 hover:to-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl"
        >
          ➕ ADD NEW BOOK
        </button>

      </form>

    </main>

    <!-- Footer -->
    <footer class="text-center">
      <a 
        href="view.php" 
        class="text-white hover:text-orange-300 transition-colors duration-300"
      >
        📖 View All Books →
      </a>
    </footer>

  </body>
</html>

