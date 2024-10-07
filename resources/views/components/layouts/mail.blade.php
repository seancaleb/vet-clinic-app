<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $mail_subject }}</title>

    {{-- Styles for the mail template layout --}}
    <style>
        html {
            color: #1e293b
        }

        p {
            font-size: 18px;
            color: #1e293b
        }

        b,
        li {
            font-size: 18px;
            color: #1e293b
        }

        .section_mail {
            padding-top: 80px;
            padding-bottom: 80px;
            background: #F6F7FE;
        }

        .mail_wrapper {
            padding: 48px;
            max-width: 512px;
            margin: auto;
            background: white;
            width: 100%;
            border-radius: 16px;
        }

        .mail_heading {
            margin: 0;
            color: #020617
        }
    </style>
</head>

<body>
    <div class="section_mail">
        <div class="mail_wrapper">
            {{-- Mail heading  --}}
            <h2 class="mail_heading">{{ $heading }}</h2>

            {{-- Mail body content  --}}
            {{ $slot }}
        </div>
    </div>
</body>

</html>
