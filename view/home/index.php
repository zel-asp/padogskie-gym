<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>

    <body>
        <?php require base_path('view/partials/nav.php'); ?>

        <div class="w-full h-screen relative overflow-hidden" id="landing">
            <img src="assets/imgs/background.jpg" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>

            <div
                class="absolute inset-0 flex flex-col md:flex-row items-center justify-center md:justify-around w-full p-5 gap-10">

                <div class="md:hidden animate-entrance delay-300">
                    <img src="assets/imgs/logo.png" alt="Logo" class="w-[180px] mx-auto">
                </div>

                <div class="text-white text-center flex flex-col items-center justify-center max-w-2xl">
                    <h1 class="text-4xl md:text-5xl font-bold animate-entrance">
                        Start a better shape of you!<br>
                        <span class="text-brand">Come join us!</span>
                    </h1>

                    <div class="animate-entrance delay-300 w-full flex justify-center">
                        <a href="#offer"
                            class="inline-block text-sm md:text-base text-brand font-bold py-3 px-8 mt-6 bg-white hover:text-white hover:bg-brand rounded-lg transition-all duration-300 transform active:scale-95 shadow-lg">
                            Join now
                        </a>
                    </div>
                </div>

                <div class="hidden md:block animate-entrance delay-500">
                    <img src="assets/imgs/logo.png" alt="Logo" class="w-[150px] md:w-auto mx-auto drop-shadow-2xl">
                </div>
            </div>

            <div
                class="absolute bottom-0 left-0 w-full h-40 bg-gradient-to-t from-brand via-[hsl(25,95%,53%,0.5)] to-transparent">
                <a href="#main" class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-3xl">
                    <i class="text-white fa-solid fa-chevron-down animate-bounce"></i>
                </a>
            </div>
        </div>

        <main>
            <div class="reveal-on-scroll"><?php require base_path('view/home/main.php'); ?></div>
            <div class="reveal-on-scroll"><?php require base_path('view/home/offer.php'); ?></div>
            <div class="reveal-on-scroll"><?php require base_path('view/home/gallery.php'); ?></div>
            <div class="reveal-on-scroll"><?php require base_path('view/home/stats.php'); ?></div>
        </main>

        <?php require base_path('view/partials/footer.php'); ?>

        <script src="assets/js/script.js"></script>
    </body>

</html>