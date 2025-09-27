<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Material Symbols -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

  <style>
    /* Fade-in animation (same as register) */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease forwards;
    }

    /* Material icon settings */
    .material-symbols-outlined {
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    /* 🚫 Hide browser’s default password reveal (extra black eye) */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear,
    input[type="password"]::-webkit-clear-button,
    input[type="password"]::-webkit-inner-spin-button,
    input[type="password"]::-webkit-outer-spin-button,
    input[type="password"]::-webkit-calendar-picker-indicator,
    input[type="password"]::-webkit-textfield-decoration-container {
      display: none !important;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-900 text-gray-100 p-6">

  <div class="w-full max-w-md bg-gray-800 shadow-lg rounded-xl p-8 animate-fadeInUp">
    <h2 class="text-3xl font-bold text-center text-indigo-400 mb-6">Login</h2>

    <?php if (!empty($error)): ?>
      <div class="bg-red-100 border border-red-400 text-red-600 text-sm rounded-lg p-3 mb-4 text-center">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/login') ?>" class="space-y-5">
      <!-- First & Last Name -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <input 
          type="text" 
          name="first_name" 
          placeholder="First Name" 
          required
          class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
        />
        <input 
          type="text" 
          name="last_name" 
          placeholder="Last Name" 
          required
          class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
        />
      </div>

      <!-- Email -->
      <div>
        <input 
          type="email" 
          name="email" 
          placeholder="Email Address" 
          required
          class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
        />
      </div>

      <!-- Password -->
      <div class="relative">
        <input 
          type="password" 
          name="password" 
          id="password" 
          placeholder="Password" 
          required
          class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400 pr-10"
        />
        <button type="button" id="togglePassword" 
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 focus:outline-none p-0 m-0 bg-transparent border-none">
          <span class="material-symbols-outlined" id="eyeIconPassword">visibility</span>
        </button>
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        id="btn"
        class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition"
      >
        Login
      </button>
    </form>

    <!-- Register Link -->
    <p class="mt-6 text-center text-sm text-gray-400">
      Don’t have an account? 
      <a href="<?= site_url('auth/register'); ?>" class="text-indigo-400 font-medium hover:underline">
        Register here
      </a>
    </p>
  </div>

  <!-- Toggle Password Visibility Script -->
  <script>
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIconPassword');

    toggleBtn.addEventListener('click', function () {
  const isPassword = passwordInput.getAttribute('type') === 'password';
  passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
  eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
});

  </script>
</body>
</html>
