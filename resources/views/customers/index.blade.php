<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flexisource Coding Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <h5 class="fw-bold text-primary mt-4 mb-3">Customer List</h5>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col">Country</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers AS $c)
                <tr>
                    <td>{{ $c->getFirstname() }} {{ $c->getLastname() }}</td>
                    <td>{{ $c->getEmail() }}</td>
                    <td>{{ $c->getCountry() }}</td>
                    <td class="d-grid">
                        <a href="{{ url('customers') }}/{{ $c->getId() }}" class="btn btn-sm btn-primary btn-block">
                            Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>