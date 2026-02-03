<section id="dashboard" class="tab-content">
    <h3 class="text-xl font-bold mb-4">Dashboard</h3>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Announcements Section -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-2xl shadow-lg border border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="font-bold text-xl text-white flex items-center">
                        <i class="fas fa-bullhorn text-orange-400 mr-3"></i>
                        Announcements
                    </h4>
                </div>

                <?php if (!empty($announcements)): ?>
                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                        <?php foreach ($announcements as $announcement): ?>
                            <div
                                class="bg-gray-700/50 rounded-xl p-4 border-l-4 border-orange-400 hover:bg-gray-600/50 transition-all duration-300">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="text-xs text-gray-300 bg-gray-600 px-3 py-1 rounded-full flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-orange-400"></i>
                                        <?= date('M j, Y', strtotime($announcement['created_at'] ?? 'now')) ?>
                                    </span>
                                </div>
                                <div class="flex items-start">
                                    <span class="text-orange-400 mr-3 mt-1 text-lg flex-shrink-0">
                                        <i class="fas fa-bullhorn"></i>
                                    </span>
                                    <div class="flex-1">
                                        <h5 class="font-semibold text-white text-lg mb-2">
                                            <?= htmlspecialchars($announcement['title']); ?>
                                        </h5>
                                        <p class="text-gray-300 text-sm leading-relaxed">
                                            <?= htmlspecialchars($announcement['details'] ?? 'No description available'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-gray-700/50 rounded-xl p-8 text-center border border-gray-600">
                        <i class="fas fa-bullhorn text-4xl text-gray-500 mb-4"></i>
                        <h3 class="text-xl font-semibold text-white mb-2">No Announcements</h3>
                        <p class="text-gray-400">There are no announcements to display at this time.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Quick Summary Section -->
            <?php if (!empty($paymentInfo)): ?>
                <div class="bg-[#121f2e] p-6 rounded-xl shadow-md border border-gray-700">
                    <h4 class="font-semibold text-lg mb-4 border-b border-gray-600 pb-2 text-center lg:text-left">Quick
                        Summary</h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-gray-800/50 rounded-lg">
                            <span class="text-gray-300 flex items-center">
                                <i class="fas fa-id-card mr-2 text-orange-400"></i>
                                Active Membership
                            </span>
                            <span class="text-orange-400 font-semibold">
                                <?= htmlspecialchars($paymentInfo['plan'] ?? 'N/A'); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-800/50 rounded-lg">
                            <span class="text-gray-300 flex items-center">
                                <i class="fas fa-chart-line mr-2 text-orange-400"></i>
                                Membership Plan
                            </span>
                            <span class="text-orange-400 font-semibold">
                                <?= htmlspecialchars($paymentInfo['membership_status'] ?? 'N/A'); ?>
                            </span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-800/50 rounded-lg">
                            <span class="text-gray-300 flex items-center">
                                <i class="fas fa-calendar-check mr-2 text-orange-400"></i>
                                Last Payment
                            </span>
                            <span class="text-orange-400 font-semibold">
                                <?= htmlspecialchars(date('F j, Y', strtotime($paymentInfo['payment_date'] ?? '')) ?: 'N/A'); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-[#121f2e] p-6 rounded-xl shadow-md border border-gray-700">
                    <h4 class="font-semibold text-lg mb-4 border-b border-gray-600 pb-2 text-center lg:text-left">Quick
                        Summary</h4>
                    <div class="text-center p-4">
                        <i class="fas fa-exclamation-triangle text-3xl text-gray-500 mb-3"></i>
                        <p class="text-gray-400">No active membership found.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- if user is a member -->
        <?php if (empty($paymentInfo) || $paymentInfo['membership_status'] !== 'Active'): ?>
            <div class="text-center p-6">
                <p class="text-green-500 font-semibold mb-4">Share your feedback, get your membership now.
                </p>
            </div>
        <?php endif; ?>

        <?php if (!empty($paymentInfo) && $paymentInfo['membership_status'] === 'Active'): ?>

            <!-- else -->
            <div class="bg-[#121f2e] p-6 rounded-xl shadow-md mt-10 w-full">
                <h3 class="text-xl font-bold mb-4">Share Your Feedback</h3>

                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-100 border border-greeb-400 text-green-700 rounded">
                        <ul class="list-disc list-inside">
                            <?php foreach ($_SESSION['success'] as $success): ?>
                                <li><?= htmlspecialchars($success) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (!empty($_SESSION['errors'])): ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            <?php foreach ($_SESSION['errors'] as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <form id="feedbackForm" class="space-y-4 w-full" method="POST" action="/feedback">
                    <div class="grid grid-cols-1 md:-gridcols-2 gap-4">

                        <input type="text" name="name" placeholder="Full Name" readonly
                            value="<?= $_SESSION['user']['username']; ?>"
                            class="p-3 rounded bg-[#1a2a3f] w-full focus:outline-none focus:ring-1 focus:ring-orange-500" />

                        <input type="email" name="email" value="<?= $_SESSION['user']['email']; ?>"
                            class="p-3 rounded bg-[#1a2a3f] w-full focus:outline-none focus:ring-1 focus:ring-orange-500" />

                    </div>
                    <textarea name="feedback_text" placeholder="Write your feedback here..." required maxlength="1000"
                        class="p-3 rounded bg-[#1a2a3f] w-full h-32 focus:outline-none focus:ring-1 focus:ring-orange-500"><?= htmlspecialchars($_POST['feedback_text'] ?? '') ?></textarea>

                    <!-- Hidden input to store star rating -->
                    <input type="hidden" name="rating" id="feedback_rating" value="0">

                    <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
                        <span class="text-gray-300">Rating:</span>
                        <div id="stars" class="flex space-x-1 text-2xl cursor-pointer">
                            <span class="text-gray-400 hover:text-yellow-400 transition-colors">☆</span>
                            <span class="text-gray-400 hover:text-yellow-400 transition-colors">☆</span>
                            <span class="text-gray-400 hover:text-yellow-400 transition-colors">☆</span>
                            <span class="text-gray-400 hover:text-yellow-400 transition-colors">☆</span>
                            <span class="text-gray-400 hover:text-yellow-400 transition-colors">☆</span>
                        </div>
                    </div>


                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors w-full md:w-auto"
                            name="feedback">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
</section>