<!-- Payment Section -->
<section id="payment" data-target="payment" class="tab-content hidden">
    <h3 class="text-xl font-bold mb-4">Membership Payment</h3>

    <?php if (!empty($_SESSION['paymentError'])): ?>
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                <?php foreach ($_SESSION['paymentError'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['paymentError']); ?>
    <?php endif; ?>


    <?php if (empty($paymentInfo) || $paymentInfo['status'] === 'Expired'): ?>
        <!-- No payment yet -->
        <div id="payment-form-container" class="bg-[#121f2e] p-6 rounded-xl shadow-md w-full">
            <form action="/pay" method="POST">
                <input type="text" name="fullname" placeholder="Full Name" value="<?= htmlspecialchars($info['fullname'] ?? $_SESSION['user']['username']); ?>
" required class=" p-3 rounded bg-[#1a2a3f] w-full focus:outline-none focus:ring-1 focus:ring-orange-500
                mb-3" />

                <select id="plan-select" name="plan" required
                    class="p-3 rounded bg-[#1a2a3f] w-full focus:outline-none focus:ring-1 focus:ring-orange-500 mb-3">
                    <option value="">Select Plan</option>
                    <option value="Basic">15 Days (Basic) - ₱<?= htmlspecialchars($plan['Basic'] ?? 350) ?></option>
                    <option value="Regular">Monthly (Regular) - ₱<?= htmlspecialchars($plan['Regular']) ?? 700 ?></option>
                    <option value="Premium">Quarterly (Premium) - ₱<?= htmlspecialchars($plan['Premium'] ?? 2000) ?>
                    </option>
                </select>


                <select id="payment-method" name="payment_method" required
                    class="p-3 rounded bg-[#1a2a3f] w-full focus:outline-none focus:ring-1 focus:ring-orange-500 mb-3">
                    <option value="">Choose Payment Method</option>
                    <option value="GCash">GCash</option>
                    <option value="PayPal" disabled>PayPal is not yet available</option>
                </select>


                <div class="flex justify-end">
                    <button type="submit" id="confirm-payment-btn"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors w-full md:w-auto">
                        Confirm Payment
                    </button>
                </div>
            </form>
        </div>


    <?php else: ?>
        <?php
        $status = $paymentInfo['status'] ?? 'Pending';
        $plan = htmlspecialchars($paymentInfo['plan'] ?? 'Unknown');
        $amount = number_format($paymentInfo['amount'] ?? 0, 2);
        $date = isset($paymentInfo['created_at'])
            ? date('M j, Y', strtotime($paymentInfo['created_at']))
            : date('M j, Y');
        $receiptUrl = $paymentInfo['receipt_url'] ?? null;


        $isPending = $status === 'Pending';
        $isExpired = $status === 'Expired';
        $isSuccess = !$isPending && !$isExpired;
        ?>

        <div id="payment-status" class="bg-[#121f2e] p-6 rounded-xl shadow-md w-full mt-6">
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 rounded-full 
                        <?= $isPending ? 'bg-yellow-500' : ($isExpired ? 'bg-gray-500' : 'bg-green-500') ?> 
                        flex items-center justify-center">
                        <i class="fas 
                            <?= $isPending ? 'fa-hourglass-half' : ($isExpired ? 'fa-clock' : 'fa-check') ?> 
                            text-white text-3xl"></i>
                    </div>
                </div>

                <h4 class="text-xl font-bold mb-2">
                    <?= $isPending ? 'Payment Processing...' : ($isExpired ? 'Membership Expired' : 'You are a member') ?>
                </h4>

                <p class="text-gray-400 mb-6">
                    <?= $isPending
                        ? 'Your payment is being verified. Please wait for confirmation.'
                        : ($isExpired
                            ? 'Your membership period has ended. Please renew to continue.'
                            : 'Thank you for your payment. Your membership is still active.') ?>
                </p>

                <div class="border border-gray-700 rounded-lg p-4 mb-6 text-left">
                    <h5 class="font-medium mb-3">Payment Details</h5>

                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400">Status:</span>
                        <span class="font-medium 
                            <?= $isPending ? 'text-yellow-400' : ($isExpired ? 'text-gray-400' : 'text-green-400') ?>">
                            <?= htmlspecialchars($status) ?>
                        </span>
                    </div>

                    <div class="flex justify-between mb-2">
                        <span class="text-gray-400">Amount Paid:</span>
                        <span id="success-amount" class="font-medium">₱<?= $amount ?></span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-400">Date:</span>
                        <span class="font-medium"><?= $date ?></span>
                    </div>
                    <?php if ($paymentInfo['status'] !== 'Pending'): ?>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Expiration Date:</span>
                            <span class="font-medium"><?= htmlspecialchars($expiryDate->format('F j, Y')); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <?php if ($receiptUrl): ?>
                        <button onclick="window.open('<?= htmlspecialchars($receiptUrl) ?>', '_blank')"
                            class="inline-flex items-center bg-sky-300 gap-2 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-receipt text-lg"></i>
                            <span>View Receipt</span>
                            <i class="fas fa-external-link-alt text-sm"></i>
                        </button>
                    <?php endif; ?>

                    <?php if ($paymentInfo['status'] === 'Expired'): ?>
                        <button type="button" id="new-payment"
                            class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-credit-card text-lg"></i>
                            <span>Pay Again</span>
                        </button>
                    <?php endif; ?>
                </div>

                <?php if (!$receiptUrl && !$isPending): ?>
                    <div class="mt-4 p-3 bg-yellow-500/20 border border-yellow-500 rounded-lg">
                        <p class="text-yellow-400 text-sm">
                            <i class="fas fa-info-circle mr-2"></i>
                            No receipt uploaded yet. Please upload your payment receipt.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>