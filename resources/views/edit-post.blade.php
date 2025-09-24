<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Post - Laravel Blog</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen py-8">
  <div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Post</h1>
        <form action="/edit-post/{{$post->id}}" method="POST" class="space-y-4">
          @csrf
          @method('PUT')
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
            <input type="text" name="title" value="{{$post->title}}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
            <textarea name="body" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-vertical">{{$post->body}}</textarea>
          </div>
          <div class="flex justify-between">
            <a href="/" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
