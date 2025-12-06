<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kelola Admin</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold">Daftar Admin</h2>
                <a href="{{ route('admin.admins.create') }}" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Admin
                </a>
            </div>

            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Username</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $key => $admin)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $key + 1 }}</td>
                        <td class="p-3">{{ $admin->name }}</td>
                        <td class="p-3">{{ $admin->email }}</td>
                        <td class="p-3">{{ $admin->username }}</td>
                        <td class="p-3">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                {{ $admin->role }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.admins.edit', $admin) }}" 
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.admins.destroy', $admin) }}" 
                                    onsubmit="return confirm('Yakin ingin menghapus admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>