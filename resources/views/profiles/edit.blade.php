<x-app-layout>
    <div class="mx-auto mt-10 max-w-4xl flex flex-col text-white">
        <form method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
            <!-- Security -->
            @csrf
            @method('PATCH')

            <div>
                <h1 class="font-bold text-xl mb-4">Edit Profile</h1>
            </div>

            <!-- Title -->
            <div class="mb-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') ?? $user->profile->title }}" autofocus />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            
            <!-- Description -->
            <div class="mb-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ old('description') ?? $user->profile->description }}" autofocus />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Url -->
            <div class="mb-4">
                <x-input-label for="url" :value="__('Url')" />
                <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" value="{{ old('url') ?? $user->profile->url }}" autofocus />
                <x-input-error :messages="$errors->get('url')" class="mt-2" />
            </div>

            <!-- Profile Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Profile Image')" />
                <input id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    Edit
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>