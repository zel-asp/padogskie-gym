<?php if (!empty($paymentInfo) && $paymentInfo['membership_status'] === 'Active'): ?>
    <section id="membership" data-target="membership" class="tab-content hidden text-black">
        <h3 class="text-xl font-bold mb-4 text-white">User Information</h3>
        <div class="bg-[#121f2e] p-6 rounded-xl shadow-md">

            <!-- Display Errors -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        <?php foreach ($_SESSION['error'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['successful'])): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    <ul class="list-disc list-inside">
                        <?php foreach ($_SESSION['successful'] as $successful): ?>
                            <li><?= htmlspecialchars($successful) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['successful']); ?>
            <?php endif; ?>

            <form method="POST" action="<?= !empty($info) ? '/update' : '/membership' ?>" class="space-y-6">
                <!-- Personal Information -->
                <div>
                    <h4 class="font-semibold mb-3 border-b border-gray-600 pb-1 text-white">Personal Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="fullname" placeholder="Full Name"
                            value="<?= htmlspecialchars($info['fullname'] ?? $_SESSION['user']['username']) ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500"
                            required />

                        <input type="number" name="age" placeholder="Age" min="18" max="100"
                            value="<?= htmlspecialchars($info['age'] ?? 18); ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500"
                            required />

                        <select name="gender"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500"
                            required>
                            <option value="">Select Gender</option>
                            <option value="Male" <?= (isset($info['gender']) && $info['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= (isset($info['gender']) && $info['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                        </select>


                        <input type="text" name="contact" placeholder="Contact Number"
                            value="<?= htmlspecialchars($info['contact'] ?? ''); ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500"
                            required />

                        <input type="text" name="address" placeholder="Address"
                            value="<?= htmlspecialchars($info['address'] ?? ''); ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500 md:col-span-2"
                            required />

                        <input type="email" name="email" placeholder="Email Address"
                            value="<?= htmlspecialchars($info['email'] ?? $_SESSION['user']['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500 md:col-span-2"
                            required />
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-3 border-b border-gray-600 pb-1 text-white">Health Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="number" name="height" placeholder="Height (cm)" min="50" max="250"
                            value="<?= htmlspecialchars($info['height'] ?? ''); ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500" />

                        <input type="number" name="weight" placeholder="Weight (kg)" min="20" max="300"
                            value="<?= htmlspecialchars($info['weight'] ?? ''); ?>"
                            class="p-3 rounded bg-white w-full focus:outline-none focus:ring-1 focus:ring-orange-500" />

                        <textarea name="medical_conditions" placeholder="Medical Conditions" maxlength="1000"
                            class="p-3 rounded bg-white w-full h-24 focus:outline-none focus:ring-1 focus:ring-orange-500 md:col-span-2"><?= htmlspecialchars($info['medical_conditions'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-4">
                    <?php if (!empty($info)): ?>
                        <input type="hidden" name="__method" value="PUT">
                        <button type="submit" name="update" type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors w-full md:w-auto cursor-pointer">
                            Update
                        </button>
                    <?php else: ?>
                        <button type="submit" name="register"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg transition-colors w-full md:w-auto cursor-pointer">
                            Register
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
<?php else: ?>
    <section id="membership" class="tab-content hidden text-black">
        <div class="text-center p-6">
            <p class="text-red-500 font-semibold mb-4">
                This feature is only available for users with an active membership.
            </p>
        </div>
    </section>
<?php endif; ?>