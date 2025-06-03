<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - SARPAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-drift {
            animation: drift 8s ease-in-out infinite;
        }

        .animate-pulse {
            animation: pulse 2s ease-in-out infinite;
        }

        .animate-rotate {
            animation: rotate 20s linear infinite;
        }

        .sidebar-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-item:hover {
            transform: translateX(4px);
        }

        .data-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(106, 166, 255, 0.1);
            background-color: #2a2a2a;
        }

        .chart-container {
            position: relative;
            height: 200px;
            width: 100%;
        }

        .calendar-day {
            transition: all 0.2s ease;
        }

        .calendar-day:hover {
            transform: scale(1.05);
            background-color: #3a3a3a;
        }

        .current-day {
            background-color: #6aa6ff;
            color: white;
            font-weight: bold;
        }

        .chart-hover-effect:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .glow {
            filter: drop-shadow(0 0 8px rgba(106, 166, 255, 0.6));
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
            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
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
        <!-- Sidebar -->
        <aside
            class="w-64 bg-[#181818]/90 py-8 px-6 border-r border-[#333]/50 min-h-screen relative z-10 backdrop-blur-sm">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center py-4 px-5 rounded-lg bg-gradient-to-r from-[#2f2f2f] to-[#2f2f2f]/70 hover:from-[#333] hover:to-[#333]/70 transition shadow-md sidebar-item">
                        <i class="fas fa-tachometer-alt text-[#6aa6ff] mr-4"></i>
                        <span class="font-medium">Dashboard</span>
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
                        class="flex items-center py-4 px-5 rounded-lg hover:bg-[#2f2f2f]/50 transition sidebar-item">
                        <i class="fas fa-file-alt text-gray-300 mr-4"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 z-10">
            @if ($pendingPeminjaman > 0)
                <div class="bg-[#2f2f2f] p-4 rounded-lg mb-6 border-l-4 border-[#6aa6ff] shadow-md flex items-center">
                    <i class="fas fa-bell text-[#6aa6ff] mr-3"></i>
                    <p class="text-sm text-[#6aa6ff]">Ada {{ $pendingPeminjaman }} permintaan peminjaman baru yang
                        menunggu persetujuan.</p>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div
                    class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#6aa6ff]/10 flex items-center justify-center mr-4">
                            <i class="fas fa-user-shield text-[#6aa6ff] text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Jumlah Admin</h2>
                            <p class="text-4xl font-bold text-[#6aa6ff] mt-2">{{ $jumlahAdmin }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#a162e8]/10 flex items-center justify-center mr-4">
                            <i class="fas fa-users text-[#a162e8] text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Jumlah User</h2>
                            <p class="text-4xl font-bold text-[#a162e8] mt-2">{{ $jumlahUser }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-[#5abf6a]/10 flex items-center justify-center mr-4">
                            <i class="fas fa-boxes text-[#5abf6a] text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Jumlah Barang</h2>
                            <p class="text-4xl font-bold text-[#5abf6a] mt-2">{{ $jumlahBarang }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar and Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar -->
                <div
                    class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Kalender</h2>
                        <div class="flex items-center space-x-2">
                            <button id="prevMonth" class="p-1 rounded-full hover:bg-[#3a3a3a] transition">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                            <button id="nextMonth" class="p-1 rounded-full hover:bg-[#3a3a3a] transition">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div id="calendar" class="mt-4">
                        <div class="text-center mb-4">
                            <h3 id="currentMonthYear" class="text-lg font-semibold"></h3>
                        </div>
                        <div class="grid grid-cols-7 gap-1 mb-2">
                            <div class="text-center text-xs font-medium text-gray-400">M</div>
                            <div class="text-center text-xs font-medium text-gray-400">S</div>
                            <div class="text-center text-xs font-medium text-gray-400">S</div>
                            <div class="text-center text-xs font-medium text-gray-400">R</div>
                            <div class="text-center text-xs font-medium text-gray-400">K</div>
                            <div class="text-center text-xs font-medium text-gray-400">J</div>
                            <div class="text-center text-xs font-medium text-gray-400">S</div>
                        </div>
                        <div id="calendarDays" class="grid grid-cols-7 gap-1"></div>
                    </div>
                </div>

                <!-- Enhanced User Distribution Chart -->
                <div
                    class="data-card bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] p-6 rounded-xl border border-[#333]/50 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Distribusi Pengguna</h2>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#6aa6ff] mr-2 animate-pulse"></div>
                                <span class="text-sm">Admin</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#a162e8] mr-2 animate-pulse"></div>
                                <span class="text-sm">User</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container relative">
                        <!-- Animated background circles -->
                        <div class="absolute inset-0 flex items-center justify-center z-0">
                            <div class="w-[180px] h-[180px] rounded-full border-2 border-[#6aa6ff]/20 animate-rotate">
                            </div>
                            <div class="absolute w-[160px] h-[160px] rounded-full border-2 border-[#a162e8]/20 animate-rotate"
                                style="animation-direction: reverse;"></div>
                        </div>
                        <canvas id="userDistributionChart" class="relative z-10 chart-hover-effect"></canvas>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4">
                        <div class="bg-[#2a2a2a] p-3 rounded-lg transition hover:bg-[#2f2f2f]">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-400">Total Admin</span>
                                <span class="text-[#6aa6ff] font-bold">{{ $jumlahAdmin }}</span>
                            </div>
                            <div class="h-1 w-full bg-[#333] mt-2">
                                <div class="h-1 bg-[#6aa6ff] transition-all duration-500"
                                    style="width: {{ ($jumlahAdmin / ($jumlahAdmin + $jumlahUser)) * 100 }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ round(($jumlahAdmin / ($jumlahAdmin + $jumlahUser)) * 100) }}% dari total</div>
                        </div>
                        <div class="bg-[#2a2a2a] p-3 rounded-lg transition hover:bg-[#2f2f2f]">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-400">Total User</span>
                                <span class="text-[#a162e8] font-bold">{{ $jumlahUser }}</span>
                            </div>
                            <div class="h-1 w-full bg-[#333] mt-2">
                                <div class="h-1 bg-[#a162e8] transition-all duration-500"
                                    style="width: {{ ($jumlahUser / ($jumlahAdmin + $jumlahUser)) * 100 }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ round(($jumlahUser / ($jumlahAdmin + $jumlahUser)) * 100) }}% dari total</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Enhanced User Distribution Chart with more effects
        const userCtx = document.getElementById('userDistributionChart').getContext('2d');

        // Create gradient for each segment
        const adminGradient = userCtx.createLinearGradient(0, 0, 0, 200);
        adminGradient.addColorStop(0, 'rgba(106, 166, 255, 0.9)');
        adminGradient.addColorStop(1, 'rgba(106, 166, 255, 0.4)');

        const userGradient = userCtx.createLinearGradient(0, 0, 0, 200);
        userGradient.addColorStop(0, 'rgba(161, 98, 232, 0.9)');
        userGradient.addColorStop(1, 'rgba(161, 98, 232, 0.4)');

        const userChart = new Chart(userCtx, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'User'],
                datasets: [{
                    data: [{{ $jumlahAdmin }}, {{ $jumlahUser }}],
                    backgroundColor: [
                        adminGradient,
                        userGradient
                    ],
                    borderColor: [
                        'rgba(106, 166, 255, 1)',
                        'rgba(161, 98, 232, 1)'
                    ],
                    borderWidth: 2,
                    cutout: '70%',
                    borderRadius: 10,
                    spacing: 5,
                    hoverBackgroundColor: [
                        'rgba(106, 166, 255, 1)',
                        'rgba(161, 98, 232, 1)'
                    ],
                    hoverBorderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        },
                        bodyFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        displayColors: false,
                        backgroundColor: '#2a2a2a',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#333',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                onHover: (event, chartElement) => {
                    const canvas = document.getElementById('userDistributionChart');
                    if (chartElement.length) {
                        canvas.classList.add('glow');
                    } else {
                        canvas.classList.remove('glow');
                    }
                }
            },
            plugins: [{
                    id: 'centerText',
                    beforeDraw: function(chart) {
                        const width = chart.width,
                            height = chart.height,
                            ctx = chart.ctx;

                        ctx.restore();

                        // Draw outer circle glow effect
                        ctx.beginPath();
                        ctx.arc(width / 2, height / 2, (Math.min(width, height) / 2) - 5, 0, 2 * Math.PI);
                        ctx.shadowColor = 'rgba(106, 166, 255, 0.3)';
                        ctx.shadowBlur = 15;
                        ctx.shadowOffsetX = 0;
                        ctx.shadowOffsetY = 0;
                        ctx.strokeStyle = 'transparent';
                        ctx.stroke();
                        ctx.shadowColor = 'transparent';

                        // Draw center text
                        const fontSize = (height / 8).toFixed(2);
                        ctx.font = `bold ${fontSize}px sans-serif`;
                        ctx.textBaseline = 'middle';
                        ctx.fillStyle = '#fff';

                        const text = 'Total',
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2 - (fontSize / 2);

                        ctx.fillText(text, textX, textY);

                        const total = {{ $jumlahAdmin }} + {{ $jumlahUser }};
                        const totalText = total.toString(),
                            totalFontSize = (height / 5).toFixed(2);

                        ctx.font = `bold ${totalFontSize}px sans-serif`;
                        const totalX = Math.round((width - ctx.measureText(totalText).width) / 2),
                            totalY = height / 2 + (fontSize / 2);

                        ctx.fillText(totalText, totalX, totalY);
                        ctx.save();
                    }
                },
                {
                    id: 'hoverEffect',
                    afterDraw: function(chart) {
                        if (chart.tooltip._active && chart.tooltip._active.length) {
                            const activePoint = chart.tooltip._active[0];
                            const {
                                x,
                                y
                            } = activePoint.element;
                            const radius = activePoint.element.outerRadius + 5;

                            const ctx = chart.ctx;
                            ctx.save();
                            ctx.beginPath();
                            ctx.arc(x, y, radius, 0, 2 * Math.PI);
                            ctx.fillStyle = 'rgba(255, 255, 255, 0.1)';
                            ctx.fill();
                            ctx.restore();
                        }
                    }
                }
            ]
        });

        // Add click event to chart segments
        document.getElementById('userDistributionChart').onclick = function(evt) {
            const points = userChart.getElementsAtEventForMode(evt, 'nearest', {
                intersect: true
            }, true);
            if (points.length) {
                const firstPoint = points[0];
                const label = userChart.data.labels[firstPoint.index];
                const value = userChart.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];

                // Add animation effect on click
                const segment = userChart.getDatasetMeta(0).data[firstPoint.index];
                const scale = 1.1;

                userChart.draw();
                userChart.ctx.save();
                userChart.ctx.translate(segment.x, segment.y);
                userChart.ctx.scale(scale, scale);
                userChart.ctx.translate(-segment.x, -segment.y);
                segment.draw(userChart.ctx);
                userChart.ctx.restore();

                console.log(`Clicked on ${label} with value ${value}`);
            }
        };

        // Calendar Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const currentMonthYear = document.getElementById('currentMonthYear');
            const calendarDays = document.getElementById('calendarDays');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');

            let currentDate = new Date();
            let currentMonth = currentDate.getMonth();
            let currentYear = currentDate.getFullYear();
            const today = new Date();

            function renderCalendar(month, year) {
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const daysInMonth = lastDay.getDate();
                const startingDay = firstDay.getDay();

                // Adjust starting day to match Indonesian calendar (Monday first)
                const startingDayAdjusted = startingDay === 0 ? 6 : startingDay - 1;

                currentMonthYear.textContent = new Intl.DateTimeFormat('id-ID', {
                    month: 'long',
                    year: 'numeric'
                }).format(firstDay);

                calendarDays.innerHTML = '';

                // Add empty cells for days before the first day of the month
                for (let i = 0; i < startingDayAdjusted; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'h-8 w-8 rounded-full';
                    calendarDays.appendChild(emptyDay);
                }

                // Add days of the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className =
                        'calendar-day h-8 w-8 rounded-full flex items-center justify-center text-sm cursor-pointer';

                    // Highlight current day
                    if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                        dayElement.classList.add('current-day');
                    } else {
                        dayElement.classList.add('hover:bg-[#3a3a3a]');
                    }

                    dayElement.textContent = day;
                    dayElement.addEventListener('click', function() {
                        // Remove current-day class from all days
                        document.querySelectorAll('.calendar-day').forEach(el => {
                            el.classList.remove('current-day');
                        });
                        // Add to clicked day
                        this.classList.add('current-day');
                    });
                    calendarDays.appendChild(dayElement);
                }
            }

            // Navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar(currentMonth, currentYear);
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar(currentMonth, currentYear);
            });

            // Initial render
            renderCalendar(currentDate.getMonth(), currentDate.getFullYear());
        });
    </script>
</body>

</html>
