<!DOCTYPE html>
<html>
<head>
    <title>This Email Send To by LMS System</title>
</head>
<body>
    <h3>User Name : {{ $user['name'] }}</h3>
    <h3>Password : {{ $user['password'] }}</h3>
    <p>If You Confirm Your Password <a href="{{url('forget-password',$user['url'])}}">Click Here</a></p>
</body>
</html>
