<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>

    <body class="bg-gray-700 text-gray-100 flex min-h-screen">


        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>

        <?php require base_path('view/dashboards/admin/sidebar.php'); ?>

        <!-- Main Content -->
        <div class="flex-1 p-5 ml-0 overflow-y-auto lg:overflow md:ml-64 transition-all duration-300">
            <div class="flex items-center justify-between mb-6 lg:hidden">
                <div class="flex items-center gap-3">
                    <button id="mobileMenuButton"
                        class="p-2 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <h1 class="text-xl font-bold">Padogskei Wild Gym</h1>
                </div>
            </div>

            <!-- Dashboard Page -->
            <?php require base_path('view/dashboards/admin/dashboard.php'); ?>

            <?php require base_path('view/dashboards/admin/announcement.php'); ?>

            <!-- Members Page -->
            <?php require base_path('view/dashboards/admin/members.php'); ?>

            <!-- Payments Page -->
            <?php require base_path('view/dashboards/admin/payment.php'); ?>

            <!-- Feedback Page -->
            <?php require base_path('view/dashboards/admin/feedback.php'); ?>

            <!-- Settings Page -->
            <?php require base_path('view/dashboards/admin/setting.php'); ?>

        </div>

        <script src="assets/js/adminDashboard.js"></script>
    </body>

</html>