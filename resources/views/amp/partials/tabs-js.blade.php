<script>
  /* tabs.js */

document.addEventListener('DOMContentLoaded', function () {
    // Get all tab buttons
    const tabButtons = document.querySelectorAll('.tabButton');

    // Add click event listener to each tab button
    tabButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            // Remove 'selected' class from all tab buttons
            tabButtons.forEach(function (btn) {
                btn.classList.remove('selected');
            });

            // Add 'selected' class to the clicked tab button
            button.classList.add('selected');

            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tabContent');
            tabContents.forEach(function (content) {
                content.classList.remove('visible');
            });

            // Get the corresponding tab content and display it
            const tabId = button.getAttribute('aria-controls');
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.classList.add('visible');
            }
        });
    });

    // Set the default selected tab and display its content
    const defaultTab = document.querySelector('.tabButton:first-of-type');
    if (defaultTab) {
        defaultTab.classList.add('selected');
        const defaultTabId = defaultTab.getAttribute('aria-controls');
        const defaultTabContent = document.getElementById(defaultTabId);
        if (defaultTabContent) {
            defaultTabContent.classList.add('visible');
        }
    }
});

</script>
