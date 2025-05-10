<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="h-screen flex text-white font-sans relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_#202020,_#121212)]">

    <!-- Background Pattern Overlay -->
    <div class="absolute inset-0 z-0"
        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 10 10\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'1\' cy=\'1\' r=\'0.5\' fill=\'%23666\'/%3E%3C/svg%3E'); opacity: 0.03;">
    </div>

    <!-- Left Image -->
    <div class="w-[35%] bg-cover bg-center z-10" style="background-image: url('{{ asset('assets/sarpas2.png') }}')"></div>

    <!-- Right Form Section -->
    <div class="w-[65%] flex justify-center items-center relative z-10">
        <!-- Decorative Circles -->
        <div
            class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-30 bottom-[-60px] left-[-60px] blur-sm">
        </div>
        <div
            class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-30 bottom-[-100px] right-[-80px] blur-sm">
        </div>
        <div
            class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-30 top-[-40px] right-[-40px] rotate-45 blur-sm">
        </div>
        <div class="absolute w-[150px] h-[150px] bg-[#7d85e1] rounded-full opacity-25 top-[20%] left-[5%] blur-sm">
        </div>
        <div class="absolute w-[100px] h-[100px] bg-[#4d59c6] rounded-full opacity-30 top-[30%] right-[10%] blur-sm">
        </div>
        <div class="absolute w-[250px] h-[250px] bg-[#3a3f7d] rounded-full opacity-20 bottom-[10%] right-[30%] blur-sm">
        </div>

        <!-- Tambahan lingkaran gerak -->
        <div
            class="absolute w-[200px] h-[200px] bg-[#5d6abf] rounded-full opacity-30 bottom-[-60px] left-[-60px] blur-sm animate-float">
        </div>
        <div
            class="absolute w-[300px] h-[300px] bg-[#2f3e8a] rounded-full opacity-30 bottom-[-100px] right-[-80px] blur-sm animate-drift">
        </div>
        <div
            class="absolute w-[120px] h-[120px] bg-[#6a5acd] rounded-full opacity-30 top-[-40px] right-[-40px] rotate-45 blur-sm animate-float">
        </div>

        <!-- Form Card dengan animasi fadeInUp -->
        <div
            class="w-full max-w-xl bg-[#1e1e1e]/95 backdrop-blur-lg rounded-2xl px-20 py-16 shadow-2xl z-10 animate-fadeInUp">
            <h2 class="text-[48px] font-light mb-2 h-[100px] text-center">Welcome</h2>
            <p class="text-2xl mb-16 text-center">Login</p>


            @if ($errors->any())
                <div class="bg-[#660000] text-[#ffcccc] text-sm mb-5 p-3 rounded shadow-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/login" class="w-full">
                @csrf
                <div class="mb-10">
                    <label for="email" class="block text-sm text-[#ccc] mb-1">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        class="w-full bg-transparent border-b border-[#666] py-2 text-white text-base focus:outline-none focus:border-[#6aa6ff]">
                </div>
                <div class="mb-10">
                    <label for="password" class="block text-sm text-[#ccc] mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-transparent border-b border-[#666] py-2 text-white text-base focus:outline-none focus:border-[#6aa6ff]">
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('register') }}">
                        <button type="button"
                            class="text-lg text-[#6aa6ff] hover:underline transition duration-200">Register</button>
                    </a>
                    <button type="submit"
                        class="bg-[#6aa6ff] text-white py-2 px-5 rounded text-base hover:bg-blue-500 transition duration-300 shadow-md">
                        Submit
                    </button>
                </div>
            </form>
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

                @keyframes fadeInUp {
                    0% {
                        opacity: 0;
                        transform: translateY(30px);
                    }

                    100% {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-float {
                    animation: float 3s ease-in-out infinite;
                }

                .animate-drift {
                    animation: drift 4s ease-in-out infinite;
                }

                .animate-fadeInUp {
                    animation: fadeInUp 1s ease-out forwards;
                }
            }
        </style>

    </div>
</body>

</html>
