//toggle 
function displayToggle(toggleE, hideE, displayE) {
    toggleE.classList.toggle('hidden');
    hideE.classList.add('hidden');
    displayE.classList.remove('hidden');
}

//mobile nav
function initNavbarToggle() {
    const hamburger = document.getElementById('js-hamburgerIcon');
    const closeIcon = document.getElementById('js-closeIcon');
    const navLinks = document.getElementById('js-navLinks');

    if (!hamburger || !closeIcon || !navLinks) return;

    hamburger.addEventListener('click', () => {
        displayToggle(navLinks, hamburger, closeIcon);
    });


    closeIcon.addEventListener('click', () => {
        displayToggle(navLinks, closeIcon, hamburger);
    });

    document.addEventListener('click', (e) => {
        if (!navLinks.contains(e.target) && !hamburger.contains(e.target) && !closeIcon.contains(e.target)) {
            navLinks.classList.add('hidden');
            closeIcon.classList.add('hidden');
            hamburger.classList.remove('hidden');
        }
    });
}



document.addEventListener('DOMContentLoaded', () => {
    initNavbarToggle();
});


//eye icon password

// Password toggle functionality
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('loginPassword');
    const eyeIcon = document.getElementById('eyeIcon');

    if (togglePassword && passwordInput && eyeIcon) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle eye icon
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.15 // Trigger when 15% of the element is visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the class when scrolling DOWN into view
                entry.target.classList.add('is-visible');
            } else {
                // Remove the class when scrolling UP or AWAY out of view
                // This allows the animation to "reset" and play again
                entry.target.classList.remove('is-visible');
            }
        });
    }, observerOptions);

    const targets = document.querySelectorAll('.reveal-on-scroll');
    targets.forEach(target => observer.observe(target));
});