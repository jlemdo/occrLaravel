<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Images</title>
</head>
<body>
    <h1>List of Images</h1>
    @if(count($imageFiles) > 0)
        <ul>
            @foreach($imageFiles as $file)
                <li>{{ $file['basename'] }}</li>
            @endforeach
        </ul>
    @else
        <p>No images found on Google Drive.</p>
    @endif
</body>
</html>
