<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Barang - SARPAS</title>
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

        .item-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(106, 166, 255, 0.1);
            background-color: #2a2a2a;
        }

        .success-alert {
            animation: fadeInOut 3s ease-in-out forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>
</head>

<body class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-x-hidden">

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
            <i class="fas fa-boxes mr-2"></i>Daftar Barang
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

    <div class="flex">
        <main class="flex-1 p-8 z-10">
            @if (session('success'))
                <div class="success-alert fixed top-6 inset-x-0 mx-auto w-fit bg-green-600/90 text-white px-6 py-3 rounded-xl shadow-xl z-50 flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <a href="{{ route('pendataan') }}" class="text-[#6aa6ff] hover:underline inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Pendataan
                </a>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-list-ul text-[#6aa6ff] mr-3"></i>Daftar Inventaris Barang
                </h2>
                <a href="{{ route('barang.create') }}"
                    class="bg-gradient-to-r from-[#6aa6ff] to-[#4d73e6] hover:from-[#5a95e8] hover:to-[#3f63d4] text-white font-semibold px-4 py-2 rounded-lg transition-transform transform hover:scale-105 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Barang
                </a>
            </div>

            <div class="space-y-4">
                @foreach ($barangs as $barang)
                    <div class="item-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-5 rounded-xl border border-[#333]/50 flex items-center gap-6">
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}"
                                class="w-20 h-20 object-cover rounded-lg" />
                        @else
                            <div class="w-20 h-20 bg-[#2f2f2f] rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-gray-400 text-2xl"></i>
                            </div>
                        @endif

                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold">{{ $barang->nama_barang }}</h3>
                                <span class="text-sm px-3 py-1 rounded-full {{ $barang->stock > 0 ? 'bg-[#5abf6a]/20 text-[#5abf6a]' : 'bg-[#e8a162]/20 text-[#e8a162]' }}">
                                    {{ $barang->stock > 0 ? 'Tersedia' : 'Habis' }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <div class="text-sm">
                                    <span class="text-gray-400">Stock:</span>
                                    <span>{{ $barang->stock }}</span>
                                </div>
                                <div class="text-sm">
                                    <span class="text-gray-400">Kategori:</span>
                                    <span>{{ $barang->kategori ? $barang->kategori->nama_kategori : '-' }}</span>
                                </div>
                                <div class="text-sm col-span-2">
                                    <span class="text-gray-400">Deskripsi:</span>
                                    <span class="line-clamp-1">{{ $barang->deskripsi }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('barang.edit', $barang->id) }}"
                                class="bg-[#6aa6ff]/90 hover:bg-[#6aa6ff] text-white px-4 py-2 rounded-lg transition flex items-center">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            <form action="{{ route('barang.destroy', $barang->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-[#ff6a6a]/90 hover:bg-[#ff6a6a] text-white px-4 py-2 rounded-lg transition flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</body>
</html>
