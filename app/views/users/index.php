<!DOCTYPE html>
<html lang="en" class="bg-gray-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Index</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease forwards; }

    /* Pagination layout */
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
<body class="min-h-screen flex flex-col items-center p-6 font-sans text-gray-900 text-lg">

  <h1 class="text-5xl font-bold mb-10 text-indigo-600 animate-fadeInUp">
    Student Information System
  </h1>

  <div class="w-full max-w-5xl flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4 animate-fadeInUp">
    <form method="get" action="<?= site_url('users'); ?>" class="flex w-full sm:w-auto">
      <input type="text" name="q" value="<?= html_escape($_GET['q'] ?? '') ?>"
             placeholder="Search student..."
             class="px-6 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500 flex-grow sm:w-80 text-lg">
      <button type="submit"
              class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-r-lg shadow transition-all duration-300 transform hover:scale-110 text-lg">
        🔍
      </button>
    </form>
    <a href="<?= site_url('/users/create'); ?>"
       class="bg-indigo-600 text-white px-8 py-3 rounded-md font-semibold shadow-md hover:bg-indigo-700 transition transform hover:scale-110 text-center text-lg">
      + Create Record
    </a>
  </div>

  <div class="overflow-x-auto w-full max-w-5xl bg-white rounded-lg shadow-lg animate-fadeInUp">
    <table class="min-w-full text-lg border-collapse">
      <thead>
        <tr class="bg-indigo-100 text-indigo-700">
          <th class="py-4 px-8 border-b border-indigo-300 text-left">ID</th>
          <th class="py-4 px-8 border-b border-indigo-300 text-left">First Name</th>
          <th class="py-4 px-8 border-b border-indigo-300 text-left">Last Name</th>
          <th class="py-4 px-8 border-b border-indigo-300 text-left">Email</th>
          <th class="py-4 px-8 border-b border-indigo-300 text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
  // Get the current page (default = 1)
  $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $perPage = 10; // 10 persons per page

  // Calculate the starting number
  $rowNumber = ($currentPage - 1) * $perPage + 1; 
?>

<?php foreach ($users as $user): ?>
  <tr class="hover:bg-indigo-50 transition-colors odd:bg-white even:bg-indigo-50">
    <td class="py-4 px-8 border-b border-indigo-200"><?= $rowNumber++; ?></td>
    <td class="py-4 px-8 border-b border-indigo-200"><?= $user['first_name']; ?></td>
    <td class="py-4 px-8 border-b border-indigo-200"><?= $user['last_name']; ?></td>
    <td class="py-4 px-8 border-b border-indigo-200"><?= $user['email']; ?></td>
    <td class="py-4 px-8 border-b border-indigo-200 space-x-4">
      <a href="<?= site_url('users/update/'.$user['id']);?>" class="text-blue-600 hover:underline font-medium">Update</a>
      <a href="<?= site_url('users/delete/'.$user['id']);?>" class="text-red-600 hover:underline font-medium">Delete</a>
    </td>
  </tr>
<?php endforeach; ?>

      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center overflow-hidden">
      <nav class="inline-flex items-center" aria-label="Pagination">
        <?= $page ?? '' ?>
      </nav>
    </div>
  </div>

</body>
</html>
