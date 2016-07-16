<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

    <p> Dear Sir/Madam, </p>

    <p>Your job has been posted to our job board sucessfully.</p>

    <p>Job Title: {{{ $job->title }}}</p>
    <p>Job Details: {{{ $job->details }}} </p>
    <p>Skills: </p>
    <ul>
        @foreach($job->skills as $skill)
            <li>{{ $skill->name }}</li>
        @endforeach
    </ul>

    <p>You may use the link below to edit your job post</p>
    <p>Edit Link: <a href="{{ route('job.edit', ['uuid' => $job->uuid]) }}">{{ route('job.edit', ['uuid' => $job->uuid]) }}</a> </p>

    <p>Instead if you are no longer looking to hire 
       or have filled the position already, 
       please use the link below to remove your listing.
    </p>
    <p> Delete Link: <a href="{{ route('job.delete', ['uuid' => $job->uuid]) }}">{{ route('job.delete', ['uuid' => $job->uuid]) }}</a> </p>

    <p>Best regards,</p>

    <p>Job Portal</p>
    <p>&copy; Sameer Nyaupane</p>

</body>
</html>
