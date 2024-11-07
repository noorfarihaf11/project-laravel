<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <a href="/posts" class="font-medium text-sm text-blue-600 hover:underline">&laquo; Back to all
                        posts</a>
                    <address class="flex items-center my-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="{{ $post->author->name }}">
                            <div>
                                <a href="/authors/{{ $post->author->username }}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->author->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400 mb-1">
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <a href="/categories/{{ $post->category->name }}">
                                    <span
                                        class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">{{ $post->category->name }}</span>
                                </a>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $post->title }}</h1>
                    @if ($post->image)
                        <div style="max-height: 450px; overflow: hidden;">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                class="img-fluid mt-3">
                        </div>
                    @endif
                </header>

                <p> {!! $post->body !!} </p>

                <button id="toggleLikes" class="font-bold text-lg text-blue-600 bg-transparent hover:underline mt-4">
                    Likes ({{ $post->likes->count() }})
                </button>

                <div class="likes-section mt-6 bg-white p-4 rounded shadow hidden">
                    <h2 class="text-xl font-bold mb-2">Likes ({{ $post->likes->count() }})</h2>


                    @if ($post->likes->isEmpty())
                        <p class="text-gray-500">No likes yet.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach ($post->likes as $like)
                                <li class="flex items-center justify-between p-2 border-b border-gray-200">
                                    <div class="flex items-center">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_L1kpgtbdGPLCBa-2OLW2AA93-crcCo4953xdhzJ_7WhhwAdPBi0f2gzKHIGUQOCp5jo&usqp=CAU"
                                            alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                                        <span><strong>{{ $like->author->name }}</strong></span>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ $like->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <button id="toggleComments" class="font-bold text-lg text-blue-600 bg-transparent hover:underline mt-4">
                    Comments ({{ $post->comment->count() }})
                </button>
                <div id="comments" class="flex flex-col mt-8 hidden">
                    <div class="bg-white p-4 rounded shadow mt-6">
                        <h2 class="text-lg font-bold mb-2">Comments ({{ $post->comment->count() }})</h2>

                        <!-- Add a Comment Form -->
                        <div class="bg-white p-4 rounded shadow mt-6">
                            <h2 class="text-lg font-bold mb-2">Add a Comment</h2>
                            <form action="/posts/{{ $post->slug }}/comments" method="POST">
                                @csrf
                                <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                                <input type="hidden" name="author_id" value="{{ auth()->id() }}">
                                <textarea name="comments" rows="4" placeholder="Write your comment here..."
                                    class="w-full p-2 border border-gray-300 rounded mb-4" required></textarea>
                                <button type="submit"
                                    class="btn btn-primary bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow hover:bg-blue-700 transition">Add
                                    Comment</button>
                            </form>
                        </div>

                        <!-- Existing Comments Section -->
                        <div
                            class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mt-6">
                            <div class="mb-3 bg-white p-3 rounded shadow">
                                @foreach ($post->comment as $comment)
                                    <div class="comment-item" data-id="{{ $comment->id_komen }}">
                                        <div class="flex items-start">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_L1kpgtbdGPLCBa-2OLW2AA93-crcCo4953xdhzJ_7WhhwAdPBi0f2gzKHIGUQOCp5jo&usqp=CAU"
                                                alt="Avatar" class="mr-3"
                                                style="width: 40px; height: 40px; border-radius: 50%;">
                                            <div class="flex-grow">
                                                <div class="flex justify-between items-center">
                                                    <span><strong>{{ $comment->author->name }}</strong></span>
                                                    <span
                                                        class="text-muted ms-2">{{ $comment->updated_at->format('d F Y H:i') }}</span>
                                                </div>
                                                <div class="text-secondary mt-1 comment-text">
                                                    <span>{{ $comment->comments }}</span>
                                                </div>
                                                <div class="mt-2 space-x-2">
                                                    <button
                                                        class="btn btn-sm btn-warning bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 transition edit-button">Edit</button>
                                                    <button
                                                        class="btn btn-sm btn-danger bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 transition"
                                                        data-id="{{ $comment->id_komen }}">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-2">

                                        <!-- Edit Form -->
                                        <div class="edit-form hidden mt-4">
                                            <form>
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" id="id_komen" name="id_komen"
                                                    value="{{ $comment->id_komen }}">
                                                <textarea name="comments" rows="2" class="w-full p-2 border border-gray-300 rounded" required>{{ $comment->comments }}</textarea>
                                                <button type="submit"
                                                    class="btn btn-primary update-button bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow hover:bg-blue-700 transition">
                                                    Update Comment
                                                </button>
                                                <button type="button"
                                                    class="btn btn-secondary cancel-button mt-2">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#toggleLikes').click(function() {
                $('.likes-section').toggle(); // Menampilkan/menyembunyikan bagian likes
                $(this).text($(this).text() === 'Hide Likes' ? 'Likes ({{ $post->likes->count() }})' :
                    'Hide Likes');
            });

            $('#toggleComments').click(function() {
                $('#comments').toggle(); // Menampilkan/menyembunyikan bagian comments
                $(this).text($(this).text() === 'Hide Comments' ?
                    'Comments ({{ $post->comment->count() }})' : 'Hide Comments');
            });
        });

        $(document).ready(function() {
            
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Show Edit Form
            $('.edit-button').click(function() {
                const commentItem = $(this).closest('.comment-item');
                commentItem.find('.edit-form').toggle(); // Toggle edit form
                $(this).text(commentItem.find('.edit-form').is(':visible') ? 'Cancel' : 'Edit');
            });

            // Update Comment via AJAX
            $('.edit-form').on('submit', function(event) {
                event.preventDefault(); // Prevent page refresh

                const formData = $(this).serialize(); // Get all form data
                const id_komen = $(this).find('#id_komen').val(); // Ambil ID dari input tersembunyi
                const postSlug = '{{ $post->slug }}'; // Ambil slug dengan benar

                $.ajax({
                    url: '/posts/' + postSlug + '/comments/' +
                        id_komen, // Pastikan untuk menggunakan slug yang benar
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('Comment updated successfully!');
                            location.reload(); // Reload page untuk memperbarui tampilan
                        } else {
                            alert('Error updating comment: ' + (response.message ||
                                'Unknown error.'));
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseJSON); // Log response JSON
                        alert('An error occurred while updating the comment: ' + xhr
                            .responseText);
                    }
                });
            });
            // Cancel Edit
            $('.cancel-button').click(function() {
                $(this).closest('.edit-form').hide(); // Hide edit form
            });
        });
    </script>

</x-layout>
