<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pengembalian Barang - SARPAS</title>
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

        .data-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

        .status-badge {
            @apply px-3 py-1 rounded-full text-xs font-semibold;
        }
    </style>
</head>

<body
    class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-x-hidden">

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
        <h1
            class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent flex items-center">
            <i class="fas fa-exchange-alt mr-2"></i>Pendataan Pengembalian Barang
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
                <img src="{{ asset('assets/OIP.jpeg') }}" alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex">
        <main class="flex-1 p-8 z-10">
            @if (session('success'))
                <div id="success-alert"
                    class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-600/90 text-white px-6 py-3 rounded-xl shadow-xl z-50 border border-green-500/30 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            setTimeout(() => {
                                alert.style.transition = 'opacity 0.5s ease-out';
                                alert.style.opacity = '0';
                                setTimeout(() => alert.remove(), 500);
                            }, 3000);
                        }
                    });
                </script>
            @endif

            <div class="mb-6">
                <a href="{{ route('pendataan') }}" class="text-[#6aa6ff] hover:underline flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-clipboard-list mr-3 text-[#6aa6ff]"></i>Daftar Pengembalian Barang
                </h2>
                <a href="{{ route('pengembalian.create') }}"
                    class="btn-primary text-white px-4 py-2 rounded-lg flex items-center">
                    <i class="fas fa-plus mr-2"></i>Ajukan Pengembalian
                </a>
            </div>

            <!-- Counter Card -->
            <div
                class="mb-6 px-6 py-4 bg-gradient-to-r from-[#1f1f1f] to-[#2a2a2a] rounded-xl shadow-lg border border-[#333]/50 w-max">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                        <i class="fas fa-boxes text-[#6aa6ff]"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-300">Total Pengembalian</p>
                        <p class="text-2xl font-bold">{{ $totalPengembalian }}</p>
                    </div>
                </div>
            </div>

            <div
                class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl shadow-lg border border-[#333]/50">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-700/50">
                        <thead class="bg-gray-800/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-user mr-1 text-[#6aa6ff]"></i> Nama
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-box mr-1 text-[#6aa6ff]"></i> Barang
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-camera mr-1 text-[#6aa6ff]"></i> Foto
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-layer-group mr-1 text-[#6aa6ff]"></i> Jumlah
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-1 text-[#6aa6ff]"></i> Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-calendar-alt mr-1 text-[#6aa6ff]"></i> Tanggal
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cog mr-1 text-[#6aa6ff]"></i> Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-[#1f1f1f]/30 divide-y divide-gray-700/30">
                            @forelse($pengembalians as $pengembalian)
                                <tr class="hover:bg-[#2a2a2a]/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pengembalian->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $pengembalian->barang?->nama_barang ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pengembalian->image)
                                            <a href="{{ asset('storage/' . $pengembalian->image) }}" target="_blank"
                                                class="inline-block group">
                                                <img src="{{ asset('storage/' . $pengembalian->image) }}"
                                                    alt="Foto Pengembalian"
                                                    class="w-16 h-16 object-cover rounded-md border border-gray-600 group-hover:ring-2 group-hover:ring-blue-400 transition" />
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $pengembalian->jumlah }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pengembalian->status == 'pending')
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-400 flex items-center w-max">
                                                <i class="fas fa-clock mr-1"></i>Pending
                                            </span>
                                        @elseif($pengembalian->status == 'approved')
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-400 flex items-center w-max">
                                                <i class="fas fa-check-circle mr-1"></i>Disetujui
                                            </span>
                                        @elseif($pengembalian->status == 'rejected')
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-semibold bg-red-500/20 text-red-400 flex items-center w-max">
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-500/20 text-gray-400 flex items-center w-max">
                                                <i class="fas fa-question-circle mr-1"></i>Unknown
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pengembalian->status == 'pending')
                                            <div class="flex space-x-2">
                                                <form action="{{ route('pengembalian.approve', $pengembalian->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-green-600/90 hover:bg-green-700 text-white rounded-lg text-sm flex items-center">
                                                        <i class="fas fa-check mr-1"></i> Setuju
                                                    </button>
                                                </form>
                                                <form action="{{ route('pengembalian.reject', $pengembalian->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-600/90 hover:bg-red-700 text-white rounded-lg text-sm flex items-center">
                                                        <i class="fas fa-times mr-1"></i> Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                                        <i class="fas fa-inbox mr-2"></i>Belum ada data pengembalian
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
