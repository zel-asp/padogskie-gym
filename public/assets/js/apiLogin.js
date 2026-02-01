let isCooldown = false;

async function getUserLogs() {
    if (isCooldown) return;

    const LogInBtn = document.getElementById('LogInBtn');

    try {
        const response = await fetch('/api/user_logs');
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

        const { success, data, message } = await response.json();

        if (success) {
            const hasTooManyAttempts = data.some(log => log.attempt_count >= 3);

            if (hasTooManyAttempts) {
                LogInBtn.disabled = true;
                LogInBtn.classList.add('opacity-50', 'cursor-not-allowed');
                isCooldown = true;

                alert('Login disabled for 30 seconds due to too many failed attempts');

                setTimeout(() => {
                    LogInBtn.disabled = false;
                    LogInBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    isCooldown = false;
                }, 30 * 1000);
            }
        } else {
            console.error('API returned error:', message);
        }
    } catch (err) {
        console.error('Fetch failed:', err);
    }
}

getUserLogs();
