<!DOCTYPE html>
<html>

<head>
    <title>Email con Adjunto</title>
</head>

<body>
    <h1>{{ $asunto }}</h1>
    <p>{{ $mensaje }}</p>

    @if (!empty($attachments))
        <p>Informacion adicional</p>
        <ul>
            @foreach ($attachments as $attachment)
                <li><span>{{ $attachment }}</span></li>
            @endforeach
        </ul>
    @endif
</body>

</html>
