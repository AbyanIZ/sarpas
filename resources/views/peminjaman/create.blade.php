<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-hidden">
    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.03;">
    </div>

    <div class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-30 bottom-[-60px] left-[-60px] blur-sm z-0"></div>
    <div class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-30 bottom-[-100px] right-[-80px] blur-sm z-0"></div>
    <div class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-30 top-[-40px] right-[-40px] blur-sm z-0"></div>
    <div class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-25 top-[20%] left-[5%] blur-sm z-0"></div>
    <div class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-30 top-[30%] right-[10%] blur-sm z-0 animate-float"></div>
    <div class="absolute w-[250px] h-[250px] bg-[#3a3f7d] rounded-full opacity-20 bottom-[10%] right-[30%] blur-sm z-0 animate-drift"></div>
    <div class="absolute w-[180px] h-[180px] bg-[#7a6ee9] rounded-full opacity-25 top-[35%] left-[35%] blur-md z-0 animate-float"></div>
    <div class="absolute w-[140px] h-[140px] bg-[#5f6ee6] rounded-full opacity-20 top-[9%] right-[18%] blur-md ring-2 ring-[#6aa6ff]/20 z-0 animate-drift"></div>

    <nav class="bg-[#1e1e1e]/90 backdrop-blur-md px-10 py-4 shadow-lg z-10 relative flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Form Peminjaman Barang</h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:text-[#6aa6ff] transition duration-200">Log out</button>
            </form>
            <div class="w-10 h-10 flex items-center">
                <img src="/assets/OIP.jpeg" alt="Profile" class="w-8 h-8 rounded-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex flex-col min-h-screen">
        <main class="flex-1 p-10 z-10 overflow-auto">
            @if (session('success'))
                <div id="success-alert"
                    class="fixed top-6 left-1/2 -translate-x-1/2 bg-green-600 text-white px-6 py-3 rounded-xl shadow-xl z-50 opacity-0 transition-opacity duration-500 ease-out">
                    {{ session('success') }}
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            requestAnimationFrame(() => {
                                alert.classList.remove('opacity-0');
                                alert.classList.add('opacity-100');
                            });
                            setTimeout(() => {
                                alert.classList.remove('opacity-100');
                                alert.classList.add('opacity-0');
                                setTimeout(() => alert.remove(), 500);
                            }, 3000);
                        }
                    });
                </script>
            @endif

            @if (session('error'))
                <div id="error-alert"
                    class="fixed top-6 left-1/2 -translate-x-1/2 bg-red-600 text-white px-6 py-3 rounded-xl shadow-xl z-50 opacity-0 transition-opacity duration-500 ease-out">
                    {{ session('error') }}
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const alert = document.getElementById('error-alert');
                        if (alert) {
                            requestAnimationFrame(() => {
                                alert.classList.remove('opacity-0');
                                alert.classList.add('opacity-100');
                            });
                            setTimeout(() => {
                                alert.classList.remove('opacity-100');
                                alert.classList.add('opacity-0');
                                setTimeout(() => alert.remove(), 500);
                            }, 3000);
                        }
                    });
                </script>
            @endif

            <div class="max-w-xl mx-auto bg-[#1f1f1f]/80 p-6 rounded-2xl shadow-lg border border-[#333] mt-10 text-white">
                <a href="{{ route('peminjaman.index') }}" class="text-[#6aa6ff] hover:underline mb-4 inline-block">← Kembali</a>
                <h2 class="text-xl font-bold mb-4">Ajukan Peminjaman Barang</h2>

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Peminjam:</label>
                        <div class="px-4 py-2 rounded bg-[#2a2a2a]">{{ Auth::user()->name }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="barang_id" class="block text-sm font-medium mb-1">Pilih Barang:</label>
                        <select name="barang_id" id="barang_id"
                            class="w-full px-4 py-2 rounded bg-[#2a2a2a] text-white focus:ring-2 focus:ring-[#6aa6ff] focus:outline-none" required>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium mb-1">Jumlah:</label>
                        <input type="number" name="jumlah" id="jumlah" min="1"
                            class="w-full px-4 py-2 rounded bg-[#2a2a2a] text-white focus:ring-2 focus:ring-[#6aa6ff] focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_pinjam" class="block text-sm font-medium mb-1">Tanggal Pinjam:</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                            class="w-full px-4 py-2 rounded bg-[#2a2a2a] text-white focus:ring-2 focus:ring-[#6aa6ff] focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_kembali" class="block text-sm font-medium mb-1">Tanggal Kembali:</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                            class="w-full px-4 py-2 rounded bg-[#2a2a2a] text-white focus:ring-2 focus:ring-[#6aa6ff] focus:outline-none" required>
                    </div>

                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded transition-transform hover:scale-105">
                        Ajukan
                    </button>
                </form>
            </div>
        </main>
    </div>
    <style type="text/tailwindcss">
        @layer utilities {
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
            @keyframes drift {
                0% { transform: translate(0, 0) rotate(0deg); }
                50% { transform: translate(10px, -10px) rotate(4deg); }
                100% { transform: translate(0, 0) rotate(0deg); }
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
