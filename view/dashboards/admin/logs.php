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
                        <p class="text-3xl font-bold mt-2">
                            <?= number_format($totalLogins) ?>
                        </p>
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
                        <p class="text-gray-400 text-sm">Failed Attempts</p>
                        <p class="text-3xl font-bold mt-2"><?= number_format($failedLogins) ?></p>
                    </div>
                    <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-red-400 text-sm mt-4"><?= $failedPercentage ?>% of total logins</p>
            </div>

            <div class="bg-gray-800 p-5 rounded-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 text-sm">Locked Device</p>
                        <p class="text-3xl font-bold mt-2"><?= number_format($lockedAccounts) ?></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-lock text-yellow-400 text-xl"></i>
                    </div>
                </div>
                <p class="text-yellow-400 text-sm mt-4"><?= $lockedToday ?> new today</p>
            </div>
        </div>

        <div class="bg-gray-800 p-5 rounded-xl mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Device & Browser Summary</h2>
            </div>
            <!-- User Agent Summary -->
            <div class="bg-gray-800 p-5 rounded-xl mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($deviceSummary as $device): ?>
                        <div class="bg-gray-900 p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                    <?php if ($device['device'] === 'Windows'): ?>
                                        <i class="fab fa-windows text-blue-400"></i>
                                    <?php elseif ($device['device'] === 'Linux'): ?>
                                        <i class="fab fa-linux text-orange-400"></i>
                                    <?php elseif ($device['device'] === 'macOS'): ?>
                                        <i class="fab fa-apple text-gray-300"></i>
                                    <?php elseif ($device['device'] === 'Android'): ?>
                                        <i class="fab fa-android text-green-400"></i>
                                    <?php else: ?>
                                        <i class="fas fa-question text-gray-400"></i>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <h3 class="font-medium"><?= htmlspecialchars($device['device']) ?></h3>
                                    <p class="text-gray-400 text-sm">Detected device</p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-green-400">Successful logs:</span>
                                    <span class="font-medium"><?= (int) $device['total_success'] ?></span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-red-400">Error logs:</span>
                                    <span class="font-medium"><?= (int) $device['total_error'] ?></span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-yellow-400">Locked attempts:</span>
                                    <span class="font-medium"><?= (int) $device['total_locked'] ?></span>
                                </div>
                                <hr>
                                <form action="#">
                                    <div class="flex justify-end mt-5">
                                        <input type="hidden" value="<?= htmlspecialchars($devices['user_agent']) ?>">
                                        <input type="hidden" name="__method" value="DELETE">
                                        <button type="submit"
                                            class="flex items-center gap-1 text-xs bg-red-500 p-2 rounded-lg cursor-pointer">
                                            <i class="fa fa-trash"></i> Ban Device
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>


        <!-- Bar Graph with Chart.js -->
        <div class="bg-gray-800 p-5 rounded-xl mb-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Login Attempts - Last 7 Days</h2>
                <div class="text-gray-400 text-sm">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <?= $dateRange ?>
                </div>
            </div>

            <div class="h-64">
                <canvas id="loginChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-gray-800 rounded-xl overflow-hidden">
            <div class="p-5 border-b border-gray-700 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Recent Login Activity</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-900 text-gray-400 text-sm">
                            <th class="text-left py-3 px-4 font-medium">User</th>
                            <th class="text-left py-3 px-4 font-medium">Status</th>
                            <th class="text-left py-3 px-4 font-medium">Message</th>
                            <th class="text-left py-3 px-4 font-medium">Device/OS</th>
                            <th class="text-left py-3 px-4 font-medium">Time</th>
                            <th class="text-left py-3 px-4 font-medium">IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentLogs as $log): ?>
                            <?php
                            $statusColor = $log['status'] === 'success' ? 'green' : ($log['status'] === 'error' ? 'red' : 'yellow');
                            $statusText = $log['status'] === 'success' ? 'Success' : ($log['status'] === 'error' ? 'Failed' : 'Locked');
                            $iconClass = $log['status'] === 'success' ? 'fa-check' : ($log['status'] === 'error' ? 'fa-times' : 'fa-lock');
                            $userIconClass = $log['status'] === 'success' ? 'fa-user' : ($log['status'] === 'error' ? 'fa-user-slash' : 'fa-lock');
                            $bgColorClass = $log['status'] === 'success' ? '' : ($log['status'] === 'error' ? 'bg-red-500/5' : 'bg-yellow-500/5');
                            $ipColorClass = $log['status'] === 'error' ? 'text-red-300' : '';
                            ?>
                            <tr class="border-b border-gray-700 hover:bg-gray-750 <?= $bgColorClass ?>">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-<?= $statusColor ?>-500/20 rounded-full flex items-center justify-center">
                                            <i class="fas <?= $userIconClass ?> text-<?= $statusColor ?>-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium"><?= htmlspecialchars($log['display_email']) ?></p>
                                            <p class="text-gray-400 text-xs"><?= $log['user_id_display'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded text-xs bg-<?= $statusColor ?>-500/20 text-<?= $statusColor ?>-400">
                                        <i class="fas <?= $iconClass ?> mr-1"></i> <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="max-w-xs">
                                        <p class="text-sm truncate text-<?= $statusColor ?>-300"
                                            title="<?= htmlspecialchars($log['message']) ?>">
                                            <?= htmlspecialchars($log['message']) ?>
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <i
                                            class="<?= $log['device_info']['icon'] ?> text-<?= $log['device_info']['color'] ?>"></i>
                                        <span class="text-sm"><?= $log['device_info']['os'] ?> •
                                            <?= $log['device_info']['browser'] ?></span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm">
                                        <p><?= $log['time_ago'] ?></p>
                                        <p class="text-gray-400 text-xs"><?= $log['time_formatted'] ?></p>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm <?= $ipColorClass ?>"><?= $log['ip_address'] ?></span>
                                        <button class="text-gray-400 hover:text-white text-xs copy-ip"
                                            data-ip="<?= $log['ip_address'] ?>">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bulk Actions and Pagination -->
            <div class="p-4 border-t border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Chart.js Bar Graph
        const ctx = document.getElementById('loginChart').getContext('2d');

        const loginChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($chartLabels) ?>,
                datasets: [
                    {
                        label: 'Successful',
                        data: <?= json_encode($chartSuccess) ?>,
                        backgroundColor: '#3b82f6', // Blue
                        borderColor: '#3b82f6',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Failed',
                        data: <?= json_encode($chartError) ?>,
                        backgroundColor: '#ef4444', // Red
                        borderColor: '#ef4444',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Locked',
                        data: <?= json_encode($chartLocked) ?>,
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

        // Copy IP to clipboard functionality
        document.querySelectorAll('.copy-ip').forEach(button => {
            button.addEventListener('click', function () {
                const ip = this.getAttribute('data-ip');
                navigator.clipboard.writeText(ip).then(() => {
                    const originalIcon = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    setTimeout(() => {
                        this.innerHTML = originalIcon;
                    }, 2000);
                });
            });
        });
    </script>
</div>