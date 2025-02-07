let isFetching = false; // Prevent multiple overlapping requests

async function fetchStories() {
    if (isFetching) return; // Prevent overlapping fetches
    isFetching = true;

    try {
        const response = await fetch("/", {
            headers: { "Accept": "application/json" }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const stories = await response.json();
        updateStoriesUI(stories);
    } catch (error) {
        console.error("Failed to fetch stories:", error);
    } finally {
        isFetching = false;
    }
}

function updateStoriesUI(stories) {
    const container = document.querySelector("#stories-container");

    if (!container) {
        console.error("Error: #stories-container not found.");
        return;
    }

    if (!stories.length) {
        container.innerHTML = `<p class="text-gray-500">No approved stories available.</p>`;
        return;
    }

    container.innerHTML = stories.map(story => `
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold">${story.title}</h2>
            <p class="text-gray-700">${story.description}</p>
            <p class="text-sm text-gray-500">Published on ${story.created_at ? new Date(story.created_at).toLocaleDateString() : 'Unknown'}</p>
        </div>
    `).join('');
}

// Poll every 2 seconds, ensuring no overlap
setInterval(fetchStories, 2000);

// Listen for real-time updates (only if Echo is available)
if (window.Echo) {
    window.Echo.channel('story-approved')
        .listen('.story.approved', () => {
            console.log('Story approved, fetching new stories...');
            fetchStories();
        });
} else {
    console.warn("Warning: Laravel Echo is not initialized.");
}

// Initial fetch when page loads
document.addEventListener('DOMContentLoaded', fetchStories);
