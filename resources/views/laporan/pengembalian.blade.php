<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Pengembalian Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes drift {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(12px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-drift {
            animation: drift 8s ease-in-out infinite;
        }

        .data-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(106, 166, 255, 0.1);
        }

        .btn-primary {
            background-image: linear-gradient(to right, #6aa6ff, #4d73e6);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-image: linear-gradient(to right, #5a95e8, #3f63d4);
            transform: scale(1.02);
        }
    </style>
</head>

<body class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-x-hidden">

    <!-- Background -->
    <div class="absolute inset-0 z-0"
        style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity:0.05;">
    </div>
    <div
        class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-25 bottom-[-60px] left-[-60px] blur-md z-0 animate-drift">
    </div>
    <div
        class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-25 bottom-[-100px] right-[-80px] blur-md z-0 animate-drift">
    </div>
    <div
        class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-25 top-[-40px] right-[-40px] blur-md z-0 animate-drift">
    </div>
    <div
        class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-20 top-[20%] left-[5%] blur-md z-0 animate-float">
    </div>
    <div
        class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-25 top-[30%] right-[10%] blur-md z-0 animate-float">
    </div>
    <div
        class="absolute w-[180px] h-[180px] bg-[#7a6ee9] rounded-full opacity-20 top-[35%] left-[35%] blur-lg z-0 animate-float">
    </div>

    <!-- Navbar -->
    <nav class="bg-[#1e1e1e]/95 backdrop-blur-md px-8 py-4 shadow-lg z-10 relative flex justify-between items-center border-b border-[#333]/50">
        <h1 class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent flex items-center">
            <i class="fas fa-file-alt mr-2"></i>Laporan Pengembalian Barang
        </h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-300 hover:text-[#6aa6ff] transition duration-200 flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> <span>Log out</span>
                </button>
            </form>
            <div class="w-9 h-9 flex items-center rounded-full overflow-hidden border-2 border-[#6aa6ff]/50">
                <img src="{{ asset('assets/OIP.jpeg') }}" alt="Profile" class="w-full h-full object-cover" />
            </div>
        </div>
    </nav>

    <main class="flex-1 p-8 z-10 relative">

        @if (session('success'))
            <div id="success-alert"
                class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-600/90 text-white px-6 py-3 rounded-xl shadow-xl z-50 border border-green-500/30 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('laporan') }}" class="text-[#6aa6ff] hover:underline flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <a href="{{ route('laporan.pengembalian.export') }}"
                class="btn-primary inline-flex items-center px-5 py-2 rounded-lg text-white font-semibold shadow-md hover:shadow-lg transition">
                <i class="fas fa-file-excel mr-2"></i> Export ke Excel
            </a>
        </div>

        <!-- Tabel laporan pengembalian -->
        <div class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl shadow-lg border border-[#333]/50 overflow-x-auto max-w-full">
            <table id="laporanTable" class="w-full divide-y divide-gray-700/50">
                <thead class="bg-gray-800/50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-user mr-1 text-[#6aa6ff]"></i> Nama Pengembali
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-box mr-1 text-[#6aa6ff]"></i> Barang
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-1 text-[#6aa6ff]"></i> Jumlah
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-user-check mr-1 text-[#6aa6ff]"></i> Keterangan
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-info-circle mr-1 text-[#6aa6ff]"></i> Status
                        </th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-300 uppercase tracking-wider">
                            <i class="fas fa-calendar-check mr-1 text-[#6aa6ff]"></i> Tanggal Pengembalian
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-[#1f1f1f]/30 divide-y divide-gray-700/30">
                    @forelse ($pengembalians as $pengembalian)
                        <tr class="hover:bg-[#2a2a2a]/50 transition-colors text-center">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $pengembalian->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $pengembalian->barang->nama_barang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-white font-semibold">{{ $pengembalian->jumlah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                @if ($pengembalian->keterangan)
                                    <span class="bg-gray-700/50 px-2 py-1 rounded text-xs">{{ $pengembalian->keterangan }}</span>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada keterangan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($pengembalian->status == 'pending')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @elseif($pengembalian->status == 'approved')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                @elseif($pengembalian->status == 'selesai')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-400">
                                        <i class="fas fa-check-double mr-1"></i>Selesai
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-400 font-mono">
                                {{ $pengembalian->tanggal_pengembalian ? \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->translatedFormat('d F Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-400 italic">Data pengembalian tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>
