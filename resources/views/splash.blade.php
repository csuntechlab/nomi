<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue SPA Demo</title>
</head>

<div id="app">
    <splash></splash>
</div>

<div>
    <a href='{!! url('/courses/2173'); !!}'>Course List</a>
</div>
<br/>
<div>
    <a href='{!! url('/students/2173/0') !!}'>Student List</a>
</div>
<br />
<div>
    <a href='{!! url('students/shuffle/2173/0') !!}'>Shuffled Students</a>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>