{{-- @component('mail::message')

<h3>Exam Title : {{ $user['exam_title'] }}</h3>
<h3>Date : {{ $user['date'] }}</h3>
<h3>Start Time : {{ $user['start_time'] }}</h3>
<h3>End Time : {{ $user['end_time'] }}</h3>

@endcomponent
 --}}


 <!DOCTYPE html>
<html>
<head>
    <title>This Email generated by DDC</title>
</head>
<body>
    <h3>Exam Title : {{ $user['exam_title'] }}</h3>
    <h3>Date : {{ $user['date'] }}</h3>
    <h3>Start Time : {{ $user['start_time'] }}</h3>
    <h3>End Time : {{ $user['end_time'] }}</h3>
</body>
</html>
