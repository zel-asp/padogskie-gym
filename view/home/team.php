<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>

    <body>
        <!-- navigation -->
        <?php require base_path('view/partials/nav.php'); ?>
        <!-- Hero Section -->
        <section class="bg-gray-200 py-16 mt-15 md:mt-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Meet Our Team</h1>
                <p class="text-xl max-w-2xl mx-auto">We're a passionate group of professionals dedicated to
                    delivering exceptional results for our clients.</p>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-16 px-10">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Leadership Team</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Our experienced leaders guide the company with
                        vision and expertise.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-auto gap-8 justify-items-center">
                    <!-- Team Member 1 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <div class="h-64 bg-gray-100 flex items-center justify-center">
                            <div>
                                <img src="assets/imgs/background.jpg" alt="" class="w-40 h-40  border rounded-full">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-gray-800"> Cyril P. Gatchlian </h3>
                            <p class="text-gray-400 mb-4 text-sm">CEO & Founder</p>
                            <p class="text-gray-600 mb-4">Mr. Cyril P. Gatchlian open the branch in 2016 with a vision
                                to
                                revolutionize the industry.</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="text-gray-500 hover:text-brand"><i
                                        class="fab fa-facebook text-xl"></i>
                                </a>
                                <a href="#" class="text-gray-500 hover:text-brand"><i
                                        class="fas fa-envelope text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Team Member 2 -->
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                        <div class="h-64 bg-gray-100 flex items-center justify-center">
                            <div>
                                <img src="assets/imgs/background.jpg" alt="" class="w-40 h-40  border rounded-full">
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-gray-800">Legend 2</h3>
                            <p class="text-gray-400 mb-4 text-sm">CTO</p>
                            <p class="text-gray-600 mb-4">Legend 2 our technical team with over 15 years of
                                experience in software staffelopment.</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="text-gray-500 hover:text-brand"><i
                                        class="fab fa-facebook text-xl"></i></a>
                                <a href="#" class="text-gray-500 hover:text-brand"><i
                                        class="fas fa-envelope text-xl"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- staff sectioj -->
        <section class="py-16 px-10">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Gym Staff Team</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Our dedicated staff ensure the gym runs smoothly and
                        members get the best fitness experience.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- staffs -->
                    <div class="bg-white rounded-lg shadow-xl p-6 text-center flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center mx-auto mb-4">
                                <img src="assets/imgs/background.jpg" alt="" class="w-24 h-24 border rounded-full">
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Miya</h3>
                            <p class="text-gray-400 text-sm mb-2">Fitness Trainer</p>
                            <p class="text-gray-600 text-sm">Guides members through exercises and creates personalized
                                workout plans to help them achieve their fitness goals.</p>
                        </div>
                    </div>

                    <!-- Staff  2 -->
                    <div class="bg-white rounded-lg shadow-xl p-6 text-center flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-24 h-24 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-4">
                                <img src="assets/imgs/background.jpg" alt="" class="w-24 h-24 border rounded-full">
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Marco Polo</h3>
                            <p class="text-gray-400 text-sm mb-2">Nutritionist</p>
                            <p class="text-gray-600 text-sm">Provides personalized meal plans and dietary guidance to
                                help members maximize their results and maintain a healthy lifestyle.</p>
                        </div>
                    </div>

                    <!-- Staff  3 -->
                    <div class="bg-white rounded-lg shadow-xl p-6 text-center flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                                <img src="assets/imgs/background.jpg" alt="" class="w-24 h-24 border rounded-full">
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Kara David</h3>
                            <p class="text-gray-400 text-sm mb-2">Gym Manager</p>
                            <p class="text-gray-600 text-sm">Oversees daily operations, ensures equipment is maintained,
                                and coordinates staff to provide a seamless gym experience.</p>
                        </div>
                    </div>

                    <!-- Staff  4 -->
                    <div class="bg-white rounded-lg shadow-xl p-6 text-center flex flex-col justify-between h-full">
                        <div>
                            <div
                                class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                                <img src="assets/imgs/background.jpg" alt="" class="w-24 h-24 border rounded-full">
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Shikamaru</h3>
                            <p class="text-gray-400 text-sm mb-2">Customer Support</p>
                            <p class="text-gray-600 text-sm">Assists members with inquiries, manages memberships, and
                                ensures every visitor feels welcomed and supported.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </body>

</html>