<html>
    <head>
        <title>World Elite Emails</title>

        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
        <style>
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
                margin-bottom: 40px;
            }

            .content {
                font-size: 24px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1 class="title">Emails</h1>
				
				<ul class="nav nav-pills nav-stacked">
					@foreach ($emails as $slug => $email)
					<li><a href="/view/{{ $slug }}">{{ $email }}</a></li>
					@endforeach
				</ul>
            </div>
        </div>
    </body>
</html>
