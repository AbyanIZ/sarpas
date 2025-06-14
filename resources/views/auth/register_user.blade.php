<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru - SARPAS</title>
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
        <h1 class="text-2xl font-semibold bg-gradient-to-r from-[#6aa6ff] to-[#a162e8] bg-clip-text text-transparent">
            <i class="fas fa-user-plus mr-2"></i>Tambah User Baru
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
        <!-- Sidebar would go here if needed -->
        <main class="flex-1 p-8 z-10">
            <div class="max-w-md mx-auto form-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-8 rounded-xl shadow-lg border border-[#333]/50 mt-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-[#6aa6ff] text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold">Form Tambah User Baru</h2>
                </div>

                <form method="POST" action="{{ route('register.user.store') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-user mr-2 text-[#6aa6ff]"></i>Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-envelope mr-2 text-[#6aa6ff]"></i>Email
                        </label>
                        <input type="email" name="email" id="email"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required autocomplete="off">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-lock mr-2 text-[#6aa6ff]"></i>Password
                        </label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-2 text-gray-300">
                            <i class="fas fa-lock mr-2 text-[#6aa6ff]"></i>Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-3 rounded-lg bg-[#2f2f2f] border border-[#333] input-field focus:outline-none focus:ring-2 focus:ring-[#6aa6ff]"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#6aa6ff] to-[#4d73e6] hover:from-[#5a95e8] hover:to-[#3f63d4] text-white font-semibold py-3 px-4 rounded-lg transition-transform transform hover:scale-[1.02]">
                        <i class="fas fa-save mr-2"></i>Simpan User
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('pengguna') }}" class="text-[#6aa6ff] hover:underline flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke daftar user
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
