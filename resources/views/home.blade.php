<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Blog</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="container mx-auto px-4 py-8">
    @auth
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
      <p>Congrats you are logged in!</p>
      <form action="/logout" method="POST" class="inline">
        @csrf
        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">Log out</button>
      </form>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Create a New Post</h2>
      <form action="/create-post" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="title" placeholder="Post title" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <textarea name="body" placeholder="Body content..." rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-vertical"></textarea>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Post</button>
      </form>
    </div>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">All Posts</h2>
      @foreach($posts as $post)
      <div class="bg-gray-100 border border-gray-200 rounded-lg p-6 mb-4">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{$post['title']}} <span class="text-sm text-gray-600 font-normal">by {{$post->user->name}}</span></h3>
        <p class="text-gray-700 mb-4">{{$post['body']}}</p>
        <div class="flex space-x-2">
          <a href="/edit-post/{{$post->id}}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
          <form action="/delete-post/{{$post->id}}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">Delete</button>
          </form>
        </div>
      </div>
      @endforeach
    </div>

    @else
    <div class="max-w-md mx-auto">
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        <div class="mb-6 text-center">
          <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
          <p class="text-gray-600">Sign in to your account</p>
        </div>
        
        <form action="/login" method="POST" class="space-y-4">
          @csrf
          <div>
            <label for="loginname" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
            <input name="loginname" type="text" placeholder="Enter your username" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
          
          <div>
            <label for="loginpassword" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input name="loginpassword" type="password" placeholder="Enter your password" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          </div>
          
          <button type="submit" 
                  class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-200 ease-in-out transform hover:scale-105">
            Sign In
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <p class="text-gray-600">
            Don't have an account? 
            <a href="/register" class="text-green-500 hover:text-green-700 font-medium hover:underline">
              Create one here
            </a>
          </p>
        </div>
      </div>
    </div>
    @endauth
  </div>

  
</body>
</html>