<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Material Symbols -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease forwards;
    }
    .material-symbols-outlined {
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }
    /* 🚫 Hide browser’s default password reveal */
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
    <h2 class="text-3xl font-bold text-center text-indigo-400 mb-6">Register</h2>

    <form method="POST" action="<?= site_url('auth/register'); ?>" class="space-y-5">
      <!-- First & Last Name -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="first_name" class="block text-sm font-medium text-gray-200 mb-1">First Name</label>
          <input 
            type="text" 
            name="first_name" 
            id="first_name"
            placeholder="First Name" 
            required
            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />
        </div>
        <div>
          <label for="last_name" class="block text-sm font-medium text-gray-200 mb-1">Last Name</label>
          <input 
            type="text" 
            name="last_name" 
            id="last_name"
            placeholder="Last Name" 
            required
            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
          />
        </div>
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Email</label>
        <input 
          type="email" 
          name="email" 
          id="email"
          placeholder="Email Address" 
          required
          class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400"
        />
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-200 mb-1">Password</label>
        <div class="relative">
          <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Password" 
            required
            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 pr-10"
          />
          <button type="button" id="togglePassword" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 focus:outline-none">
            <span class="material-symbols-outlined" id="eyeIconPassword">visibility</span>
          </button>
        </div>
      </div>

      <!-- Confirm Password -->
      <div>
        <label for="confirmPassword" class="block text-sm font-medium text-gray-200 mb-1">Confirm Password</label>
        <div class="relative">
          <input 
            type="password" 
            id="confirmPassword" 
            name="confirm_password" 
            placeholder="Confirm Password" 
            required
            class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 pr-10"
          />
          <button type="button" id="toggleConfirmPassword" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 focus:outline-none">
            <span class="material-symbols-outlined" id="eyeIconConfirm">visibility</span>
          </button>
        </div>
      </div>

      <!-- ✅ Hidden Role Field -->
      <input type="hidden" name="role" value="user">

      <!-- Register Button -->
      <button 
        type="submit" 
        id="btn"
        class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition"
      >
        Register
      </button>
    </form>

    <!-- Login Link -->
    <p class="mt-6 text-center text-sm text-gray-400">
      Already have an account? 
      <a href="<?= site_url('auth/login'); ?>" class="text-indigo-400 font-medium hover:underline">
        Login here
      </a>
    </p>
  </div>

  <script>
  function toggleVisibility(toggleId, inputId, iconId) {
    const toggle = document.getElementById(toggleId);
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    toggle.addEventListener('click', function () {
      const isPassword = input.getAttribute('type') === 'password';
      input.setAttribute('type', isPassword ? 'text' : 'password');
      icon.textContent = isPassword ? 'visibility_off' : 'visibility';
    });
  }

  toggleVisibility('togglePassword', 'password', 'eyeIconPassword');
  toggleVisibility('toggleConfirmPassword', 'confirmPassword', 'eyeIconConfirm');
  </script>

</body>
</html>
