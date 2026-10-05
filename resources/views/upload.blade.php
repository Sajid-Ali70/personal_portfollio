<!DOCTYPE html>
<html>
<head>
    <title>Image Enhancer</title>
</head>
<body>
    <h2>Upload and Enhance Image</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
        <img src="{{ asset(session('path')) }}" alt="Enhanced Image" width="300">
    @endif

    <form method="POST" action="{{url('/upload')}}" enctype="multipart/form-data">
        @csrf
        <label for="image">Choose Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload & Enhance</button>
    </form>
</body>
</html>
