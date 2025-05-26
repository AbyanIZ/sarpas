<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengguna - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes drift {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(12px); }
        }

        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-drift { animation: drift 8s ease-in-out infinite; }

        .sidebar-item { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-item:hover { transform: translateX(4px); }

        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2); }

        .user-card { transition: all 0.3s ease; }
        .user-card:hover { transform: translateY(-2px); background-color: #2f2f2f; }
    </style>
</head>

<body class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,#202020,#121212)] text-white relative overflow-hidden" x-data="userData()">

    <!-- Background pattern -->
    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.05;">
    </div>

    <!-- Animated blobs -->
    <div class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-25 bottom-[-60px] left-[-60px] blur-md z-0"></div>
    <div class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-25 bottom-[-100px] right-[-80px] blur-md z-0"></div>
    <div class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-25 top-[-40px] right-[-40px] blur-md z-0"></div>
    <div class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-20 top-[20%] left-[5%] blur-md z-0"></div>
    <div class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-25 top-[30%] right-[10%] blur-md z-0 animate-float"></div>
    <div class="absolute w-[180px] h-[180px] bg-[#7a6ee9] rounded-full opacity-20 top-[35%] left-[35%] blur-lg z-0 animate-float"></div>

    <!-- Navbar -->
    <nav class="bg-[#1e1e1e]/95 backdrop-blur-md px-8 py-4 shadow-lg z-10 relative flex justify-between items-center border-b border-[#333]/50">
        <h1 class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent">
            <i class="fas fa-users mr-2"></i>Pengguna
        </h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-300 hover:text-[#6aa6ff] transition duration-200 flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log out</span>
                </button>
            </form>
            <div class="w-9 h-9 flex items-center rounded-full overflow-hidden border-2 border-[#6aa6ff]/50">
                <img src="assets/OIP.jpeg" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#181818]/90 py-8 px-6 border-r border-[#333]/50 min-h-screen relative z-10 backdrop-blur-sm">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-tachometer-alt text-gray-300 mr-4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}" class="flex items-center py-4 px-5 rounded-lg bg-gradient-to-r from-[#2f2f2f] to-[#2f2f2f]/70 hover:from-[#333] hover:to-[#333]/70 transition shadow-md sidebar-item">
                        <i class="fas fa-users text-[#6aa6ff] mr-4"></i>
                        <span class="font-medium">Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pendataan') }}" class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-clipboard-list text-gray-300 mr-4"></i>
                        <span>Pendataan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-file-alt text-gray-300 mr-4"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                <!-- Admin Section -->
                <div class="space-y-6">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold flex items-center justify-center gap-2">
                            <i class="fas fa-user-shield text-[#6aa6ff]"></i>
                            Admin
                        </h2>
                        <p class="text-sm text-gray-400 mt-1">Total: {{ $adminCount }} Admin</p>
                    </div>

                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                        <input type="text" x-model="searchAdmin" placeholder="Cari Admin..."
                            class="w-full p-2 pl-12 pr-4 rounded-full bg-[#2f2f2f] border border-[#333] focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">
                    </div>

                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2">
                        <template x-for="(admin, index) in filteredAdmins" :key="index">
                            <div class="user-card p-4 bg-[#2a2a2a] rounded-lg flex items-center justify-between border border-[#333]/50">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center">
                                        <i class="fas fa-user-cog text-[#6aa6ff]"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold" x-text="admin"></div>
                                        <div class="text-xs text-gray-400">Admin Account</div>
                                    </div>
                                </div>
                                <span class="text-xs bg-[#6aa6ff]/20 text-[#6aa6ff] px-2 py-1 rounded-full">Admin</span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- User Section -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-center">
                            <h2 class="text-2xl font-bold flex items-center justify-center gap-2">
                                <i class="fas fa-users text-[#6aa6ff]"></i>
                                User
                            </h2>
                            <p class="text-sm text-gray-400 mt-1">Total: {{ $userCount }} User</p>
                        </div>
                        <a href="{{ route('register.user') }}"
                            class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-[#6aa6ff] to-[#4d73e6] hover:from-[#5a95e8] hover:to-[#3f63d4] text-white font-semibold rounded-full shadow-md transition-transform transform hover:scale-105">
                            <i class="fas fa-user-plus"></i>
                            Tambah User
                        </a>
                    </div>

                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                        <input type="text" x-model="searchUser" placeholder="Cari User..."
                            class="w-full p-2 pl-12 pr-4 rounded-full bg-[#2f2f2f] border border-[#333] focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">
                    </div>

                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2">
                        <template x-for="(user, index) in filteredUsers" :key="index">
                            <div class="user-card p-4 bg-[#2a2a2a] rounded-lg flex items-center justify-between border border-[#333]/50">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#a162e8]/10 flex items-center justify-center">
                                        <i class="fas fa-user text-[#a162e8]"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold" x-text="user"></div>
                                        <div class="text-xs text-gray-400">Regular User</div>
                                    </div>
                                </div>
                                <span class="text-xs bg-[#a162e8]/20 text-[#a162e8] px-2 py-1 rounded-full">User</span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function userData() {
            return {
                searchAdmin: '',
                searchUser: '',
                admins: @json($admins->pluck('name')),
                users: @json($users->pluck('name')),
                get filteredAdmins() {
                    if (this.searchAdmin === '') return this.admins;
                    return this.admins.filter(name => name.toLowerCase().includes(this.searchAdmin.toLowerCase()));
                },
                get filteredUsers() {
                    if (this.searchUser === '') return this.users;
                    return this.users.filter(name => name.toLowerCase().includes(this.searchUser.toLowerCase()));
                }
            }
        }
    </script>
</body>
</html>
