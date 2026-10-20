<x-blog-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('posts.form')
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-blog-layout>    