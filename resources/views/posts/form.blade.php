@csrf
<div class="md-form">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" required value="{{ $post->title ?? old('title') }}">
</div>
<div class="form-group">
    <label></label>
    <textarea name="body" required class="form-control" rows="16" placeholder="本文">{{ $post->body ?? old('body') }}</textarea>
</div>

<div class="form-group row">
    <label>画像</label>
    <input type="file" class="form-control-file" name="image">
    {{ $post->image_path ?? old('image_path') }}
</div>