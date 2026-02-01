<div class="page-content" id="userlogs">
    <div class="bg-gray-900 text-gray-100 min-h-screen p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold">Login Activity Dashboard</h1>
            <p class="text-gray-400">Authentication monitoring and security logs</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gray-800 p-5 rounded-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 text-sm">Total Logins</p>
                        <p class="text-3xl font-bold mt-2">1,247</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-sign-in-alt text-blue-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-blue-400 text-sm mt-4">Last 30 days</p>
            </div>

            <div class="bg-gray-800 p-5 rounded-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 text-sm">Success Rate</p>
                        <p class="text-3xl font-bold mt-2">68%</p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-green-400 text-sm mt-4">+2% from last month</p>
            </div>

            <div class="bg-gray-800 p-5 rounded-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 text-sm">Failed Attempts</p>
                        <p class="text-3xl font-bold mt-2">298</p>
                    </div>
                    <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-red-400 text-sm mt-4">24% of total logins</p>
            </div>

            <div class="bg-gray-800 p-5 rounded-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 text-sm">Locked Accounts</p>
                        <p class="text-3xl font-bold mt-2">42</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-lock text-yellow-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-yellow-400 text-sm mt-4">3 new today</p>
            </div>
        </div>

        <!-- Bar Graph with Chart.js -->
        <div class="bg-gray-800 p-5 rounded-xl mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Login Attempts - Last 7 Days</h2>
                <div class="text-gray-400 text-sm">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Week of Jan 8-14
                </div>
            </div>

            <div class="h-64">
                <canvas id="loginChart"></canvas>
            </div>

            <div class="flex justify-center gap-6 mt-6 pt-6 border-t border-gray-700">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-blue-500 rounded"></div>
                    <span class="text-gray-300 text-sm">Successful Logins</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-500 rounded"></div>
                    <span class="text-gray-300 text-sm">Failed Attempts</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-yellow-500 rounded"></div>
                    <span class="text-gray-300 text-sm">Locked Attempts</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-gray-800 rounded-xl overflow-hidden">
            <div class="p-5 border-b border-gray-700">
                <h2 class="text-lg font-semibold">Recent Login Activity</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900 text-gray-400 text-sm">
                            <th class="text-left py-3 px-4 font-medium">User</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-left py-3 px-4 font-medium">Message</th>
                            <th class="text-left py-3 px-4 font-medium">Time</th>
                            <th class="text-left py-3 px-4 font-medium">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1: Success -->
                        <tr class="border-b border-gray-700 hover:bg-gray-750">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">john@example.com</p>
                                        <p class="text-gray-400 text-xs">ID: 245</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-500/20 text-green-400">
                                    <i class="fas fa-check mr-1"></i> Success
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate" title="Login successful">Login successful</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">
                                    <p>2 min ago</p>
                                    <p class="text-gray-400 text-xs">14:30:22</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm">192.168.1.100</span>
                                    <button class="text-gray-400 hover:text-white text-xs copy-ip">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 2: Failed -->
                        <tr class="border-b border-gray-700 hover:bg-gray-750 bg-red-500/5">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-red-500/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-slash text-red-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">unknown@attack.com</p>
                                        <p class="text-gray-400 text-xs">Unknown</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs bg-red-500/20 text-red-400">
                                    <i class="fas fa-times mr-1"></i> Failed
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate text-red-300" title="Invalid credentials">Invalid
                                        credentials</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">
                                    <p>5 min ago</p>
                                    <p class="text-gray-400 text-xs">14:27:15</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-red-300">185.220.101.34</span>
                                    <button class="text-gray-400 hover:text-white text-xs copy-ip">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 3: Success -->
                        <tr class="border-b border-gray-700 hover:bg-gray-750">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">jane@domain.com</p>
                                        <p class="text-gray-400 text-xs">ID: 128</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-500/20 text-green-400">
                                    <i class="fas fa-check mr-1"></i> Success
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate" title="Password verification successful">Password
                                        verification successful</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">
                                    <p>1 hour ago</p>
                                    <p class="text-gray-400 text-xs">13:45:08</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm">203.0.113.45</span>
                                    <button class="text-gray-400 hover:text-white text-xs copy-ip">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 4: Locked -->
                        <tr class="border-b border-gray-700 hover:bg-gray-750 bg-yellow-500/5">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-lock text-yellow-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">admin@system.com</p>
                                        <p class="text-gray-400 text-xs">ID: 001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs bg-yellow-500/20 text-yellow-400">
                                    <i class="fas fa-lock mr-1"></i> Locked
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate text-yellow-300"
                                        title="Account temporarily locked - too many failed attempts">Account
                                        temporarily locked</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">
                                    <p>3 hours ago</p>
                                    <p class="text-gray-400 text-xs">11:20:45</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm">45.134.26.78</span>
                                    <button class="text-gray-400 hover:text-white text-xs copy-ip">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Row 5: Suspicious -->
                        <tr class="hover:bg-gray-750 bg-orange-500/5">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-orange-500/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-orange-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">user123@gmail.com</p>
                                        <p class="text-gray-400 text-xs">ID: 189</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded text-xs bg-orange-500/20 text-orange-400">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Suspicious
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="max-w-xs">
                                    <p class="text-sm truncate text-orange-300" title="Unusual login location detected">
                                        Unusual login location</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm">
                                    <p>Yesterday</p>
                                    <p class="text-gray-400 text-xs">22:15:33</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm">10.0.0.15</span>
                                    <button class="text-gray-400 hover:text-white text-xs copy-ip">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Simple Pagination -->
            <div class="p-4 border-t border-gray-700 flex justify-center">
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-1 bg-blue-500 text-white rounded text-sm">1</button>
                    <button class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">2</button>
                    <button class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">3</button>
                    <button class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded text-sm">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Summary Footer -->
        <div class="mt-6 text-center text-gray-500 text-sm">
            <p>Auto-refresh every 60 seconds • Last updated: Just now</p>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Chart.js Bar Graph
        const ctx = document.getElementById('loginChart').getContext('2d');

        const loginChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [
                    {
                        label: 'Successful',
                        data: [126, 103, 158, 89, 114, 63, 52],
                        backgroundColor: '#3b82f6', // Blue
                        borderColor: '#3b82f6',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Failed',
                        data: [32, 28, 42, 36, 29, 25, 21],
                        backgroundColor: '#ef4444', // Red
                        borderColor: '#ef4444',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Locked',
                        data: [22, 27, 10, 23, 25, 37, 42],
                        backgroundColor: '#f59e0b', // Yellow
                        borderColor: '#f59e0b',
                        borderWidth: 1,
                        borderRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleColor: '#d1d5db',
                        bodyColor: '#d1d5db',
                        borderColor: '#374151',
                        borderWidth: 1,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: '#374151',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#9ca3af',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#374151',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#9ca3af',
                            callback: function (value) {
                                return value;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                }
            }
        });

        // Copy IP functionality
        document.querySelectorAll('.copy-ip').forEach(button => {
            button.addEventListener('click', function (e) {
                e.stopPropagation();
                const ip = this.parentElement.querySelector('span').textContent;
                navigator.clipboard.writeText(ip).then(() => {
                    const original = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = original;
                    }, 1500);
                });
            });
        });

        // Tooltip for truncated messages
        document.querySelectorAll('.truncate').forEach(element => {
            element.addEventListener('mouseenter', function () {
                if (this.offsetWidth < this.scrollWidth) {
                    this.setAttribute('title', this.textContent);
                }
            });
        });
    </script>
</div>