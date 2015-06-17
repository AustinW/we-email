<html>
    <head>
        <title>{{ $email->subject }}</title>

    </head>
    <body>
        <p style="font-size:24px"><a href="/">&laquo; View All</a><br /></p>
        {!! $content !!}
        <hr />
        <div style="font-size:24px">
            @foreach ($email->attachments as $attachment)
               <li>{!! link_to_route('attachment', $attachment->original_name, $attachment->id) !!}</li>
            @endforeach
        </div>
    </body>
</html>
