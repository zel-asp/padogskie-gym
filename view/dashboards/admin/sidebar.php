<!-- Sidebar -->
<div id="sidebar"
    class="sidebar-mobile fixed inset-y-0 left-0 z-30 h-full w-64 bg-gray-900 overflow-y-auto shadow-lg transition-transform duration-300 md:translate-x-0">

    <div class="flex-center gap-2 p-5 pb-5 mb-5">
        <h1 class="text-xl font-bold w-full">Admin Dashboard</h1>

        <div class="flex items-center justify-between p-5 pb-5 mb-5">
            <!-- close open -->
            <span id="closeSidebar" class="md:hidden cursor-pointer text-white ">
                <span class="fa fa-xmark"></span>
            </span>
        </div>
    </div>

    <ul class="list-none p-0 px-4">
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="dashboard">
                <i class="fas fa-home mr-3 text-lg"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="announcement">
                <i class="fas fa-home mr-3 text-lg"></i>
                <span>Announcement</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="members">
                <i class="fas fa-users mr-3 text-lg"></i>
                <span>Members</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="payments">
                <i class="fas fa-credit-card mr-3 text-lg"></i>
                <span>Payments</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="feedback">
                <i class="fas fa-comment-dots mr-3 text-lg"></i>
                <span>Feedback</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="settings">
                <i class="fas fa-cog mr-3 text-lg"></i>
                <span>Settings</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="#"
                class="nav-link flex items-center p-3 rounded-lg text-gray-100 hover:bg-gray-700 hover:text-brand transition-all duration-300"
                data-page="userlogs">
                <i class="fas fa-cog mr-3 text-lg"></i>
                <span>Logs</span>
            </a>
        </li>
        <a href="/">
            <div
                class=" flex items-center space-x-3 text-blue-500 p-4 cursor-pointer rounded-lg hover:bg-[#1c2d42] transition-colors ">
                <span class="fa fa-arrow-left "></span>
                <p>Home Page</p>
            </div>
        </a>
    </ul>
</div>