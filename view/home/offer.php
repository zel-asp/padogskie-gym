<section class="py-16 bg-gray-100" id="offer">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 reveal-on-scroll">
            <h2 class="text-3xl md:text-4xl font-bold text-brand mb-4">What We Offer</h2>
            <p class="text-lg text-lightgray max-w-3xl mx-auto">
                Our comprehensive fitness programs are designed to meet your individual goals...
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg reveal-on-scroll delay-100">
                <div class="h-48 overflow-hidden">
                    <img src="assets/imgs/offer2.png" alt="Personal Training" class="w-full h-full object-fit">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-5">₱<?= htmlspecialchars($plan['Basic']) ?>/15 Days</h3>
                    <p class="text-lightgray mb-4">Great for short-term fitness goals...</p>
                    <a href="/userdashboard?tab=payment"
                        class="text-brand font-bold underline p-2 hover:bg-brand hover:text-white transition-all">Subscribe</a>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg reveal-on-scroll delay-300">
                <div class="h-48 overflow-hidden">
                    <img src="assets/imgs/offer3.png" alt="Open 24/7" class="w-full h-full object-fit">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-5">₱<?= htmlspecialchars($plan['Regular']) ?>/Monthly</h3>
                    <p class="text-lightgray mb-4">Best value for regular members...</p>
                    <a href="/userdashboard?tab=payment"
                        class="text-brand font-bold underline p-2 hover:bg-brand hover:text-white transition-all">Subscribe</a>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg reveal-on-scroll delay-500">
                <div class="h-48 overflow-hidden">
                    <img src="assets/imgs/offer1.png" alt="Nutrition Planning" class="w-full h-full object-fit">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-5">₱<?= htmlspecialchars($plan['Premium']) ?>/3 Months</h3>
                    <p class="text-lightgray mb-4">Unlock three months of unlimited access...</p>
                    <a href="/userdashboard?tab=payment"
                        class="text-brand font-bold underline p-2 hover:bg-brand hover:text-white transition-all">Subscribe</a>
                </div>
            </div>
        </div>
    </div>
</section>