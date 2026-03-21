<?php
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
    <?php require base_path('view/partials/head.php'); ?>

    <body class="h-full antialiased font-sans text-white/90">
        <div
            class="relative min-h-screen bg-[url(/assets/imgs/background.jpg)] bg-cover bg-center flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

            <div id="SignUp"
                class="relative z-10 w-full max-w-4xl bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

                <a href="/" class="absolute top-6 right-6 text-white/40 hover:text-white transition-colors">
                    <i class="fa-regular fa-circle-xmark text-xl"></i>
                </a>

                <div
                    class="hidden md:flex flex-1 flex-col items-center justify-center bg-white/5 p-12 border-r border-white/10">
                    <img src="assets/imgs/logo.png" alt="Logo" class="w-56 drop-shadow-2xl">
                    <div class="mt-8 text-center px-4">
                        <h2 class="text-xl font-bold">Join the Community</h2>
                        <p class="text-sm text-white/50 mt-2">Create an account to start managing your projects and team
                            today.</p>
                    </div>
                </div>

                <div class="flex-[1.2] p-8 md:p-12">
                    <div class="md:hidden mb-6 flex justify-center">
                        <img src="assets/imgs/logo.png" alt="Logo" class="w-28">
                    </div>

                    <header class="mb-6">
                        <h1 class="text-2xl font-bold tracking-tight">Create Account</h1>
                    </header>

                    <?php if (!empty($errors)): ?>
                        <div class="mb-4 space-y-2">
                            <?php foreach ($errors as $error): ?>
                                <div
                                    class="flex items-center gap-2 bg-red-500/20 border border-red-500/40 text-red-100 p-2.5 rounded-lg text-xs">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    <span><?= htmlspecialchars($error) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="/signup" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2 space-y-1">
                            <label for="signupUsername"
                                class="text-xs font-semibold text-white/60 uppercase ml-1">Username*</label>
                            <input type="text" id="signupUsername" name="username"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-sky-500/50 transition-all"
                                placeholder="johndoe" required />
                        </div>

                        <div class="md:col-span-2 space-y-1">
                            <label for="signupEmail" class="text-xs font-semibold text-white/60 uppercase ml-1">Email
                                Address*</label>
                            <input type="email" id="signupEmail" name="email"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-sky-500/50 transition-all"
                                placeholder="john@example.com" required />
                        </div>

                        <div class="space-y-1">
                            <label for="loginPassword"
                                class="text-xs font-semibold text-white/60 uppercase ml-1">Password*</label>
                            <div class="relative">
                                <input type="password" id="loginPassword" name="password"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-sky-500/50 transition-all"
                                    required />
                                <button type="button" id="togglePassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-white/30 hover:text-white transition-colors">
                                    <i class="fa-regular fa-eye text-xs" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label for="signupPasswordConfirm"
                                class="text-xs font-semibold text-white/60 uppercase ml-1">Confirm*</label>
                            <input type="password" id="signupPasswordConfirm" name="password_confirm"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-sky-500/50 transition-all"
                                required />
                        </div>

                        <div class="md:col-span-2 flex items-start gap-3 py-2">
                            <input type="checkbox" id="signupTerms" name="terms"
                                class="mt-1 w-4 h-4 rounded border-white/20 bg-black/20 text-sky-500 focus:ring-sky-500/50 transition-all cursor-pointer"
                                required />
                            <label for="signupTerms" class="text-xs text-white/60 leading-tight cursor-pointer">
                                I accept the <a href="/terms" class="text-sky-400 hover:underline">Terms of Service</a>
                                and
                                <a href="/privacy" class="text-sky-400 hover:underline">Privacy Policy</a>.
                            </label>
                        </div>

                        <div class="md:col-span-2 pt-2">
                            <button name="register"
                                class="w-full bg-sky-500 hover:bg-sky-400 text-white font-bold py-3 rounded-xl shadow-lg shadow-sky-900/40 transform active:scale-[0.98] transition-all duration-200">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <footer class="mt-6 text-center">
                        <p class="text-xs text-white/40">
                            Already have account?
                            <a href="/login"
                                class="text-sky-400 font-semibold hover:underline decoration-2 underline-offset-4">Sign
                                In</a>
                        </p>
                    </footer>
                </div>
            </div>
        </div>

        <script src="assets/js/script.js"></script>
    </body>

</html>