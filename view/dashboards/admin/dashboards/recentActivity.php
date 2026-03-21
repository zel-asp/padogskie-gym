<!-- Recent Activity Section -->
<div class="bg-gray-900 rounded-xl p-5 shadow-lg">
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-history text-orange-400 mr-2"></i>
            Recent Activity
        </h3>
        <span class="text-xs text-gray-400">Last 30 days</span>
    </div>

    <div class="space-y-4">
        <!-- New Member Registration -->
        <?php if ($recentPayment && is_array($recentPayment)): ?>
            <div class="flex items-start p-4 bg-gray-800/30 rounded-lg hover:bg-gray-800/50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-900/50 flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-user-plus text-blue-400"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="text-sm font-semibold">New Member Registration</h4>
                        <span
                            class="text-xs text-gray-400"><?= date('M d, Y', strtotime($recentPayment['payment_date'])) ?></span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        <span class="text-white font-medium"><?= htmlspecialchars($recentPayment['name']); ?></span>
                        signed up for a <?= htmlspecialchars($recentPayment['plan'] ?? 'Basic') ?> membership
                    </p>
                </div>
            </div>

            <!-- Recent Payment -->
            <div class="flex items-start p-4 bg-gray-800/30 rounded-lg hover:bg-gray-800/50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-green-900/50 flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-credit-card text-green-400"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="text-sm font-semibold">Payment Received</h4>
                        <span
                            class="text-xs text-gray-400"><?= date('M d, Y', strtotime($recentPayment['payment_date'])) ?></span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        <span class="text-white font-medium"><?= htmlspecialchars($recentPayment['name']); ?></span>
                        made a payment of
                        <span
                            class="text-green-400 font-semibold">₱<?= number_format($recentPayment['amount'], 2); ?></span>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <div class="p-4 text-center text-gray-400">
                <i class="fas fa-info-circle"></i> No recent payments found.
            </div>
        <?php endif; ?>

        <!-- Feedback Activity -->
        <?php if (!empty($recentFeedback)): ?>
            <?php foreach ($recentFeedback as $recent): ?>
                <div class="flex items-start p-4 bg-gray-800/30 rounded-lg hover:bg-gray-800/50 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-yellow-900/50 flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-sm font-semibold">New Feedback</h4>
                            <span class="text-xs text-gray-400"><?= date('M d, Y', strtotime($recent['created_at'])) ?></span>
                        </div>
                        <p class="text-gray-400 text-sm">
                            <span class="text-white font-medium"><?= htmlspecialchars($recent['name']); ?></span>
                            left a
                            <span class="text-yellow-400"><?= $recent['rating']; ?>-star</span> rating
                        </p>
                        <p class="text-gray-500 text-xs mt-1 line-clamp-1">
                            "<?= htmlspecialchars(substr($recent['feedback_text'], 0, 100)) ?>"</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="p-4 text-center text-gray-400">
                <i class="fas fa-comment-slash"></i> No feedback yet.
            </div>
        <?php endif; ?>
    </div>
</div>