<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease forwards;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 font-sans bg-gray-900 text-gray-100">

  <div class="max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-lg animate-fadeInUp">
    <h2 class="text-3xl font-extrabold text-indigo-400 mb-6 text-center">Create an Account</h2>
    
    <form action="<?=site_url('users/create');?>" method="POST" class="space-y-6">
      <div>
        <label for="first_name" class="block text-sm font-medium text-gray-200 mb-1">First Name</label>
        <input type="text" id="first_name" name="first_name" required
          class="w-full rounded-md border border-gray-600 px-3 py-2 bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
      </div>

      <div>
        <label for="last_name" class="block text-sm font-medium text-gray-200 mb-1">Last Name</label>
        <input type="text" id="last_name" name="last_name" required
          class="w-full rounded-md border border-gray-600 px-3 py-2 bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Email Address</label>
        <input type="email" id="email" name="email" required
          class="w-full rounded-md border border-gray-600 px-3 py-2 bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 text-white py-2 rounded-md font-semibold hover:bg-indigo-700 transition">
        Sign Up
      </button>
    </form>
  </div>

</body>
</html>
