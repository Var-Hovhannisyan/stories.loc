function fetchStories() {
    fetch("/", { // Adjust API endpoint if needed
        headers: {
            "Accept": "application/json"
        }
    })
        .then(response => response.json())
        .then(stories => {
            updateStoriesUI(stories);
        });
}

function updateStoriesUI(stories) {
    let container = document.getElementById('stories-container');
    if (!container) return;

    if (stories.length === 0) {
        container.innerHTML = `<p class="text-gray-500">No approved stories available.</p>`;
    } else {
        container.innerHTML = stories.map(story => `
            <div class="p-4 border-b">
                <h2 class="text-xl font-semibold">${story.title}</h2>
                <p class="text-gray-700">${story.description}</p>
                <p class="text-sm text-gray-500">Published on ${new Date(story.created_at).toLocaleDateString()}</p>
            </div>
        `).join('');
    }
}

// Poll every 3 seconds
setInterval(fetchStories, 3000);

// Listen for real-time updates
window.Echo.channel('story-approved')
    .listen('.story.approved', (event) => {
        console.log('Story approved');
        fetchStories();
    });

// Initial fetch
document.addEventListener('DOMContentLoaded', fetchStories);
