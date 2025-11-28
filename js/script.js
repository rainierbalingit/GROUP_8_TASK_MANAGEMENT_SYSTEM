// JavaScript for dark mode toggle and Fetch API for dynamic task status updates
// Rubric: Functionality (AJAX/Fetch), UI/UX (dark mode)

document.addEventListener('DOMContentLoaded', function() {
    console.log('Script loaded');
    // Dark mode toggle
    const themeToggle = document.getElementById('theme-toggle');
    console.log('Theme toggle element:', themeToggle);
    if (themeToggle) {
        console.log('Theme toggle found');
        // Function to update button text
        function updateThemeToggleText(isDark) {
            themeToggle.textContent = isDark ? 'Light Mode' : 'Dark Mode';
            console.log('Button text updated to:', themeToggle.textContent);
        }

        // Load saved theme on page load
        const savedTheme = localStorage.getItem('darkMode');
        console.log('Saved theme:', savedTheme);
        if (savedTheme === 'true') {
            document.body.classList.add('dark-mode');
            updateThemeToggleText(true);
        } else {
            updateThemeToggleText(false);
        }

        // Toggle event listener
        themeToggle.addEventListener('click', function() {
            console.log('Theme toggle clicked');
            const isDark = document.body.classList.toggle('dark-mode');
            console.log('Is dark mode:', isDark);
            localStorage.setItem('darkMode', isDark ? 'true' : 'false');
            updateThemeToggleText(isDark);
        });
    } else {
        console.log('Theme toggle not found');
    }

    // Update task status dynamically
    const statusSelects = document.querySelectorAll('.task-status');
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.dataset.taskId;
            const newStatus = this.value;

            fetch('update_task_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ task_id: taskId, status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Task status updated!');
                } else {
                    alert('Error updating task status.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
