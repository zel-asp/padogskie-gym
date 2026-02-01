<div class="page-content" id="payments">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 sm:mb-8 gap-4">
        <h2 class="text-xl sm:text-2xl font-semibold">Payment Management</h2>
    </div>

    <form method="GET" action="/adminDashboard"
        class="flex flex-col sm:flex-row gap-4 mb-5 items-start sm:items-center">
        <input type="hidden" name="tab" value="<?= htmlspecialchars($_GET['tab'] ?? 'members') ?>">

        <div class="w-full sm:flex-1 sm:min-w-64 relative">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                placeholder="Search members..."
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-100">
        </div>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <select name="status"
                class="w-full sm:w-auto p-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-100 min-w-40">
                <?php $statuses = ['All', 'Active', 'Pending', 'Expired'];
                foreach ($statuses as $status) {
                    $selected = (($_GET['status'] ?? 'All') === $status) ? 'selected' : '';
                    echo "<option value='$status' $selected>$status</option>";
                } ?>
            </select>

            <select name="membership"
                class="w-full sm:w-auto p-2 rounded-lg border border-gray-600 bg-gray-700 text-gray-100 min-w-40">
                <?php $types = ['All', 'Basic', 'Regular', 'Premium'];
                foreach ($types as $type) {
                    $selected = (($_GET['membership'] ?? 'All') === $type) ? 'selected' : '';
                    echo "<option value='$type' $selected>$type</option>";
                } ?>
            </select>
        </div>

        <button type="submit"
            class="w-full sm:w-auto bg-orange-500 text-white rounded-lg px-4 py-2 hover:bg-orange-600 transition-colors">
            <i class="fas fa-filter mr-2"></i>
            Filter
        </button>
    </form>

    <div class="bg-gray-900 rounded-lg p-4 sm:p-5 shadow-lg">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-semibold">Payment History</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse min-w-[900px]">
                <thead>
                    <tr class="bg-gray-800">
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Payment ID
                        </th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Member</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Amount</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Payment
                            Method</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Email</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Name</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Mmbership
                        </th>

                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Date</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Due Date
                        </th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Status</th>
                        <th class="text-left p-3 text-gray-400 font-normal text-sm border-b border-gray-700">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($payments as $record): ?>
                        <tr class="hover:bg-gray-800 transition-colors">
                            <td class="p-3 border-b border-gray-700"><?= htmlspecialchars($record['payment_id']); ?></td>
                            <td class="p-3 border-b border-gray-700"><?= htmlspecialchars($record['username']); ?></td>
                            <td class="p-3 border-b border-gray-700 whitespace-nowrap">
                                <?= htmlspecialchars($record['amount']); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 truncate max-w-xs">
                                <?= htmlspecialchars($record['payment_method']); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 truncate max-w-xs">
                                <?= htmlspecialchars($record['email']); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 truncate max-w-xs">
                                <?= htmlspecialchars($record['status']); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 truncate max-w-xs">
                                <?= htmlspecialchars($record['name']); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 whitespace-nowrap">
                                <?= htmlspecialchars(date('M d, Y', strtotime($record['payment_date']))); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700 whitespace-nowrap">
                                <?= htmlspecialchars(date('M d, Y', strtotime($record['expiration_date']))); ?>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <?php
                                $statusClass = 'bg-gray-700 text-gray-300';
                                $status = strtolower($record['membership_status']);
                                if ($status === 'active') {
                                    $statusClass = 'bg-green-900 text-green-300';
                                } elseif ($status === 'pending') {
                                    $statusClass = 'bg-yellow-900 text-yellow-300';
                                } elseif ($status === 'expired') {
                                    $statusClass = 'bg-red-900 text-red-300';
                                }
                                ?>
                                <span class="inline-block px-2 py-1 text-xs rounded <?= $statusClass ?>">
                                    <?= htmlspecialchars($record['membership_status']); ?>
                                </span>
                            </td>
                            <td class="p-3 border-b border-gray-700">
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <?php if (isset($_SESSION['admin'])): ?>
                                            <form action="/deletePayment" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this payment?');"
                                                class="w-full sm:w-auto">
                                                <input type="hidden" name="id" value="<?= $record['payment_id']; ?>">
                                                <input type="hidden" name="__method" value="DELETE">
                                                <button name="delete"
                                                    class="w-full bg-transparent border border-gray-600 text-red-400 rounded-lg px-3 py-1 text-sm hover:bg-red-900 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <form action="/updateMembership" method="POST"
                                            onsubmit="return confirm('Are you sure you want to change the membership status?');"
                                            class="w-full sm:w-auto">
                                            <input type="hidden" name="payment_id" value="<?= $record['payment_id']; ?>">
                                            <input type="hidden" name="__method" value="PATCH">
                                            <select name="status"
                                                class="w-full bg-gray-800 border border-gray-600 text-gray-100 text-sm rounded-lg px-2 py-1 hover:border-orange-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition-all duration-200"
                                                onchange="this.form.submit()">
                                                <?php $options = ['Pending', 'Basic', 'Regular', 'Premium', 'Expired'];
                                                foreach ($options as $option):
                                                    $selected = ($record['status'] === $option) ? 'selected' : '';
                                                    echo "<option value='$option' $selected>$option</option>";
                                                endforeach; ?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>