<html>
    <head>
        <title>World Elite Emails</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Emails</h1>
                    <table class="table table-border table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emails as $slug => $email)
                            <tr>
                                <td><a href="/email/{{ $email->id }}">{{ $email->created_at->format('m/d/y h:i A') }}</a></td>
                                <td><a href="/email/{{ $email->id }}">{{ $email->subject }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
