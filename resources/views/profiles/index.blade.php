<x-app-layout>
    <div class="mx-auto mt-10 max-w-4xl flex flex-col">
        <div class="flex text-white">
            <div class="px-10">
                <img src="{{ $user->profile->profileImage() }}" alt="avatar" class="rounded-full w-48" />
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <!-- Mustache syntax -> to echo smt in Laravel instead of using PHP syntax -->
                    <!-- Normal PHP syntax: -->
                    <div class="flex items-center">
                        <h1 class="mr-5">{{ $user->username }}</h1>
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    </div>
                    
                    <!-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-1 px-2 rounded">
                        Follow
                    </button> -->
                    @can('update', $user->profile)
                        <div>
                            <a href="/p/create" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-1 px-2 rounded">
                                Add new post
                            </a>
                            <a href="/profile/{{ $user->id }}/edit" class="ml-5 bg-blue-500 hover:bg-blue-700 text-white font-medium py-1 px-2 rounded">
                                Edit Profile
                            </a>
                        </div>
                    @endcan
                </div>
                <div class="flex items-center mt-5">
                    <div class="mr-8"><strong>{{ $postCount }}</strong> posts</div>
                    <div class="mr-8"><strong>{{ $followersCount }}</strong> followers</div>
                    <div class=""><strong>{{ $followingCount }}</strong> following</div>
                </div>
                <div class="font-bold mt-5">
                    <!-- freeCodeCamp.org -->
                    {{ $user->profile->title }}
                </div>
                <div class="break-words">
                    <!-- ABCABCABCABCABCABCABCABCA -->
                    {{ $user->profile->description }}
                </div>
                <div class="">
                    <a class="font-medium text-blue-600 dark:text-blue-500" href="#">
                        <!-- www.freeCodeCamp.org -->
                        {{ $user->profile->url }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-10">
            @foreach ( $user->posts as $post )
            <div class="">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-full" />
                </a>
            </div>
            @endforeach

            <!-- <div class="">
                <img src="/assets/pointing.png" class="w-full" />
            </div>
            <div class="">
                <img src="/assets/pointing.png" class="w-full" />
            </div> -->
        </div>
    </div>

</x-app-layout>