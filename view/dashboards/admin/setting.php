<div class="page-content" id="settings">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold">Settings</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">


        <div class="bg-gray-900 rounded-lg p-6 shadow-lg lg:col-span-2">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-orange-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-cog text-orange-400"></i>
                </div>
                <h3 class="text-lg font-semibold">General Settings</h3>
            </div>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <ul class="list-disc list-inside">
                        <?php
                        $successes = is_array($_SESSION['success']) ? $_SESSION['success'] : [$_SESSION['success']];
                        foreach ($successes as $success): ?>
                            <li><?= htmlspecialchars($success) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['errors'])): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        <?php
                        $errors = is_array($_SESSION['errors']) ? $_SESSION['errors'] : [$_SESSION['errors']];
                        foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>


            <form action="/updateInfo" method="POST" class="space-y-6">
                <input type="hidden" name="__method" value="PATCH">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Gym Name</label>
                        <input type="text" name="gym_name" required
                            class="w-full p-3 rounded-lg border border-gray-600 bg-gray-800 text-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors"
                            value="<?= htmlspecialchars($info['gym_name']) ?>" placeholder="Enter gym name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Contact Email</label>
                        <input type="email" name="email" required
                            class="w-full p-3 rounded-lg border border-gray-600 bg-gray-800 text-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors"
                            value="<?= htmlspecialchars($info['email']) ?>" placeholder="Enter contact email">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Phone Number</label>
                        <input type="text" name="phone" required
                            class="w-full p-3 rounded-lg border border-gray-600 bg-gray-800 text-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors"
                            value="<?= htmlspecialchars($info['phone']) ?>" placeholder="Enter phone number">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Business Hours</label>
                        <input type="text" name="ownerName" required
                            class="w-full p-3 rounded-lg border border-gray-600 bg-gray-800 text-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors"
                            value="<?= htmlspecialchars($info['name']) ?>" placeholder="Owner name">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-300">Address</label>
                    <textarea name="address" required maxlength="1000"
                        class="w-full p-3 rounded-lg border border-gray-600 bg-gray-800 text-gray-100 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors h-24 resize-none"
                        placeholder="Enter gym address"><?= htmlspecialchars($info['address']) ?></textarea>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" name="save"
                        class="bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-6 py-3 transition-colors font-medium flex items-center gap-2 cursor-pointer">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-gray-900 rounded-lg p-5 shadow-lg">
            <h3 class="text-lg font-semibold mb-4">Membership Plans</h3>
            <div class="space-y-4">
                <!-- Basic Plan -->
                <form action="/updatePlanPrice" method="POST"
                    class="border border-gray-700 rounded-lg p-4 bg-gray-800/50 hover:bg-gray-800 transition-colors">
                    <input type="hidden" name="plan_name" value="Basic">
                    <input type="hidden" name="__method" value="PATCH">

                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <h4 class="font-medium text-gray-100">Basic Plan</h4>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-gray-400">₱</span>
                        <input type="number" name="price" required value="<?= htmlspecialchars($plan['Basic']) ?>"
                            min="0" step="50"
                            class="w-24 bg-gray-700 border border-gray-600 rounded px-3 py-1 font-bold text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <span class="text-gray-400 text-sm">per month</span>
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-4 py-2 transition-colors font-medium flex items-center justify-center gap-2 cursor-pointer">
                        Update Price
                    </button>
                </form>

                <!-- Regular Plan -->
                <form action="/updatePlanPrice" method="POST"
                    class="border border-gray-700 rounded-lg p-4 bg-gray-800/50 hover:bg-gray-800 transition-colors">
                    <input type="hidden" name="plan_name" value="Regular">
                    <input type="hidden" name="__method" value="PATCH">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-medium text-gray-100">Regular Plan</h4>
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-gray-400">₱</span>
                        <input type="number" name="price" required value="<?= htmlspecialchars($plan['Regular']) ?>"
                            min="0" step="50"
                            class="w-24 bg-gray-700 border border-gray-600 rounded px-3 py-1 font-bold text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <span class="text-gray-400 text-sm">per month</span>
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-4 py-2 transition-colors font-medium flex items-center justify-center gap-2 cursor-pointer">
                        Update Price
                    </button>
                </form>

                <!-- Premium Plan -->
                <form action="/updatePlanPrice" method="POST"
                    class="border border-gray-700 rounded-lg p-4 bg-gray-800/50 hover:bg-gray-800 transition-colors">
                    <input type="hidden" name="plan_name" value="Premium">
                    <input type="hidden" name="__method" value="PATCH">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-medium text-gray-100">Premium Plan</h4>
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-gray-400">₱</span>
                        <input type="number" name="price" required value="<?= htmlspecialchars($plan['Premium']) ?>"
                            min="0" step="50"
                            class="w-24 bg-gray-700 border border-gray-600 rounded px-3 py-1 font-bold text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <span class="text-gray-400 text-sm">per month</span>
                    </div>

                    <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-lg px-4 py-2 transition-colors font-medium flex items-center justify-center gap-2 cursor-pointer">
                        Update Price
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>