<div class="mb-4">
    <label class="block mb-1">Title</label>
    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}"
           class="w-full border rounded p-2">
    @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Body</label>
    <textarea name="body" rows="8" class="w-full border rounded p-2">{{ old('body', $post->body ?? '') }}</textarea>
    @error('body') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block mb-1">Cover image (optional)</label>
    <input type="file" name="image">
    @error('image') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
</div>