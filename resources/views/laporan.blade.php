<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes drift {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(12px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-drift {
            animation: drift 8s ease-in-out infinite;
        }

        .sidebar-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-item:hover {
            transform: translateX(4px);
        }

        .report-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(106, 166, 255, 0.1);
            background-color: #2a2a2a;
        }
    </style>
</head>

<body
    class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-hidden">

    <!-- Background pattern -->
    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.05;">
    </div>

    <!-- Animated blobs -->
    <div
        class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-25 bottom-[-60px] left-[-60px] blur-md z-0">
    </div>
    <div
        class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-25 bottom-[-100px] right-[-80px] blur-md z-0">
    </div>
    <div class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-25 top-[-40px] right-[-40px] blur-md z-0">
    </div>
    <div class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-20 top-[20%] left-[5%] blur-md z-0">
    </div>
    <div
        class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-25 top-[30%] right-[10%] blur-md z-0 animate-float">
    </div>
    <div
        class="absolute w-[180px] h-[180px] bg-[#7a6ee9] rounded-full opacity-20 top-[35%] left-[35%] blur-lg z-0 animate-float">
    </div>

    <!-- Navbar -->
    <nav
        class="bg-[#1e1e1e]/95 backdrop-blur-md px-8 py-4 shadow-lg z-10 relative flex justify-between items-center border-b border-[#333]/50">
        <h1 class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent">
            <i class="fas fa-file-alt mr-2"></i>Laporan
        </h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-gray-300 hover:text-[#6aa6ff] transition duration-200 flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log out</span>
                </button>
            </form>
            <div class="w-9 h-9 flex items-center rounded-full overflow-hidden border-2 border-[#6aa6ff]/50">
                <img src="assets/OIP.jpeg" alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside
            class="w-64 bg-[#181818]/90 py-8 px-6 border-r border-[#333]/50 min-h-screen relative z-10 backdrop-blur-sm">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-tachometer-alt text-gray-300 mr-4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna') }}"
                        class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-users text-gray-300 mr-4"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pendataan') }}"
                        class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-clipboard-list text-gray-300 mr-4"></i>
                        <span>Pendataan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}"
                        class="flex items-center py-4 px-5 rounded-lg bg-gradient-to-r from-[#2f2f2f] to-[#2f2f2f]/70 hover:from-[#333] hover:to-[#333]/70 transition shadow-md sidebar-item">
                        <i class="fas fa-file-alt text-[#6aa6ff] mr-4"></i>
                        <span class="font-medium">Laporan</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Laporan Stok Barang -->
<a href="{{ route('laporan-stok.index') }}" class="block transition-transform hover:scale-[1.01]">
    <div class="report-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50 cursor-pointer">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                <i class="fas fa-boxes text-[#6aa6ff] text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">Laporan Stok Barang</h2>
                <p class="text-sm text-gray-400 mt-1">Lihat dan kelola laporan stok barang</p>
            </div>
        </div>
    </div>
</a>

<!-- Laporan Peminjaman -->
<a href="{{ route('laporan.peminjaman.index') }}" class="block transition-transform hover:scale-[1.01]">
    <div class="report-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50 cursor-pointer">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-full bg-[#5abf6a]/10 flex items-center justify-center mr-4">
                <i class="fas fa-hand-holding text-[#5abf6a] text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">Laporan Peminjaman</h2>
                <p class="text-sm text-gray-400 mt-1">Lihat dan kelola laporan peminjaman</p>
            </div>
        </div>
    </div>
</a>

<!-- Laporan Pengembalian -->
<a href="#" class="block transition-transform hover:scale-[1.01]">
    <div class="report-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50 cursor-pointer">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-full bg-[#e8a162]/10 flex items-center justify-center mr-4">
                <i class="fas fa-undo text-[#e8a162] text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">Laporan Pengembalian</h2>
                <p class="text-sm text-gray-400 mt-1">Lihat dan kelola laporan pengembalian</p>
            </div>
        </div>
    </div>
</a>

<!-- Laporan Statistik -->
<a href="#" class="block transition-transform hover:scale-[1.01]">
    <div class="report-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50 cursor-pointer">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-full bg-[#a162e8]/10 flex items-center justify-center mr-4">
                <i class="fas fa-chart-line text-[#a162e8] text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">Laporan Statistik</h2>
                <p class="text-sm text-gray-400 mt-1">Analisis data dan statistik</p>
            </div>
        </div>
    </div>
</a>
</html>
