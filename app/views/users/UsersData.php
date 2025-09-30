<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Information System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease forwards; }

    /* Pagination styling */
    .pagination, .pager, ul.pagination, nav.pager {
      display: inline-flex !important;
      gap: 0.75rem;
      list-style: none;
      padding: 0;
      margin: 0;
      align-items: center;
      flex-wrap: wrap;
    }
    .pagination li, .pager li, .pagination .page-item {
      display: inline-block !important;
    }
    .pagination a, .pagination span, .page-link, .pagination .page-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 2.5rem;
      height: 2.5rem;
      padding: 0.5rem 0.9rem;
      border-radius: 0.5rem;
      text-decoration: none;
      font-size: 1rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    .pagination a:hover {
      background-color: #6366f1; 
      color: #fff;
      transform: scale(1.08);
      box-shadow: 0 2px 6px rgba(99, 102, 241, 0.4);
    }
    .pagination .active a, .pagination .active span {
      background-color: #6366f1;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(99, 102, 241, 0.5);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center p-6 font-sans text-gray-100 bg-gray-900 text-lg transition-colors duration-500">

  <!-- Dashboard Header -->
  <h1 class="text-4xl font-bold mb-6 text-indigo-400 animate-fadeInUp">
    <?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?>
  </h1>

  <!-- User Status -->
  <?php if (!empty($logged_in_user)): ?>
    <div class="mb-6 px-6 py-3 rounded-lg bg-gray-800 border border-gray-700 text-indigo-300 animate-fadeInUp">
      <strong>Welcome:</strong>
      <span class="font-semibold text-white">
        <?= html_escape($logged_in_user['first_name'] . ' ' . $logged_in_user['last_name']); ?>
      </span>
      <span class="ml-2 text-sm text-gray-400">(<?= html_escape($logged_in_user['role']); ?>)</span>
    </div>
  <?php else: ?>
    <div class="mb-6 px-6 py-3 rounded-lg bg-red-900 border border-red-700 text-red-200 animate-fadeInUp">
      Logged in user not found
    </div>
  <?php endif; ?>

  <!-- Top Bar -->
  <div class="w-full max-w-5xl flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4 animate-fadeInUp">

    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>

    <!-- Search -->
    <form method="get" action="<?= site_url('users'); ?>" class="flex w-full sm:w-auto sm:ml-auto">
        <input 
            type="text" 
            name="q" 
            value="<?= html_escape($q); ?>" 
            placeholder="Search student..."
            class="px-6 py-3 border border-gray-600 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 flex-grow sm:w-80 text-lg bg-gray-800 text-gray-100"
        >
        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-r-lg shadow transition-all duration-300 transform hover:scale-110 text-lg">
            🔍
        </button>
    </form>

    <!-- Create Record (only for admin) -->
    <?php if ($logged_in_user['role'] === 'admin'): ?>
      <a href="<?= site_url('/users/create'); ?>"
         class="bg-indigo-600 text-white px-8 py-3 rounded-md font-semibold shadow-md hover:bg-indigo-700 transition transform hover:scale-110 text-center text-lg">
          + Create Record
      </a>
    <?php endif; ?>
  </div>


  <!-- Table -->
<div class="overflow-x-auto w-full max-w-5xl bg-gray-800 rounded-lg shadow-lg animate-fadeInUp">
  <table class="min-w-full text-lg border-collapse">
    <thead>
      <tr class="bg-indigo-900 text-indigo-400">
        <th class="py-4 px-8 border-b border-gray-700 text-left">ID</th>
        <th class="py-4 px-8 border-b border-gray-700 text-left">First Name</th>
        <th class="py-4 px-8 border-b border-gray-700 text-left">Last Name</th>
        <th class="py-4 px-8 border-b border-gray-700 text-left">Email</th>
        <th class="py-4 px-8 border-b border-gray-700 text-left">Role</th>
         <?php if ($logged_in_user['role'] === 'admin'): ?>
          <th class="py-4 px-8 border-b border-gray-700 text-left">Password</th>
        <?php endif; ?>
        <th class="py-4 px-8 border-b border-gray-700 text-left">Action</th>
      </tr>
    </thead>
   <tbody>
  <?php 
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 10; 
    $rowNumber = ($currentPage - 1) * $perPage + 1; 

    // 🔹 Filter users based on role
    $filteredUsers = [];
    foreach ($users as $u) {
      if ($logged_in_user['role'] === 'user' && $u['role'] === 'admin') {
        continue; // Skip admins for normal users
      }
      $filteredUsers[] = $u;
    }
  ?>

  <?php if (!empty($filteredUsers)): ?>
    <?php foreach ($filteredUsers as $user): ?>
      <tr class="hover:bg-indigo-700 transition-colors odd:bg-gray-800 even:bg-gray-700">
        <td class="py-4 px-8 border-b border-gray-600"><?= $rowNumber++; ?></td>
        <td class="py-4 px-8 border-b border-gray-600"><?= html_escape($user['first_name']); ?></td>
        <td class="py-4 px-8 border-b border-gray-600"><?= html_escape($user['last_name']); ?></td>
        <td class="py-4 px-8 border-b border-gray-600"><?= html_escape($user['email']); ?></td>
        <td class="py-4 px-8 border-b border-gray-600"><?= html_escape($user['role']); ?></td>
        <?php if ($logged_in_user['role'] === 'admin'): ?>
          <td class="py-4 px-8 border-b border-gray-600">*******</td>
        <?php endif; ?>
        <td class="py-4 px-8 border-b border-gray-600">
          <div class="flex items-center space-x-4">
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <a href="<?= site_url('users/update/'.$user['id']);?>" class="text-blue-400 hover:underline font-medium">Update</a>
              <a href="<?= site_url('users/delete/'.$user['id']);?>"
                 onclick="confirmDelete(event, this.href, '<?= html_escape($user['first_name'].' '.$user['last_name']); ?>');"
                 class="text-red-400 hover:underline font-medium">
                 Delete
              </a>
            <?php elseif ($logged_in_user['role'] === 'user' && $logged_in_user['id'] === $user['id']): ?>
              <a href="<?= site_url('users/update/'.$user['id']);?>" class="text-blue-400 hover:underline font-medium">Edit Profile</a>
            <?php endif; ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <!-- 🔹 Message when no records match -->
    <tr>
      <td colspan="7" class="py-6 px-8 text-center text-gray-400">
        🚫 No record matches your search.
      </td>
    </tr>
  <?php endif; ?>
</tbody>
  </table>

  <!-- Pagination -->
  <div class="mt-6 flex justify-center overflow-hidden">
    <nav class="inline-flex items-center" aria-label="Pagination">
      <?= $page ?? '' ?>
    </nav>
  </div>
</div>
      
  <!-- Logout -->
    <a href="<?= site_url('auth/logout'); ?>"
       class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold shadow transition transform hover:scale-105 text-center mt-3">
       Logout
    </a>

  <!-- ✅ SweetAlert2 Confirmation Script -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(event, url, name) {
      event.preventDefault();
      Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete the account of " + name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url + "?deleted=1";
        }
      });
    }

    // ✅ Show success popup if deleted
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
      Swal.fire({
        icon: 'success',
        title: 'Delete successful',
        text: 'The account has been deleted.',
        timer: 2000,
        showConfirmButton: false
      });
    <?php endif; ?>
  </script>

</body>
</html>
