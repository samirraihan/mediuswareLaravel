<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mx-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Banking System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transactions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active" href="{{ route('deposit.create') }}">Deposits</a></li>
                            <li><a class="dropdown-item" href="{{ route('withdraw.create') }}">Withdrawals</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="mt-4">
                    <span class="text-xl font-bold">{{ Auth::user()->name }}</span>
                    <!-- logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Welcome {{ Auth::user()->name }}</h2>
        <div class="mt-4">
            <h4>Your balance</h4>
            <h5>{{ Auth::user()->balance }}</h5>
        </div>
        <div class="mt-4">
            <form action="{{ route('deposit.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Add Deposit Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <table class="table mt-4">
                @if (count($transactions) === 0)
                <tr>
                    <td colspan="5">No transactions found</td>
                </tr>
                @else
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->transaction_type }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
</body>

</html>