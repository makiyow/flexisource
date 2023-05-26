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
        <h5 class="fw-bold text-primary mt-4 mb-3">Customer Details</h5>
        <div class="row">
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ ucwords($customer->getLastname()) }}, {{ ucwords($customer->getFirstname()) }}</h6>
                <label class="small text-muted">Fullname</label>
            </div>
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ $customer->getEmail() }}</h6>
                <label class="small text-muted">Email</label>
            </div>
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ $customer->getUsername() }}</h6>
                <label class="small text-muted">Username</label>
            </div>
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ ucfirst($customer->getGender()) }}</h6>
                <label class="small text-muted">Gender</label>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ $customer->getCountry() }}</h6>
                <label class="small text-muted">Country</label>
            </div>
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ $customer->getCity() }}</h6>
                <label class="small text-muted">City</label>
            </div>
            <div class="col-xs-12 col-lg-3 mb-3">
                <h6 class="mb-0">{{ $customer->getPhone() }}</h6>
                <label class="small text-muted">Phone</label>
            </div>
        </div>
        <div class="d-grid">
            <a href="{{ url('customers') }}" class="btn btn-primary">Back to Customer List</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>