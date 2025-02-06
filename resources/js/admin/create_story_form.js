document.addEventListener("DOMContentLoaded", function () {
    console.log('Started!');

    // Subscribe to the story-created event
    window.Echo.private('story-created')
        .listen('.story.created', (e) => {
            console.log("Broadcasted new Story:", e.story);
        });

    // Form submission logic
    const form = document.getElementById('create-story-form');
    const submitButton = document.getElementById('create-story-button');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent page reload on form submission

        let formData = new FormData(form);

        // Disable button and show loading text
        submitButton.disabled = true;
        submitButton.innerHTML = "Submitting...";

        // Remove previous alerts if any
        const previousAlerts = document.querySelectorAll('.alert');
        previousAlerts.forEach(alert => alert.remove());

        // Perform AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert("Story created successfully!", "bg-green-500");
                    form.reset();
                } else {
                    showAlert("Something went wrong!", "bg-red-500");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showAlert("An error occurred. Please try again!", "bg-red-500");
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = "Create story";
            });
    });

    // Function to show alert messages
    function showAlert(message, colorClass) {
        let alertDiv = document.createElement("div");
        alertDiv.className = `alert ${colorClass} text-white text-sm p-2 rounded mt-3`;
        alertDiv.innerHTML = message;
        form.insertBefore(alertDiv, form.firstChild);

        // Auto remove alert after 3 seconds
        setTimeout(() => alertDiv.remove(), 3000);
    }
});
