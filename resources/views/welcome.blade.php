<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="../../img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/mdb.rtl.min.css') }}" />
    <!-- PRISM -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/new-prism.css') }}" />
    <!-- Custom styles -->
    <style></style>
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-5">Popovers</h2>

        <div class="mb-5">
            <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title"
                data-content="And here's some amazing content. It's very engaging. Right?">
                Click to toggle popover
            </button>
        </div>

        <div class="mb-5">
            <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover"
                data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                Popover on top
            </button>

            <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover"
                data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                Popover on right
            </button>

            <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover"
                data-placement="bottom" data-content="Vivamus
      sagittis lacus vel augue laoreet rutrum faucibus.">
                Popover on bottom
            </button>

            <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover"
                data-placement="left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                Popover on left
            </button>
        </div>

        <div class="mb-5">
            <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="focus"
                title="Dismissible popover"
                data-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a>
        </div>

        <div class="mb-5">
            <span class="d-inline-block" data-toggle="popover" data-content="Disabled popover">
                <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>
                    Disabled button
                </button>
            </span>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/admin/mdb-demo/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>
