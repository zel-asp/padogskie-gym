<nav class=" bg-gray-50 fixed p-3 w-full top-0 left-0 z-100 shadow-md">
    <div class="center-vertical flex-col  flex-wrap md:flex-row md:justify-around ">
        <div class=" justify-between center-vertical w-full md:w-auto">
            <div class="logo center-vertical">
                <button onclick="history.back()"
                    class="text-black font-extrabold text-xl md:text-2xl break-words max-w-xs md:max-w-none ml-2 cursor-pointer">
                    IRONPULSE
                    <span class="text-brand">FITNESS</span>
                </button>
            </div>

            <span class="md:hidden bi bi-list text-md font-bold ml-5 cursor-pointer" id="js-hamburgerIcon"></span>
            <span class="hidden md:hidden text-md font-bold ml-5 cursor-pointer" id="js-closeIcon">
                <i class="bi bi-x-lg"></i>
            </span>

        </div>


        <div class="hidden mt-5 md:ml-5 px-15 py-3 flex-col md:flex md:flex-row md:items-center md:gap-6 justify-end md:mt-0 shadow-md rounded-sm w-full md:w-auto "
            id="js-navLinks">
            <ul class="center-vertical flex-col md:flex-row gap-4 md:gap-5 text-sm md:text-md">
                <li><a href="/#" class="hover:text-brand">Home</a></li>
                <li><a href="/#main" class="hover:text-brand">Our Story</a></li>
                <li><a href="/#offer" class="hover:text-brand ">Offer</a></li>
                <li><a href="/#stats" class="hover:text-brand">Stats</a></li>
                <li><a href="/#gallery" class="hover:text-brand">Gallery</a></li>
                <li><a href="/#contact" class="hover:text-brand">Contact</a></li>
            </ul>
            <div
                class="center-vertical flex-col justify-start md:flex-row gap-2 md:gap-4 text-brand px-4 font-medium mt-2 md:mt-0 md:ml-5 text-sm md:text-md">

                <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
                    <!-- not logged in -->
                    <a href="/login"
                        class="hover:text-black bg-gray-100 w-full sm:w-70 md:w-auto rounded-lg px-4 py-2 text-center">
                        Login
                    </a>

                    <a href="/signup"
                        class="w-full sm:w-70 md:w-auto rounded-lg bg-black px-4 py-2 text-white hover:bg-brand cursor-pointer text-center">
                        Sign Up
                    </a>
                <?php else: ?>
                    <!-- logged in -->
                    <a href="/logout"
                        class="hover:text-black bg-gray-100 w-full sm:w-70 md:w-auto rounded-lg px-4 py-2 text-center">
                        Logout
                    </a>

                    <?php if (isset($_SESSION['admin'])): ?>
                        <a href="/adminDashboard"
                            class="w-full sm:w-70 md:w-auto rounded-lg bg-black px-4 py-2 text-white hover:bg-brand cursor-pointer text-center">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="/userdashboard"
                            class="w-full sm:w-70 md:w-auto rounded-lg bg-black px-4 py-2 text-white hover:bg-brand cursor-pointer text-center">
                            Dashboard
                        </a>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>
</nav>