<!DOCTYPE html>
<html>
<head>
    <title>Holiogt- Welcome Registration</title>
</head>
<body>
    <header>
            <strong>WELCOME TO HELIO GREENTECH</strong>
    </header>

    <main>
        <p><strong>Dear {{$user->first_name.' '.$user->last_name}}</strong></p><br />
        <p>You are successfully registered to our portal.</p>
        <p>You can login here <a href="{{URL('/')}}">Holiogt Portal</a></p>
        <br />
		<p><strong>Login Details: </strong></p>
		<p><strong>Username: "{{$user->email}}" </strong></p>
		<p><strong>Password: {{$randomPassword}} </strong></p>
    </main>

    <footer>
    <img src="{{ $message->embed($logoPath, 'logo') }}" alt="Holiogt Portal" width="80">
    	<p><strong>Helio GreenTech</strong></p>
        <p><strong>Email: info@heliogt.com</strong></p>
        <p><strong>Contact: 866-435-4648</strong></p>
    </footer>
</body>
</html>