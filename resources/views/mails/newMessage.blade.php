<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>New message from contacts form</h2>
    <ul>
        <li><strong>Name: </strong>{{$newContactMessage->name}}</li>
        <li><strong>Lastname: </strong>{{$newContactMessage->lastname}}</li>
        <li><strong>Email: </strong>{{$newContactMessage->email}}</li>
        <li><strong>Message: </strong>{{$newContactMessage->message}}</li>
    </ul>
</body>
</html>