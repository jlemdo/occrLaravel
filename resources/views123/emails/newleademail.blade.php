<!DOCTYPE html>
<html>
<head>
    <title>Helio GreenTech- Your proposal</title>
</head>
<body>
   <!-- <header><strong>Subject: Your Custom Solar Proposal from Helio GreenTech</strong></header>-->

    <main>
        <p><strong>Hi {{$name}}</strong></p>
        <p>Thank you for considering Helio GreenTech for your solar energy needs! </p>
        <p>New Lead has been created</p>
    </main>

    <footer>
    <img src="{{ $message->embed($logoPath, 'logo') }}" alt="Holiogt Portal" width="80">
    	<p><strong>Best Regards</strong></p>
        <p><strong>Zac Caro</strong></p>
        <p><strong>Sales Manager</strong></p>
        <p><strong>Helio GreenTech</strong></p>
        <p><strong>913-732-1216</strong></p>
        <p><strong>zcaro@heliogt.com</strong></p>
    </footer>
</body>
</html>