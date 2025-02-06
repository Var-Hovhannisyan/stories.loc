<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve New Created Story</title>
    <style>
        /* Tailwind classes inlined */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .header {
            background-color: #2b6cb0;
            color: #ffffff;
            padding: 24px;
            border-radius: 8px;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }

        .story-box {
            padding: 20px;
            background-color: #f3f4f6;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .story-title {
            font-size: 20px;
            font-weight: bold;
            color: #2b6cb0;
        }

        .story-description {
            font-size: 16px;
            color: #4a5568;
            margin-top: 10px;
        }

        .btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            padding: 16px;
            font-size: 14px;
            color: #6b7280;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 16px;
            }

            .header {
                padding: 16px;
            }

            .content {
                font-size: 14px;
            }

            .footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Approve New Created Story</h1>
    </div>

    <!-- Content -->
    <div class="content">
        <p>Hello,</p>
        <p>A new story has been created and is awaiting your approval. Below are the details of the story:</p>

        <!-- Story Box -->
        <div class="story-box">
            <p class="story-title">{{ $story->title }}</p>
            <p class="story-description">{{ $story->description }}</p>
        </div>

        <p class="mt-6">Please approve or reject this story to make it visible to users. If you approve the story, it will be published for all users to see.</p>

        <!-- Approval Form (AJAX handled) -->

            <a href="{{ route('story.approved', $story->id) }}" type="__blank" class="btn" id="approve-story-btn">Approve Story</a>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Thank you for managing the platform!</p>
        <p>&copy; {{ date('Y') }} Stories. All rights reserved.</p>
    </div>
</div>

<!-- Add AJAX script to handle form submission without reloading -->
<script>
    document.getElementById('approve-story-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent form submission

        const form = e.target;
        const button = document.getElementById('approve-story-btn');
        button.disabled = true; // Disable the button after submission

        // Send the AJAX request to approve the story
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
            },
            body: new FormData(form),
        })
            .then(response => response.json())
            .then(data => {
                // Handle the response (success)
                if (data.success) {
                    alert('Story approved successfully!');
                    button.innerHTML = 'Approved'; // Change button text
                    button.disabled = true; // Disable button after success
                } else {
                    alert('Failed to approve story.');
                    button.disabled = false; // Re-enable button on failure
                }
            })
            .catch(error => {
                // Handle errors
                alert('An error occurred. Please try again.');
                button.disabled = false; // Re-enable button on error
            });
    });
</script>

</body>
</html>
