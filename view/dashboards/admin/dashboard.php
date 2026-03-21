<div class="page-content active" id="dashboard">
    <div class="flex items-center justify-between gap-2 mb-6 flex-wrap">
        <h2 class="text-2xl font-semibold">Dashboard Overview</h2>
        <div class="flex gap-3">
            <form method="GET" action="/adminDashboard" class="flex gap-2" id="dateRangeForm">
                <input type="hidden" name="tab" value="dashboard">
                <select name="date_range" onchange="this.form.submit()"
                    class="bg-gray-800 border border-gray-700 rounded-lg px-3 py-1.5 text-sm text-gray-300 focus:outline-none focus:ring-1 focus:ring-orange-500">
                    <option value="7" <?= ($_GET['date_range'] ?? '7') == '7' ? 'selected' : '' ?>>Last 7 Days</option>
                    <option value="30" <?= ($_GET['date_range'] ?? '7') == '30' ? 'selected' : '' ?>>Last 30 Days</option>
                    <option value="90" <?= ($_GET['date_range'] ?? '7') == '90' ? 'selected' : '' ?>>Last 90 Days</option>
                    <option value="180" <?= ($_GET['date_range'] ?? '7') == '180' ? 'selected' : '' ?>>Last 6 Months
                    </option>
                </select>
            </form>
            <div class="text-sm text-gray-400">
                <i class="fas fa-calendar-alt mr-1"></i>
                <?= date('F j, Y') ?>
            </div>
        </div>
    </div>

    <!-- Stats Grid - 4 Cards -->
    <div class="grid grid-cols-1 gap-5 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Members -->
        <div
            class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
                    <i class="fas fa-users text-blue-400 text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-bold"><?= number_format($userCount) ?></h3>
                <p class="text-gray-400 text-sm mt-1">Total Members</p>
                <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full"
                        style="width: <?= $userCount > 0 ? min(100, round(($userCount / 100) * 100)) : 0 ?>%"></div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div
            class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-full bg-green-500/20 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-400 text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-bold">₱<?= number_format($totalPayments, 2) ?></h3>
                <p class="text-gray-400 text-sm mt-1">Total Revenue</p>
                <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-green-500 rounded-full"
                        style="width: <?= $totalPayments > 0 ? min(100, round(($totalPayments / 50000) * 100)) : 0 ?>%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Feedback -->
        <div
            class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center">
                    <i class="fas fa-star text-purple-400 text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-bold"><?= number_format($totalFeedback) ?></h3>
                <p class="text-gray-400 text-sm mt-1">Total Feedback</p>
                <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-purple-500 rounded-full"
                        style="width: <?= $totalFeedback > 0 ? min(100, round(($totalFeedback / 50) * 100)) : 0 ?>%">
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Members -->
        <div
            class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-full bg-orange-500/20 flex items-center justify-center">
                    <i class="fas fa-dumbbell text-orange-400 text-xl"></i>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-bold"><?= number_format($activeStatusCount) ?></h3>
                <p class="text-gray-400 text-sm mt-1">Active Members</p>
                <div class="mt-2 h-1 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-orange-500 rounded-full"
                        style="width: <?= $userCount > 0 ? round(($activeStatusCount / $userCount) * 100) : 0 ?>%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3 Charts - Revenue, Membership Distribution, Login Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue Chart -->
        <div class="bg-gray-900 rounded-xl p-5 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Revenue Overview (Last <?= $dateRange ?> Days)</h3>
            </div>
            <div class="relative" style="height: 320px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Membership Distribution -->
        <div class="bg-gray-900 rounded-xl p-5 shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Membership Distribution (By Status)</h3>
            <div class="relative" style="height: 320px;">
                <canvas id="membershipChart"></canvas>
            </div>
            <div class="flex flex-wrap justify-center gap-3 mt-4 text-xs">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-500 mr-1"></div>
                    <span>Basic (<?= $basicCount ?>)</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-1"></div>
                    <span>Regular (<?= $regularCount ?>)</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-1"></div>
                    <span>Premium (<?= $premiumCount ?>)</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-yellow-500 mr-1"></div>
                    <span>Pending (<?= $pendingCount ?>)</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-1"></div>
                    <span>Expired (<?= $expiredCount ?>)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Activity Chart - Full Width -->
    <div class="grid grid-cols-1 gap-6 mb-8">
        <div class="bg-gray-900 rounded-xl p-5 shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Login Activity (Last 7 Days)</h3>
            <div class="relative" style="height: 350px;">
                <canvas id="loginChart"></canvas>
            </div>
        </div>
    </div>

    <?php require base_path('view/dashboards/admin/dashboards/recentPayments.php'); ?>
    <?php require base_path('view/dashboards/admin/dashboards/recentActivity.php'); ?>

</div>

