<nav class="fixed top-0 left-0 w-full z-[100] transition-all duration-300 border-b border-white/10 bg-black/20 backdrop-blur-md shadow-lg"
    id="main-nav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">

            <div class="flex-shrink-0 flex items-center">
                <a href="/"
                    class="text-white font-black text-xl md:text-2xl tracking-tighter hover:opacity-80 transition-opacity">
                    IRONPULSE <span class="text-brand">FITNESS</span>
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button id="js-hamburgerIcon" class="text-white text-2xl focus:outline-none">
                    <i class="bi bi-list" id="hamburger-icon"></i>
                </button>
                <button id="js-closeIcon" class="hidden text-white text-2xl focus:outline-none">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <ul class="flex items-center space-x-6 text-sm font-medium text-white/80">
                    <li><a href="/#" class="hover:text-brand transition-colors">Home</a></li>
                    <li><a href="/#main" class="hover:text-brand transition-colors">Our Story</a></li>
                    <li><a href="/#offer" class="hover:text-brand transition-colors">Offer</a></li>
                    <li><a href="/#stats" class="hover:text-brand transition-colors">Stats</a></li>
                    <li><a href="/#gallery" class="hover:text-brand transition-colors">Gallery</a></li>
                    <li><a href="/#contact" class="hover:text-brand transition-colors">Contact</a></li>
                </ul>

                <div class="flex items-center gap-3 border-l border-white/10 pl-6">
                    <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
                        <a href="/login"
                            class="text-white/80 hover:text-white text-sm font-semibold transition-colors">Login</a>
                        <a href="/signup"
                            class="bg-brand hover:bg-white hover:text-brand text-white px-5 py-2 rounded-full text-sm font-bold transition-all shadow-lg shadow-brand/20">
                            Sign Up
                        </a>
                    <?php else: ?>
                        <a href="/logout" class="text-white/60 hover:text-white text-sm transition-colors">Logout</a>
                        <a href="<?= isset($_SESSION['admin']) ? '/adminDashboard' : '/userdashboard' ?>"
                            class="bg-white text-black hover:bg-brand hover:text-white px-5 py-2 rounded-full text-sm font-bold transition-all">
                            Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden md:hidden bg-black/95 backdrop-blur-xl border-b border-white/10" id="js-navLinks">
        <ul class="flex flex-col p-6 space-y-4 text-center">
            <li><a href="/#" class="block text-lg text-white hover:text-brand">Home</a></li>
            <li><a href="/#main" class="block text-lg text-white hover:text-brand">Our Story</a></li>
            <li><a href="/#offer" class="block text-lg text-white hover:text-brand">Offer</a></li>
            <li><a href="/#contact" class="block text-lg text-white hover:text-brand">Contact</a></li>

            <div class="pt-4 border-t border-white/10 flex flex-col gap-3">
                <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
                    <a href="/login" class="w-full py-3 text-white border border-white/20 rounded-xl">Login</a>
                    <a href="/signup" class="w-full py-3 bg-brand text-white rounded-xl font-bold">Sign Up</a>
                <?php else: ?>
                    <a href="<?= isset($_SESSION['admin']) ? '/adminDashboard' : '/userdashboard' ?>"
                        class="w-full py-3 bg-white text-black rounded-xl font-bold">Dashboard</a>
                    <a href="/logout" class="w-full py-3 text-white/50">Logout</a>
                <?php endif; ?>
            </div>
        </ul>
    </div>
</nav>