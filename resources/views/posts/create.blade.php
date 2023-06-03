<x-app-layout>
    <div class="mx-auto mt-10 max-w-4xl flex flex-col">
        <form method="POST" action="/p" enctype="multipart/form-data">
            <!-- Security -->
            @csrf

            <!-- Post Caption -->
            <div>
                <x-input-label for="caption" :value="__('Post Caption')" />
                <x-text-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" autofocus />
                <x-input-error :messages="$errors->get('caption')" class="mt-2" />
            </div>

            <!-- Post Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Post Image')" />
                <input id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" />
                </label>
            </div> -->

            <!-- <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file"> -->
            <!-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p> -->

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    Upload
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>