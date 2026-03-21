<?php
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en" class="h-full">
    <?php require base_path('view/partials/head.php'); ?>

    <body class="h-full antialiased text-slate-200">

        <div
            class="relative min-h-screen bg-[url('/assets/imgs/background.jpg')] bg-cover bg-center flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>

            <div id="LogIn"
                class="relative z-10 w-full max-w-4xl bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row transition-all">

                <a href="/"
                    class="absolute top-5 right-6 text-white/40 hover:text-white transition-colors duration-200 z-20">
                    <i class="fa-regular fa-circle-xmark text-xl"></i>
                </a>

                <div
                    class="hidden md:flex flex-1 flex-col items-center justify-center bg-white/5 p-12 border-r border-white/10">
                    <img src="assets/imgs/logo.png" alt="Logo" class="w-56 drop-shadow-2xl">
                    <div class="mt-8 text-center">
                        <h2 class="text-xl font-semibold text-white">Welcome Back</h2>
                        <p class="text-sm text-white/50 mt-2">Sign in to access your dashboard and manage your account.
                        </p>
                    </div>
                </div>

                <div class="flex-1 p-8 md:p-14">
                    <div class="md:hidden mb-8 flex justify-center">
                        <img src="assets/imgs/logo.png" alt="Logo" class="w-32">
                    </div>

                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-white tracking-tight">Sign In</h1>
                        <p class="text-white/60 text-sm mt-1">Enter your credentials below.</p>
                    </div>

                    <?php if (!empty($errors)): ?>
                        <div class="mb-6 space-y-2">
                            <?php foreach ($errors as $error): ?>
                                <div
                                    class="flex items-center gap-3 bg-red-500/20 border border-red-500/50 text-red-100 p-3 rounded-xl animate-in fade-in slide-in-from-top-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                    <span class="text-xs font-medium"><?= htmlspecialchars($error) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="/login" method="POST" class="space-y-5">
                        <div class="group">
                            <label for="loginEmail"
                                class="block text-xs font-semibold uppercase tracking-wider text-white/60 mb-2 ml-1">Email
                                Address</label>
                            <input type="email" id="loginEmail" name="email"
                                class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-sky-500/50 focus:bg-black/40 transition-all"
                                placeholder="e.g. alex@example.com" required autocomplete="email">
                        </div>

                        <div>
                            <label for="loginPassword"
                                class="block text-xs font-semibold uppercase tracking-wider text-white/60 mb-2 ml-1">Password</label>
                            <div class="relative">
                                <input type="password" id="loginPassword" name="password"
                                    class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-sky-500/50 focus:bg-black/40 transition-all"
                                    placeholder="••••••••" required autocomplete="current-password">
                                <button type="button" id="togglePassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-white/30 hover:text-white transition-colors">
                                    <i class="fa-regular fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="cf-turnstile flex justify-center py-2" data-sitekey="0x4AAAAAACWH4cPoBQCrb7lD"
                            data-theme="dark"></div>

                        <button type="submit" name="login" id="LogInBtn"
                            class="w-full bg-sky-500 hover:bg-sky-400 text-white font-bold py-3 rounded-xl shadow-lg shadow-sky-900/20 active:scale-[0.97] transition-all duration-150">
                            Sign In
                        </button>

                        <p class="text-sm text-center text-white/40 mt-6">
                            New here?
                            <a href="/signup"
                                class="text-sky-400 hover:text-sky-300 font-semibold transition-colors decoration-2 underline-offset-4 hover:underline">
                                Create an account
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/apiLogin.js"></script>
    </body>

</html>