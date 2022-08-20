
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Upload Millions Records Laravel - CodeCeef</title>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <form action="{{ route('test.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv">
                <input type="submit" value="submit">
          </form>

        </div>
    </body>
</html>