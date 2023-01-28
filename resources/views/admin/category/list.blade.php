<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Hello, I am Category.</h1>
    <form action=" {{route('logout')}} " method="post">
        @csrf
        <input type="submit" class="btn btn-danger m-5" value="log Out">
    
    </form>
</body>
</html>