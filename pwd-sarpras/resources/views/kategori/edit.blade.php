<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Kategori Barang - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen font-sans bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)] text-white relative overflow-hidden">

    <!-- Background Pattern -->
    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.03;">
    </div>

    <!-- Decorative Circles -->
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

    <!-- NAVBAR -->
    <nav class="bg-[#1e1e1e]/90 backdrop-blur-md px-10 py-4 shadow-lg z-10 relative flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Edit Kategori Barang</h1>
        <div class="flex items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white hover:text-[#6aa6ff] transition duration-200">Log out</button>
            </form>
            <div class="w-10 h-10 flex items-center">
                <img src="{{ asset('assets/OIP.jpeg') }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="flex">
        <main class="flex-1 p-10 z-10">
            <div
                class="max-w-md mx-auto bg-[#1f1f1f]/80 p-6 rounded-2xl shadow-lg border border-[#333] mt-10 text-white">
                <h2 class="text-xl font-bold mb-4">Edit Kategori Barang</h2>

                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_kategori" class="block text-sm font-medium mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                            class="w-full px-4 py-2 rounded bg-[#2a2a2a] text-white focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false">
                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition-transform hover:scale-105">
                        Update
                    </button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('kategori.index') }}" class="text-blue-400 hover:underline">← Kembali ke
                        daftar</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Custom Animations -->
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
