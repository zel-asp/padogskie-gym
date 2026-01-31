<!-- Sidebar -->
<aside class="sidebar w-64 bg-[#121f2e] p-5 flex flex-col justify-between fixed lg:static z-50">
    <div>
        <h1 class="text-xl font-bold mb-8 text-center hidden lg:block">User Dashboard</h1>
        <nav class="space-y-3">
            <button class="tab-btn flex items-center w-full px-4 py-3 rounded-lg hover:bg-[#1c2d42] transition-colors"
                data-target="dashboard">
                <span class="mr-3 text-lg"><i class="fas fa-home"></i></span> Dashboard
            </button>
            <button class="tab-btn flex items-center w-full px-4 py-3 rounded-lg hover:bg-[#1c2d42] transition-colors"
                data-target="membership">
                <span class="mr-3 text-lg"><i class="fas fa-id-card"></i></span> Membership
            </button>
            <button class="tab-btn flex items-center w-full px-4 py-3 rounded-lg hover:bg-[#1c2d42] transition-colors"
                data-target="payment">
                <span class="mr-3 text-lg"><i class="fas fa-credit-card"></i></span> Payment
            </button>
            <button class="tab-btn flex items-center w-full px-4 py-3 rounded-lg hover:bg-[#1c2d42] transition-colors"
                data-target="feedback">
                <span class="mr-3 text-lg"><i class="fas fa-comment-alt"></i></span> Feedback
            </button>
            <button class="tab-btn flex items-center w-full px-4 py-3 rounded-lg hover:bg-[#1c2d42] transition-colors"
                data-target="help">
                <span class="mr-3 text-lg"><i class="fas fa-question-circle"></i></span> Help
            </button>
            <a href="/">
                <div
                    class="lg:hidden flex items-center space-x-3 text-blue-500 p-4 cursor-pointe rounded-lg hover:bg-[#1c2d42] transition-colors ">
                    <span class="fa fa-arrow-left "></span>
                    <p>home page</p>
                </div>
            </a>
        </nav>
    </div>
    <div class="mt-8 text-center hidden lg:block">
        <p class="text-sm text-gray-400">© 2025 Padogskei Wild Gym</p>
    </div>
</aside>