<script>
    // Chart.js Initialization
    (function () {
        if (!window.dashboardCharts) {
            window.dashboardCharts = {
                revenueChart: null,
                membershipChart: null,
                loginChart: null,
                initialized: false
            };
        }

        function destroyAllCharts() {
            const charts = window.dashboardCharts;
            if (charts.revenueChart) {
                try { charts.revenueChart.destroy(); } catch (e) { }
                charts.revenueChart = null;
            }
            if (charts.membershipChart) {
                try { charts.membershipChart.destroy(); } catch (e) { }
                charts.membershipChart = null;
            }
            if (charts.loginChart) {
                try { charts.loginChart.destroy(); } catch (e) { }
                charts.loginChart = null;
            }
        }

        function initCharts() {
            destroyAllCharts();

            const charts = window.dashboardCharts;

            // Revenue Chart
            const revenueCanvas = document.getElementById('revenueChart');
            if (revenueCanvas) {
                const ctx = revenueCanvas.getContext('2d');
                ctx.clearRect(0, 0, revenueCanvas.width, revenueCanvas.height);

                const revenueLabels = <?= json_encode($revenueLabels) ?>;
                const revenueValues = <?= json_encode($revenueValues) ?>;
                const hasData = revenueValues.some(v => v > 0);

                if (!hasData) {
                    ctx.font = "14px Poppins";
                    ctx.fillStyle = "#9ca3af";
                    ctx.textAlign = "center";
                    ctx.fillText("No revenue data available", revenueCanvas.width / 2, revenueCanvas.height / 2);
                } else {
                    charts.revenueChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: revenueLabels,
                            datasets: [{
                                label: 'Revenue (₱)',
                                data: revenueValues,
                                borderColor: '#f97316',
                                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#f97316',
                                pointBorderColor: '#fff',
                                pointRadius: 3,
                                pointHoverRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { labels: { color: '#9ca3af' } },
                                tooltip: { callbacks: { label: function (context) { return '₱' + context.raw.toLocaleString(); } } }
                            },
                            scales: {
                                y: { beginAtZero: true, ticks: { color: '#9ca3af', callback: function (v) { return '₱' + v.toLocaleString(); } }, grid: { color: '#374151' } },
                                x: { ticks: { color: '#9ca3af', maxRotation: 45 }, grid: { color: '#374151' } }
                            }
                        }
                    });
                }
            }

            // Membership Distribution Chart
            const membershipCanvas = document.getElementById('membershipChart');
            if (membershipCanvas) {
                const ctx = membershipCanvas.getContext('2d');
                ctx.clearRect(0, 0, membershipCanvas.width, membershipCanvas.height);

                const basicPercent = <?= $basicPercent ?>;
                const regularPercent = <?= $regularPercent ?>;
                const premiumPercent = <?= $premiumPercent ?>;
                const pendingPercent = <?= $pendingPercent ?>;
                const expiredPercent = <?= $expiredPercent ?>;
                const hasData = basicPercent > 0 || regularPercent > 0 || premiumPercent > 0 || pendingPercent > 0 || expiredPercent > 0;

                if (!hasData) {
                    ctx.font = "14px Poppins";
                    ctx.fillStyle = "#9ca3af";
                    ctx.textAlign = "center";
                    ctx.fillText("No membership data available", membershipCanvas.width / 2, membershipCanvas.height / 2);
                } else {
                    charts.membershipChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Basic', 'Regular', 'Premium', 'Pending', 'Expired'],
                            datasets: [{
                                data: [basicPercent, regularPercent, premiumPercent, pendingPercent, expiredPercent],
                                backgroundColor: ['#3b82f6', '#22c55e', '#a855f7', '#eab308', '#ef4444'],
                                borderWidth: 0,
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom', labels: { color: '#9ca3af', boxWidth: 10, font: { size: 10 } } },
                                tooltip: { callbacks: { label: function (context) { return context.label + ': ' + context.raw + '%'; } } }
                            }
                        }
                    });
                }
            }

            // Login Activity Chart
            const loginCanvas = document.getElementById('loginChart');
            if (loginCanvas) {
                const ctx = loginCanvas.getContext('2d');
                ctx.clearRect(0, 0, loginCanvas.width, loginCanvas.height);

                const labels = <?= json_encode($chartLabels) ?>;
                const successData = <?= json_encode($chartSuccess) ?>;
                const errorData = <?= json_encode($chartError) ?>;

                const hasData = (successData.length > 0 && successData.some(v => v > 0)) || (errorData.length > 0 && errorData.some(v => v > 0));

                if (!hasData) {
                    ctx.font = "14px Poppins";
                    ctx.fillStyle = "#9ca3af";
                    ctx.textAlign = "center";
                    ctx.fillText("No login activity data available", loginCanvas.width / 2, loginCanvas.height / 2);
                } else {
                    const defaultLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                    const finalLabels = labels.length > 0 ? labels : defaultLabels;
                    const finalSuccess = successData.length > 0 ? successData : [0, 0, 0, 0, 0, 0, 0];
                    const finalError = errorData.length > 0 ? errorData : [0, 0, 0, 0, 0, 0, 0];

                    const maxValue = Math.max(Math.max(...finalSuccess), Math.max(...finalError), 1);
                    const yAxisMax = Math.ceil(maxValue * 1.2);

                    charts.loginChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: finalLabels,
                            datasets: [
                                { label: 'Successful Logins', data: finalSuccess, backgroundColor: '#22c55e', borderRadius: 6, barPercentage: 0.65, categoryPercentage: 0.7 },
                                { label: 'Failed Logins', data: finalError, backgroundColor: '#ef4444', borderRadius: 6, barPercentage: 0.65, categoryPercentage: 0.7 }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { labels: { color: '#9ca3af', usePointStyle: true, boxWidth: 8 } }, tooltip: { callbacks: { label: function (c) { return c.dataset.label + ': ' + c.raw; } } } },
                            scales: { y: { beginAtZero: true, max: yAxisMax, ticks: { color: '#9ca3af' }, grid: { color: '#374151' } }, x: { ticks: { color: '#9ca3af' }, grid: { display: false } } }
                        }
                    });
                }
            }

            charts.initialized = true;
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCharts);
        } else {
            initCharts();
        }

        window.addEventListener('beforeunload', function () {
            const charts = window.dashboardCharts;
            if (charts.revenueChart) charts.revenueChart = null;
            if (charts.membershipChart) charts.membershipChart = null;
            if (charts.loginChart) charts.loginChart = null;
        });
    })();
</script>