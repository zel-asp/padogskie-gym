<!DOCTYPE html>
<html lang="en">
    <?php require base_path('view/partials/head.php'); ?>

    <body
        class="min-h-screen bg-gradient-to-br from-[#0e1824] via-[#162435] to-[#0e1824] text-white flex items-center justify-center font-sans px-4 py-8">
        <div
            class="w-full max-w-4xl bg-[#121f2e]/90 p-6 sm:p-8 rounded-2xl shadow-2xl backdrop-blur-sm border border-gray-700">
            <div class="text-center mb-6 sm:mb-8">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-green-500 flex items-center justify-center animate-bounce">
                        <i class="fas fa-check text-white text-2xl sm:text-3xl"></i>
                    </div>
                </div>
                <h4 class="text-xl sm:text-2xl font-semibold">Payment Confirmed!</h4>
                <p class="text-gray-400 mt-2 text-sm">Please complete your payment using GCash</p>
            </div>

            <!-- Payment Details -->
            <div class="border border-gray-700 rounded-xl p-4 mb-6 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-400">Plan:</span>
                    <span class="font-medium text-sm sm:text-base"><?= htmlspecialchars($paymentInfo['plan']); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Amount:</span>
                    <span
                        class="font-medium text-sm sm:text-base">₱<?= htmlspecialchars($paymentInfo['amount']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Payment Method:</span>
                    <span
                        class="font-medium text-sm sm:text-base"><?= htmlspecialchars($paymentInfo['payment_method']); ?></span>
                </div>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-900/30 border border-blue-700 rounded-xl p-4 mb-6">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-400 mt-1 mr-2 flex-shrink-0"></i>
                    <div class="min-w-0">
                        <h6 class="font-medium text-sm sm:text-base">How to Pay with GCash</h6>
                        <ol class="text-xs sm:text-sm text-gray-300 mt-2 list-decimal pl-4 sm:pl-5 space-y-1">
                            <li>Open the GCash app</li>
                            <li>Tap "Scan QR" or the QR icon</li>
                            <li>Scan the QR code below or click the download QR code</li>
                            <li>Enter the payment amount (₱<?= htmlspecialchars($paymentInfo['amount']) ?>)</li>
                            <li>Confirm your payment</li>
                            <li>Click "I've Paid" after completing payment to upload your receipt</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- QR Code Section -->
            <div class="text-center mb-6">
                <h5 class="font-medium mb-3 text-base sm:text-lg">Scan QR Code to Pay</h5>
                <div class="bg-white p-3 sm:p-4 rounded-xl inline-block shadow-md max-w-full mb-4">
                    <div class="w-48 h-48 sm:w-56 sm:h-56 mx-auto">
                        <img src="assets/imgs/gcashqr.jpg" alt="GCash QR Code"
                            class="w-full h-full object-cover rounded-lg" id="qr-code-image">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-0">
                <form action="/destroy" method="POST" class="w-full sm:w-auto">
                    <input type="hidden" name="__method" value="DELETE">
                    <button type="submit" name="cancel"
                        class="w-full sm:w-auto bg-red-700 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 cursor-pointer text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-2"></i>Cancel
                    </button>
                </form>

                <button onclick="downloadQRCode(event)"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 text-center text-sm sm:text-base">
                    <i class="fas fa-download"></i> Download QR Code
                </button>

                <button id="ivePaidBtn"
                    class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition-all duration-200 text-center text-sm sm:text-base">
                    I've Paid <i class="fas fa-check ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Receipt Upload Modal -->
        <div id="receiptModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-[#121f2e] rounded-xl p-6 w-full max-w-md mx-4">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-receipt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold">Upload Payment Receipt</h3>
                    <p class="text-gray-400 text-sm mt-1">Please upload your GCash payment receipt/screenshot</p>
                </div>

                <form id="receiptUploadForm">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Payment Receipt</label>
                        <div class="border-2 border-dashed border-gray-600 rounded-lg p-4 text-center cursor-pointer hover:border-green-500 transition"
                            id="uploadArea">
                            <input type="file" id="receiptFile" accept="image/*" class="hidden" required>
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-gray-400 text-sm">Click to upload receipt screenshot</p>
                            <p class="text-gray-500 text-xs mt-1">JPG, PNG (Max 5MB)</p>
                        </div>
                        <div id="filePreview" class="mt-3 hidden">
                            <img id="previewImage" class="w-full h-32 object-cover rounded-lg" src="">
                            <p id="fileName" class="text-sm text-gray-400 mt-1 text-center"></p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" id="closeModalBtn"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium px-4 py-2 rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit" id="submitReceiptBtn"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition">
                            Upload Receipt
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
        <script src="assets/js/supabase-config.js"></script>
        <script>
            // Download QR Code function
            function downloadQRCode(event) {
                const qrImage = document.getElementById('qr-code-image');
                const imageUrl = qrImage.src;

                const downloadLink = document.createElement('a');
                downloadLink.href = imageUrl;
                downloadLink.download = 'GCash_QR_Code_Padogskei_Gym.jpg';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);

                const originalText = event.target.innerHTML;
                event.target.innerHTML = '<i class="fas fa-check"></i> Downloaded!';
                event.target.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                event.target.classList.add('bg-green-600');

                setTimeout(() => {
                    event.target.innerHTML = originalText;
                    event.target.classList.remove('bg-green-600');
                    event.target.classList.add('bg-blue-600', 'hover:bg-blue-700');
                }, 2000);
            }

            // Receipt Upload Handler
            document.addEventListener('DOMContentLoaded', function () {
                // Debug: Check what's in window.supabase
                console.log('window.supabase:', window.supabase);
                console.log('typeof window.supabase:', typeof window.supabase);

                if (window.supabase && window.supabase.storage) {
                    console.log('Supabase storage is available');
                } else {
                    console.log('Supabase storage is NOT available');
                }

                const ivePaidBtn = document.getElementById('ivePaidBtn');
                const receiptModal = document.getElementById('receiptModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const receiptUploadForm = document.getElementById('receiptUploadForm');
                const receiptFile = document.getElementById('receiptFile');
                const uploadArea = document.getElementById('uploadArea');
                const filePreview = document.getElementById('filePreview');
                const previewImage = document.getElementById('previewImage');
                const fileName = document.getElementById('fileName');

                // Payment ID from PHP
                const paymentId = <?= $paymentInfo['id'] ?>;

                // Show modal when clicking "I've Paid"
                if (ivePaidBtn) {
                    ivePaidBtn.addEventListener('click', function () {
                        receiptModal.classList.remove('hidden');
                        receiptModal.classList.add('flex');
                    });
                }

                // Close modal function
                function closeModal() {
                    receiptModal.classList.add('hidden');
                    receiptModal.classList.remove('flex');
                    receiptUploadForm.reset();
                    filePreview.classList.add('hidden');
                }

                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', closeModal);
                }

                // Click outside to close
                if (receiptModal) {
                    receiptModal.addEventListener('click', function (e) {
                        if (e.target === receiptModal) {
                            closeModal();
                        }
                    });
                }

                // File upload area click
                if (uploadArea) {
                    uploadArea.addEventListener('click', function () {
                        receiptFile.click();
                    });
                }

                // File preview
                if (receiptFile) {
                    receiptFile.addEventListener('change', function (e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (event) {
                                previewImage.src = event.target.result;
                                fileName.textContent = file.name;
                                filePreview.classList.remove('hidden');
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }

                // Handle receipt upload
                if (receiptUploadForm) {
                    receiptUploadForm.addEventListener('submit', async function (e) {
                        e.preventDefault();

                        const file = receiptFile.files[0];
                        if (!file) {
                            alert('Please select a receipt file');
                            return;
                        }

                        // Check if Supabase is available
                        if (!window.supabase || !window.supabase.storage) {
                            alert('Supabase is not initialized. Please refresh the page.');
                            console.error('window.supabase:', window.supabase);
                            return;
                        }

                        // Disable submit button
                        const submitBtn = document.getElementById('submitReceiptBtn');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
                        submitBtn.disabled = true;

                        try {
                            console.log('Uploading to Supabase...');

                            // Upload receipt to Supabase Storage
                            const fileName = `receipt_${paymentId}_${Date.now()}_${file.name}`;

                            const { data: uploadData, error: uploadError } = await window.supabase.storage
                                .from('receipts')
                                .upload(fileName, file);

                            if (uploadError) throw uploadError;

                            console.log('Upload successful:', uploadData);

                            // Get public URL
                            const { data: urlData } = window.supabase.storage
                                .from('receipts')
                                .getPublicUrl(fileName);

                            const receiptUrl = urlData.publicUrl;

                            console.log('Receipt URL:', receiptUrl);

                            // Update payment record with receipt URL
                            const response = await fetch('/update-receipt', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    payment_id: paymentId,
                                    receipt_url: receiptUrl
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                closeModal();
                                window.location.href = '/userdashboard?tab=payment';
                            } else {
                                throw new Error(result.message || 'Failed to update payment');
                            }

                        } catch (error) {
                            console.error('Error:', error);
                            alert('Error uploading receipt: ' + error.message);
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    });
                }
            });
        </script>
    </body>

</html>