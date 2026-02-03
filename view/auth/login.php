<?php

$errors = $_SESSION['errors'] ?? [];

unset($_SESSION['errors']);

?>

<!DOCTYPE html>
<html lang="en">

    <?php require base_path('view/partials/head.php'); ?>


    <body>

        <div class="relative h-full md:h-screen bg-[url(/assets/imgs/background.jpg)] bg-cover bg-center text-white/80">
            <div class="absolute inset-0 bg-black/10"></div>

            <div id="LogIn" class="relative flex-center h-screen font-medium ">
                <div class="content relative flex-center flex-col md:flex-row gap-5 md:gap-20 w-full max-w-4xl m-5 
            bg-white/10 backdrop-blur-md rounded-xl shadow-lg p-10 md:p-20">
                    <a href="/" class="absolute top-5 right-8 cursor-pointer">
                        <i class="fa-regular fa-circle-xmark"></i>
                    </a>

                    <div class="mt-5 md:hidden">
                        <img src="assets/imgs/logo.png" alt="padogskie Logo" class="w-[150px] mx-auto">
                    </div>
                    <div class="signIn_form">
                        <h1 class="text-center md:text-start text-xl font-bold lg:text-2xl" id="Sign-In-Title">Sign-In
                        </h1>

                        <?php if (!empty($errors)): ?>
                            <div class="mt-3 w-auto ">
                                <?php foreach ($errors as $error): ?>
                                    <div
                                        class="flex items-center gap-2 bg-red-50 border border-red-400 text-red-700 p-2 rounded-md">
                                        <i class="fa-solid fa-circle-exclamation text-red-600 text-sm"></i>
                                        <span class="text-xs font-small"><?= htmlspecialchars($error) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <form action="/login" method="POST">
                            <div class="flex flex-col mt-3">
                                <label for="loginEmail">Email*</label>
                                <input type="email" id="loginEmail" name="email" class="LoginInput" minlength="8"
                                    maxlength="50" required autocomplete="email" />
                            </div>

                            <div class="flex flex-col mb-0">
                                <label for="loginPassword">Password*</label>
                                <div class="relative">
                                    <input type="password" id="loginPassword" name="password"
                                        class="LoginInput pr-10 w-full" minlength="8" maxlength="20" required
                                        autocomplete="current-password">

                                    <button type="button"
                                        class="absolute right-3 top-4 transform -translate-y-1/2 text-black hover:text-brand transition-colors cursor-pointer text-xs"
                                        id="togglePassword">
                                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="cf-turnstile mt-3" data-sitekey="0x4AAAAAACWH4cPoBQCrb7lD"></div>

                            <button
                                class="w-full mt-3 bg-brand p-1 rounded-xl lg:p-2 hover:bg-white hover:text-brand cursor-pointer"
                                name="login" id="LogInBtn">
                                Login
                            </button>

                            <!-- Sign Up Link -->
                            <p class="text-xs text-center mt-2">
                                Don't have an account?
                                <a href="/signup" class="text-sky-500 hover:underline" data-show="#SignUp"
                                    data-hide="#LogIn">Sign-up</a>
                            </p>
                        </form>

                    </div>

                    <div>
                        <img src="assets/imgs/logo.png" alt="padogskie Logo"
                            class="hidden md:block lg:w-[300px] w-[240px] mx-auto">
                    </div>
                </div>
            </div>
        </div>


        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/apiLogin.js"></script>
    </body>

</html>