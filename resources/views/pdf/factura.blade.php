<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
</head>

<body>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach ($data['headers'] as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data['items'] as $item)
                    <tr>
                        @foreach ($item as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
