<x-blog-layout>
    <h1 class="text-2xl font-bold mb-4">Write a Post</h1>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        @include('posts.form')
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Publish</button>
    </form>
</x-blog-layout>