<!-- Recent Payments Section -->
<div class="bg-gray-900 rounded-xl p-5 shadow-lg mb-8">
    <div class="flex justify-between items-center mb-5">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-credit-card text-orange-400 mr-2"></i>
            Recent Payments
        </h3>
        <a href="/adminDashboard?tab=payments" class="text-orange-400 text-sm hover:text-orange-300 transition-colors">
            View All <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-800/50">
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Name</th>
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Plan</th>
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Amount</th>
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Date</th>
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Status</th>
                    <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentPayments)): ?>
                    <?php foreach ($recentPayments as $member): ?>
                        <tr class="hover:bg-gray-800/50 transition-colors">
                            <td class="p-3 border-b border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center mr-2">
                                        <i class="fas fa-user text-xs text-gray-400"></i>
                                    </div>
                                    <?= htmlspecialchars($member['name']) ?>
                                </div>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <?php
                                $planClass = '';
                                if ($member['plan'] === 'Basic')
                                    $planClass = 'text-blue-400';
                                elseif ($member['plan'] === 'Regular')
                                    $planClass = 'text-green-400';
                                elseif ($member['plan'] === 'Premium')
                                    $planClass = 'text-purple-400';
                                ?>
                                <span class="<?= $planClass ?> font-medium">
                                    <?= htmlspecialchars($member['plan'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td class="p-3 border-b border-gray-700 font-semibold text-green-400">
                                ₱<?= number_format($member['amount'], 2) ?>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <?= date('M d, Y', strtotime($member['payment_date'])) ?>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <?php if (strtolower($member['membership_status']) === 'active'): ?>
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-900 text-green-300">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                <?php elseif (strtolower($member['membership_status']) === 'pending'): ?>
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-900 text-yellow-300">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-900 text-red-300">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Expired
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <button onclick="viewReceipt('<?= $member['receipt_url'] ?? '' ?>')"
                                    class="text-blue-400 hover:text-blue-300 text-sm mr-2" <?= empty($member['receipt_url']) ? 'disabled style="opacity:0.5"' : '' ?>>
                                    <i class="fas fa-receipt"></i>
                                </button>
                                <form action="/deletePayment" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this payment?');">
                                    <input type="hidden" name="id" value="<?= $member['id']; ?>">
                                    <input type="hidden" name="__method" value="DELETE">
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            <i class="fas fa-inbox text-4xl mb-2 block"></i>
                            No recent payments found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function viewReceipt(url) {
        if (url) {
            window.open(url, '_blank');
        } else {
            alert('No receipt uploaded yet');
        }
    }
</script>