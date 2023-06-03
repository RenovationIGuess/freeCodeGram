<x-app-layout>
    <div class="mx-auto mt-10 max-w-4xl flex flex-col text-white">
        @foreach ($posts as $post)
        <div class="flex mb-4">
            <div class="mr-5">
                <a href="/profile/{{ $post->user_id }}">
                    <img src="/storage/{{ $post->image }}" class="w-96" alt="" />
                </a>
            </div>
            <div class="flex flex-1 flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-full w-8" />
                        </div>
                        <h1 class="font-bold">
                            <a class="hover:no-underline" href="/profile/{{ $post->user->id }}">
                                {{ $post->user->username }}
                            </a>
                        </h1>
                    </div>

                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-1 px-2 rounded">
                        Follow
                    </a>
                </div>

                <p>
                    <span class="font-bold">
                        <a class="hover:no-underline" href="/profile/{{ $post->user->id }}">
                            {{ $post->user->username }}
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
        @endforeach

        <!-- When use paginate in the be -> the links is of course to have :v -->
        <div class="flex items-center justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>