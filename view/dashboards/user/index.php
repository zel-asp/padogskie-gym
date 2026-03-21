<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>

    <body class="bg-[#0e1824] text-white font-sans">
        <header class="lg:hidden bg-[#121f2e] p-4 flex justify-between items-center sticky top-0 z-30">
            <div class="flex items-center">
                <button id="mobile-menu-btn" class="mr-4 text-xl">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-bold">Iron Pulse Fitness</h1>
            </div>
        </header>

        <div class="flex min-h-screen">

            <?php require base_path('view/dashboards/user/nav.php'); ?>

            <!-- Overlay for mobile menu -->
            <div class="overlay lg:hidden" id="overlay"></div>

            <!-- Main Content -->
            <main class="flex-1 p-4 lg:p-8 w-full lg:w-auto">
                <div class="hidden lg:flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Welcome, <?= htmlspecialchars($username); ?></h2>
                    <a href="/">
                        <div
                            class="hiiden lg:flex items-center space-x-3 text-blue-500  p-4 cursor-pointe rounded-lg hover:bg-[#1c2d42] transition-colors ">
                            <span class="fa fa-arrow-left "></span>
                            <p>home page</p>
                        </div>
                    </a>
                </div>

                <!-- Dashboard -->
                <?php require base_path('view/dashboards/user/dashboard.php'); ?>

                <!-- Membership Section -->
                <?php require base_path('view/dashboards/user/membership.php'); ?>

                <!-- Payment Section -->
                <?php require base_path('view/dashboards/user/payment.php'); ?>

                <!-- Feedback Section -->
                <?php require base_path('view/dashboards/user/feedback.php'); ?>

                <!-- Help Section -->
                <?php require base_path('view/dashboards/user/help.php'); ?>

            </main>
        </div>

        <script src="assets/js/supabase-config.js"></script>
        <script src="assets/js/userDashboard.js"></script>
    </body>

</html>