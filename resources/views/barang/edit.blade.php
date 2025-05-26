<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang - SARPAS</title>
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
            <i class="fas fa-boxes mr-2"></i>Edit Barang
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
                <img src="{{ asset('assets/OIP.jpeg') }}" alt="Profile" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <div class="flex">
        <main class="flex-1 p-8 z-10">
            <div class="max-w-md mx-auto form-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-8 rounded-xl shadow-lg border border-[#333]/50">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                        <i class="fas fa-box-open text-[#6aa6ff] text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold">Form Edit Barang</h2>
                </div>

                @if (session('success'))
                    <div class="mb-5 p-3 bg-green-700/20 text-green-400 rounded border border-green-700/30">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama_barang" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-tag mr-2 text-[#6aa6ff]"></i>Nama Barang
                        </label>
                        <input type="text" name="nama_barang" id="nama_barang"
                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-align-left mr-2 text-[#6aa6ff]"></i>Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-layer-group mr-2 text-[#6aa6ff]"></i>Stock
                        </label>
                        <input type="number" name="stock" id="stock"
                            value="{{ old('stock', $barang->stock) }}"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false">
                    </div>

                    <div>
                        <label for="kategori_id" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-tags mr-2 text-[#6aa6ff]"></i>Kategori
                        </label>
                        <select name="kategori_id" id="kategori_id"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-image mr-2 text-[#6aa6ff]"></i>Gambar
                        </label>
                        <input type="file" name="gambar" id="gambar"
                            class="w-full px-4 py-2 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]">
                        @if ($barang->gambar)
                            <div class="mt-3 flex justify-center">
                                <img src="{{ asset('storage/' . $barang->gambar) }}"
                                     class="w-32 h-32 object-cover rounded-lg shadow-lg border border-gray-600/50">
                            </div>
                        @endif
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-[#6aa6ff] to-[#4d73e6] hover:from-[#5a95e8] hover:to-[#3f63d4] text-white font-semibold py-3 px-4 rounded-lg transition-transform transform hover:scale-[1.02] flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>Update Barang
                        </button>

                        <a href="{{ route('barang.index') }}"
                            class="flex-1 bg-gradient-to-r from-[#f1f5f9] to-[#e2e8f0] hover:from-[#e2e8f0] hover:to-[#cbd5e1] text-gray-800 font-semibold py-3 px-4 rounded-lg transition-transform transform hover:scale-[1.02] flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('barang.index') }}" class="text-[#6aa6ff] hover:underline flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Barang
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
