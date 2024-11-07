<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="py-4 mx-auto max-w-screen-xl lg:py-4 lg:">
        <div class="grid gap-8 lg:grid-cols-3">

            @foreach ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <a href="/categories/{{ $post->category->name }}">
                            <span
                                class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                {{ $post->category->name }}
                            </span>
                        </a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="/posts/{{ $post->slug }}" class="hover:underline">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}</h2>
                    </a>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                        {{ Str::limit(strip_tags($post->body), 150) }}
                    </p>

                    @if ($post->image)
                        <div class="mb-5">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-auto max-h-450px object-cover rounded-lg">
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <a href="/authors/{{ $post->author->username }}">
                            <div class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                    alt="{{ $post->author->name }}" />
                                <span class="font-medium dark:text-white">
                                    {{ $post->author->name }}
                                </span>
                            </div>
                        </a>
                        <a href="/posts/{{ $post->slug }}"
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="flex items-center space-x-2">
                        <form action="/posts/{{ $post->slug }}/like" method="POST" class="like-form"
                            data-liked="{{ $post->likes()->where('author_id', auth()->id())->exists() }}">
                            @csrf
                            <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                            <button type="button" class="like-button flex items-center" data-id="{{ $post->id_post }}"
                                data-slug="{{ $post->slug }}"
                                data-liked="{{ $post->likes()->where('author_id', auth()->id())->exists() }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-heart"
                                    style="color: {{ $post->likes()->where('author_id', auth()->id())->exists() ? 'red' : 'black' }};">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                                <span class="ml-1">({{ $post->likes->count() }})</span>
                            </button>
                        </form>
                        <a href="/posts/{{ $post->slug }}/#toggleComments"
                            class="inline-flex items-center font-medium text-gray-600 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500">
                            <i class="bi bi-chat"></i>
                            <span class="ml-1">({{ $post->comment->count() }})</span>
                        </a>
                    </div>



                </article>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.like-button', function() {
        const id_post = $(this).data('id');
        const slug = $(this).data('slug');
        const isLiked = $(this).data('liked');

        const requestData = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id_post: id_post
        };

        const url = '/posts/' + slug + '/like';

        // Mendapatkan elemen span yang menampilkan jumlah likes
        const likesCountElement = $(this).find('span');

        // Pastikan nilai awal adalah angka
        let likesCount = parseInt(likesCountElement.text()) || 0;

        if (!isLiked) {
            $.ajax({
                url: url,
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function(response) {
                    alert(response.message || 'Post liked successfully!');
                    $(this).data('liked', true);
                    likesCountElement.text(likesCount + 1); // Update jumlah likes
                    $(this).find('svg').css('color', 'red');
                }.bind(this),
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while liking the post: ' + xhr.responseText);
                }
            });
        } else {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id_post: id_post
                },
                success: function(response) {
                    alert(response.message || 'Post unliked successfully!');
                    $(this).data('liked', false);
                    // Pastikan likesCount tidak kurang dari 0
                    if (likesCount > 0) {
                        likesCountElement.text(likesCount - 1); // Update jumlah likes
                    }
                    $(this).find('svg').css('color', 'black');
                }.bind(this),
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while unliking the post: ' + xhr.responseText);
                }
            });
        }
        });
    </script>
</x-layout>
