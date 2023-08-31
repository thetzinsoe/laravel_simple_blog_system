<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This is insert page</h1>
    <form action="{{route('customer#insert')}}" method="POST">
        @csrf
        name : <input type="text" name="customerName" required ><br>
        address : <textarea name="customerAddress" id="" cols="30" rows="10" required ></textarea><br>
        phone : <input type="text" name="customerPhone" required ><br>
        {{-- created_at : <input type="time" name="customerDate" required><br> --}}

        <input type="submit" value="save">
    </form>
</body>
</html>
