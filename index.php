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
    .animate-fadeInUp {
      animation: fadeInUp 0.8s ease forwards;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center p-6 font-sans text-gray-900">

    <h1 class="text-4xl font-bold mb-8 text-indigo-600 animate-fadeInUp">Welcome to Index View</h1>
    <div class="flex justify-end mb-4 animate-fadeInUp">
        <a href="<?= site_url('/users/create'); ?>"
        class="bg-indigo-600 text-white px-5 py-2 rounded-md font-semibold shadow-md hover:bg-indigo-700 transition transform hover:scale-105">
        + Create Record
    </a>
</div>

    <div class="overflow-x-auto w-full max-w-4xl bg-white rounded-lg shadow-lg animate-fadeInUp">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-indigo-100 text-indigo-700 text-left">
                    <th class="py-3 px-6 border-b border-indigo-300">ID</th>
                    <th class="py-3 px-6 border-b border-indigo-300">First Name</th>
                    <th class="py-3 px-6 border-b border-indigo-300">Last Name</th>
                    <th class="py-3 px-6 border-b border-indigo-300">Email</th>
                    <th class="py-3 px-6 border-b border-indigo-300">Action</th>
                </tr>
            </thead>
        <tbody>
            <?php $i = 1; foreach($users as $user): ?>
            <tr class="hover:bg-indigo-50 transition-colors odd:bg-white even:bg-indigo-50">
                <!-- Sequential ID -->
                <td class="py-3 px-6 border-b border-indigo-200"><?= $i++; ?></td>
            
                <td class="py-3 px-6 border-b border-indigo-200"><?= $user['first_name']; ?></td>
                <td class="py-3 px-6 border-b border-indigo-200"><?= $user['last_name']; ?></td>
                <td class="py-3 px-6 border-b border-indigo-200"><?= $user['email']; ?></td>
                <td class="py-3 px-6 border-b border-indigo-200">
                    <a href="<?= site_url('users/update/'.$user['id']);?>" 
                        class="text-blue-600 hover:underline font-medium">Update</a>
                    <a href="<?= site_url('users/delete/'.$user['id']);?>" 
                        class="text-red-600 hover:underline font-medium">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>

</body>
</html>
