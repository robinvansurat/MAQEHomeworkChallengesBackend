<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="maqebot" class="form-label">maqebot</label>
                            <input type="email" class="form-control" id="maqebot"
                                placeholder="Enter the code" onchange="maqebot()">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="result_codex">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>

</html>
