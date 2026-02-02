<!-- footer -->
<footer class="bg-gray-100 text-white py-12 " id="contact">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 custom_screen:grid-cols-2 md:justify-items-center md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-gray font-extrabold text-xl md:text-2xl break-words max-w-xs md:max-w-none  mb-4">
                    IRONPULSE
                    <span class="text-brand">FITNESS</span>
                </h3>
                <p class="text-gray-400">Gym slogan.</p>
            </div>
            <div>
                <h3 class="text-gray text-xl font-bold mb-4 md:mr-10">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-400 hover:text-brand">Home</a></li>
                    <li><a href="/Team" class="text-gray-400 hover:text-brand">Team</a></li>
                    <li><a href="/#offer" class="text-gray-400 hover:text-brand">What we offer</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-gray text-xl font-bold mb-4 ">Contact</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><?= htmlspecialchars($info['address']) ?></li>
                    <li><?= htmlspecialchars($info['phone']) ?></li>
                    <li><?= htmlspecialchars($info['email']) ?></li>
                    <li><?= htmlspecialchars($info['name']) ?></li>
                </ul>
            </div>
            <div>
                <h3 class="text-gray text-xl font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="https://www.tiktok.com/@tchello_ai/video/7589858486369013013?is_from_webapp=1&sender_device=pc"
                        class="text-gray-400 hover:text-brand"><i class="fab fa-tiktok text-xl"></i></a>
                    <a href="https://www.facebook.com/janzeldols" class="text-gray-400 hover:text-brand"><i
                            class="fab fa-facebook text-xl"></i></a>
                    <a href="https://www.tiktok.com/@itz.reiiii1/video/7596196019851873557?is_from_webapp=1&sender_device=pc"
                        class="text-gray-400 hover:text-brand"><i class="fab fa-instagram text-xl"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2025 JanzelDolo. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="assets/js/script.js"></script>