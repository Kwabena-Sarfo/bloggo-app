<x-blog-layout>
    <h1 class="text-2xl font-bold mb-6">Latest Posts</h1>

    @forelse ($posts as $post)
        <article class="bg-white p-5 rounded shadow mb-5">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded mb-3">
            @endif
            <h2 class="text-xl font-semibold">
                <a href="{{ route('posts.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
            </h2>
            <p class="text-sm text-gray-500 mb-2">
                by {{ $post->user->name }} · {{ $post->created_at->diffForHumans() }}
            </p>
            <p class="text-gray-700">{{ Str::limit($post->body, 150) }}</p>
        </article>
    @empty
        <p class="text-gray-500">No posts yet.</p>
    @endforelse

    {{ $posts->links() }}
</x-blog-layout>
