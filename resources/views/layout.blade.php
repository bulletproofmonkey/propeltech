<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Address Book {{ $title ? '- ' . $title : ''}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @if(isset($js))
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script src="/addressBook.js"></script>
    @endif
</head>
<body>
<div class="m-5">
    <div class="pb-5">
        <h1>Address Book {{ $title ? '- ' . $title : ''}}</h1>
        @if (isset($type) && $type === 'spa')
            <a href="/">Traditional Form Submission App</a>
        @else
            <a href="/spa">Single Page Application (via API)</a>
        @endif
    </div>
    @yield('content')
</div>
</body>
</html>
