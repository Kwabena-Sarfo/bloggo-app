<x-blog-layout>
    <article class="bg-white p-6 rounded shadow mb-8">
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-64 object-cover rounded mb-4">
        @endif

        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">
            by {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
        </p>

        <div class="text-gray-800 leading-relaxed">{!! nl2br(e($post->body)) !!}</div>

        @can('update', $post)
            <div class="flex gap-3 mt-6 text-sm">
                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">Edit</a>
                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                      onsubmit="return confirm('Delete this post?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        @endcan
    </article>

    <h2 class="text-xl font-semibold mb-3">Comments ({{ $post->comments->count() }})</h2>

    @auth
        <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
            @csrf
            <textarea name="body" rows="3" class="w-full border rounded p-2" placeholder="Write a comment..."></textarea>
            @error('body') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Comment</button>
        </form>
    @else
        <p class="mb-6 text-gray-500">
            <a href="{{ route('login') }}" class="text-blue-600">Log in</a> to comment.
        </p>
    @endauth

    @foreach ($post->comments as $comment)
        <div class="bg-white p-4 rounded shadow mb-3">
            <p class="text-sm font-semibold">{{ $comment->user->name }}
                <span class="font-normal text-gray-500">· {{ $comment->created_at->diffForHumans() }}</span>
            </p>
            <p class="text-gray-700">{{ $comment->body }}</p>
        </div>
    @endforeach
</x-blog-layout>