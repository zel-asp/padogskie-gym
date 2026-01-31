<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>

    <body class="min-h-screen">

        <!-- navigation -->
        <?php require base_path('view/partials/nav.php'); ?>

        <section class="py-16 px-4 md:px-8 text-white mt-15 md:mt-20">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl text-gray font-bold mb-4">Our Gallery</h2>
                    <p class="text-gray-400 max-w-2xl mx-auto">Explore our collection of stunning images showcasing
                        our work and creativity.</p>
                </div>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Gallery Item 1: spans 2 columns -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 sm:col-span-2">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- Gallery Item 2 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 md:row-span-2">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 md:h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- Gallery Item 3 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- Gallery Item 4 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- Gallery Item 5 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>

                    <!-- Gallery Item 6 -->
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-lg transition-transform duration-300 lg:col-span-2">
                        <img src="assets/imgs/background.jpg" alt="Mountain landscape"
                            class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

            </div>
        </section>


        <script src="assets/js/script.js"></script>
    </body>

</html>