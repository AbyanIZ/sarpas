<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pengguna - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body
    class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,#202020,#121212)] text-white relative overflow-hidden"
    x-data="userData()">

    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.03;">
    </div>

    <div
        class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-30 bottom-[-60px] left-[-60px] blur-sm z-0">
    </div>
    <div
        class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-30 bottom-[-100px] right-[-80px] blur-sm z-0">
    </div>
    <div class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-30 top-[-40px] right-[-40px] blur-sm z-0">
    </div>
    <div class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-25 top-[20%] left-[5%] blur-sm z-0"></div>
    <div
        class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-30 top-[30%] right-[10%] blur-sm z-0 animate-float">
    </div>
    <div
        class="absolute w-[250px] h-[250px] bg-[#3a3f7d] rounded-full opacity-20 bottom-[10%] right-[30%] blur-sm z-0 animate-drift">
    </div>
    <div
        class="absolute w-[180px] h-[180px] bg-[#7a6ee9] rounded-full opacity-25 top-[35%] left-[35%] blur-md z-0 animate-float">
    </div>
    <div
        class="absolute w-[140px] h-[140px] bg-[#5f6ee6] rounded-full opacity-20 top-[9%] right-[18%] blur-md ring-2 ring-[#6aa6ff]/20 z-0 animate-drift">
    </div>
    <nav class="bg-[#1e1e1e]/90 backdrop-blur-md px-10 py-4 shadow-lg z-10 relative flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Pengguna</h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:text-[#6aa6ff] transition duration-200">Log out</button>
            </form>
            <div class="w-10 h-10 flex items-center">
                <img src="assets/OIP.jpeg" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-64 bg-[#181818]/80 py-10 px-6 border-r border-[#333] min-h-screen relative z-10">
            <ul class="space-y-4">
                <li><a href="{{ route('dashboard') }}"
                        class="block py-5 px-5 rounded hover:bg-[#2f2f2f] transition">Dashboard</a></li>
                <li><a href="{{ route('pengguna') }}" class="block py-5 px-5 rounded bg-[#2f2f2f]">Pengguna</a></li>
                <li><a href="{{ route('pendataan') }}"
                        class="block py-5 px-5 rounded hover:bg-[#2f2f2f] transition">Pendataan</a></li>
                <li><a href="{{ route('laporan') }}"
                        class="block py-5 px-5 rounded hover:bg-[#2f2f2f] transition">Laporan</a></li>
            </ul>
        </aside>

        <main class="flex-1 p-10 relative">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative">
                <div
                    class="hidden md:block absolute top-0 bottom-0 left-1/2 w-0.5 bg-gradient-to-b from-[#6aa6ff] via-[#7a6ee9] to-[#6aa6ff] animate-pulse z-0">
                </div>

                <div class="space-y-4">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold">Admin</h2>
                        <p class="text-sm text-gray-400 mt-1">Total: {{ $adminCount }} Admin</p>
                    </div>

                    <input type="text" x-model="searchAdmin" placeholder="Cari Admin..."
                        class="w-full p-2 pl-4 pr-10 rounded-full bg-[#2f2f2f] border border-[#333] focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">

                    <template x-for="(admin, index) in filteredAdmins" :key="index">
                        <div class="p-4 bg-[#2a2a2a] hover:bg-[#333] rounded-lg flex items-center justify-between"
                            x-transition>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold" x-text="index + 1"></span>
                                <div class="text-lg font-semibold" x-text="admin"></div>
                            </div>
                            <span class="text-xs bg-[#6aa6ff]/20 text-[#6aa6ff] px-2 py-1 rounded-full">Admin</span>
                        </div>
                    </template>
                </div>
                <div class="space-y-4 relative">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold">User</h2>
                        <p class="text-sm text-gray-400 mt-1">Total: {{ $userCount }} User</p>
                    </div>

                    <div class="absolute top-0 right-0">
                        <a href="{{ route('register.user') }}"
                            class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-[#6aa6ff] to-[#4d73e6] hover:from-[#5a95e8] hover:to-[#3f63d4] text-white font-semibold rounded-full shadow-md transition-transform transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah User
                        </a>
                    </div>

                    <input type="text" x-model="searchUser" placeholder="Cari User..."
                        class="w-full p-2 pl-4 pr-10 rounded-full bg-[#2f2f2f] border border-[#333] focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">

                    <template x-for="(user, index) in filteredUsers" :key="index">
                        <div class="p-4 bg-[#2a2a2a] hover:bg-[#333] rounded-lg flex items-center justify-between"
                            x-transition>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-semibold" x-text="index + 1"></span>
                                <div class="text-lg font-semibold" x-text="user"></div>
                            </div>
                            <span class="text-xs bg-[#6aa6ff]/20 text-[#6aa6ff] px-2 py-1 rounded-full">User</span>
                        </div>
                    </template>
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
    <style type="text/tailwindcss">
        @layer utilities {
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-20px);
                }
            }

            @keyframes drift {
                0% {
                    transform: translate(0, 0) rotate(0deg);
                }

                50% {
                    transform: translate(10px, -10px) rotate(4deg);
                }

                100% {
                    transform: translate(0, 0) rotate(0deg);
                }
            }

            .animate-float {
                animation: float 2.5s ease-in-out infinite;
            }

            .animate-drift {
                animation: drift 3.5s ease-in-out infinite;
            }
        }
    </style>

</body>
</html>
