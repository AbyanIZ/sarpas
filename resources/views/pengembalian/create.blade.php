<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Pengembalian Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

        .form-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(106, 166, 255, 0.1);
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(106, 166, 255, 0.3);
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

<body class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-hidden">

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
        <h1 class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent flex items-center">
            <i class="fas fa-exchange-alt mr-2"></i>Form Pengembalian Barang
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
                <img src="/assets/OIP.jpeg" alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex flex-col min-h-screen">
        <main class="flex-1 p-8 z-10 overflow-auto">
            @if ($errors->any())
                <div class="mb-6 bg-red-700/20 text-red-400 p-4 rounded-xl border border-red-700/30 max-w-xl mx-auto">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <h3 class="font-medium">Terdapat kesalahan dalam pengisian form</h3>
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

            <div class="max-w-md mx-auto form-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-8 rounded-xl shadow-lg border border-[#333]/50">
                <div class="mb-6">
                    <a href="{{ route('pengembalian.index') }}" class="text-[#6aa6ff] hover:underline flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Pengembalian
                    </a>
                </div>

                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                        <i class="fas fa-undo-alt text-[#6aa6ff] text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold">Formulir Pengembalian Barang</h2>
                </div>

                <form action="{{ route('pengembalian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label for="barang_id" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-box mr-2 text-[#6aa6ff]"></i>Pilih Barang yang Dipinjam
                        </label>
                        <select id="barang_id" name="barang_id" required
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">
                            <option value="" disabled selected>Pilih Barang Yang Dikembalikan</option>
                            @foreach ($peminjamans as $peminjaman)
                                <option value="{{ $peminjaman->barang->id }}" @selected(old('barang_id') == $peminjaman->barang->id)>
                                    {{ $peminjaman->barang->nama_barang }} (Dipinjam: {{ $peminjaman->jumlah }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-layer-group mr-2 text-[#6aa6ff]"></i>Jumlah Pengembalian
                        </label>
                        <input type="number" id="jumlah" name="jumlah" min="1" required
                            value="{{ old('jumlah') }}"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]" />
                    </div>

                    <div>
                        <label for="tanggal_pengembalian" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-calendar-day mr-2 text-[#6aa6ff]"></i>Tanggal Pengembalian
                        </label>
                        <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" required
                            value="{{ old('tanggal_pengembalian') }}"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]" />
                    </div>

                    <div>
                        <label for="foto_pengembalian" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-camera mr-2 text-[#6aa6ff]"></i>Foto Pengembalian
                            <span class="text-xs text-gray-400 block mt-1">(Format: JPG/PNG, Maks: 2MB)</span>
                        </label>
                        <input type="file" id="foto_pengembalian" name="foto_pengembalian" required
                            accept="image/jpeg,image/png"
                            class="w-full px-4 py-2 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]" />
                    </div>

                    <button type="submit" class="w-full btn-primary text-white font-semibold py-3 px-4 rounded-lg flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>Ajukan Pengembalian
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
