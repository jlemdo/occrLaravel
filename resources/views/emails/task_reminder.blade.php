<!DOCTYPE html>
<html>
<head>
    <title>Task Reminder</title>
</head>
<body>
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>
    <p>Deadline: {{ $task->date }} {{ $task->time }}</p>
    <a href="{{ url('leaddetails/'.$task->leadid) }}">View Task Details</a>

</body>
</html>
