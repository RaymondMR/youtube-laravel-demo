<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register - Laravel Blog</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto">
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="mb-6 text-center">
          <h2 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h2>
          <p class="text-gray-600">Join our blog community</p>
        </div>
        
        <form action="/register" method="POST" class="space-y-4">
          @csrf
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
            <input name="name" type="text" placeholder="Enter your full name" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
          </div>
          
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input name="email" type="email" placeholder="Enter your email" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
          </div>
          
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input name="password" type="password" placeholder="Create a password" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
          </div>
          
          <button type="submit" 
                  class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-md transition duration-200 ease-in-out transform hover:scale-105">
            Create Account
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <p class="text-gray-600">
            Already have an account? 
            <a href="/" class="text-blue-500 hover:text-blue-700 font-medium hover:underline">
              Sign in here
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>