<form class="w-full max-w-sm p-4" action="{{ route('story.create') }}" method="POST" id="create-story-form">
    @csrf
    <h2 class="form_title text-3xl text-purple-700 text-center">Create new story</h2>
    <div class="md:flex flex-col md:items-start my-6">
        <div class="w-full">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-title">
                Title
            </label>
        </div>
        <div class="w-full">
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-title" type="text" name="title">
            @error('title')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="md:flex flex-col md:items-start mb-6">
        <div class="w-full">
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4" for="inline-description">
                Description
            </label>
        </div>
        <div class="w-full">
            <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-description" name="description"></textarea>
            @error('description')
            <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button id="create-story-button" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Create story
            </button>
        </div>
    </div>
</form>

