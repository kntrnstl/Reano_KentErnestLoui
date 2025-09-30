<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Record</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Fade-in animation */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease forwards;
    }

    /* Hide browser’s default password reveal */
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
<body class="min-h-screen flex items-center justify-center p-6 font-sans bg-gray-900 text-gray-100">

  <!-- Card -->
  <div class="max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-lg animate-fadeInUp">
    <h2 class="text-3xl font-extrabold text-indigo-400 mb-6 text-center">Update Record</h2>

    <form action="<?= site_url('users/update/' . $user['id']); ?>" method="POST" class="space-y-6">

      <!-- First & Last Name (side-by-side on sm+ screens, stacked on mobile) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label for="first_name" class="block text-sm font-medium text-gray-200 mb-1">First Name</label>
          <input type="text" id="first_name" name="first_name"
                 value="<?= html_escape($user['first_name']); ?>" required
                 class="w-full rounded-md border border-gray-600 px-3 py-2 
                        bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
        </div>

        <div>
          <label for="last_name" class="block text-sm font-medium text-gray-200 mb-1">Last Name</label>
          <input type="text" id="last_name" name="last_name"
                 value="<?= html_escape($user['last_name']); ?>" required
                 class="w-full rounded-md border border-gray-600 px-3 py-2 
                        bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
        </div>
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-200 mb-1">Email Address</label>
        <input type="email" id="email" name="email" 
               value="<?= html_escape($user['email']); ?>" required
               class="w-full rounded-md border border-gray-600 px-3 py-2 
                      bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
      </div>

      <?php if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
        <!-- Role Dropdown -->
        <div>
          <label for="role" class="block text-sm font-medium text-gray-200 mb-1">Role</label>
          <select id="role" name="role"
                  class="w-full rounded-md border border-gray-600 px-3 py-2 
                         bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50">
            <option value="user" <?= $user['role'] === 'User' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
          </select>
        </div>

        <!-- Password (with centered eye icon) -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-200 mb-1">Password</label>
          <div class="relative">
            <input type="password" id="password" name="password"
                   class="w-full rounded-md border border-gray-600 px-3 py-2 pr-10
                          bg-gray-700 text-gray-100 focus:border-indigo-400 focus:ring focus:ring-indigo-400 focus:ring-opacity-50" />
            <i class="fa-solid fa-eye-slash absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-indigo-400" id="togglePassword"></i>
          </div>
        </div>
      <?php endif; ?>

      <!-- Submit -->
      <button type="submit" 
              class="w-full bg-indigo-600 text-white py-2 rounded-md font-semibold 
                     hover:bg-indigo-700 transition">
        Update
      </button>
    </form>
  </div>
  
<script>
  const togglePassword = document.querySelector('#togglePassword');
  if (togglePassword) {
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
      if (password.type === 'password') {
        password.type = 'text';
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
      } else {
        password.type = 'password';
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
      }
    });
  }
</script>

</body>
</html>
