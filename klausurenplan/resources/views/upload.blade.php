{{-- resources/views/upload.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>CSV Upload</title>
</head>
<body>
    <h1>Upload a CSV File</h1>
    <form action="{{ route('csv.form') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
