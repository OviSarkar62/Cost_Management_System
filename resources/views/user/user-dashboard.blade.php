@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Hello, {{ ucwords(auth()->user()->name) }}, manage your expenses</h5>
                </div>
            </div>

            <div class="row">
                <!-- Total Incomes Card -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="{{ route('list.income') }}" style="color: black; text-decoration: none;">
                                <h4>Total Incomes</h4>
                                <p>{{ $totalIncomes }}{{ " " }} BDT</p>
                            </a>
                        </div>
                        <canvas id="incomePieChart" width="100" height="100"></canvas>
                    </div>
                </div>

                <!-- Total Expenses Card -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="{{ route('list.expense') }}" style="color: black; text-decoration: none;">
                                <h4>Total Expenses</h4>
                                <p>{{ $totalExpenses }}{{ " " }} BDT</p>
                            </a>
                        </div>
                        <canvas id="expensePieChart" width="100" height="100"></canvas>
                    </div>
                </div>

                <!-- Total Transactions Card -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Total Transactions</h4>
                            <p>{{ $totalTransactionCount }}</p>
                        </div>
                        <canvas id="transactionPieChart" width="100" height="100"></canvas>
                    </div>
                </div>

                <!-- Remaining Amount Card -->
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Remaining Amount</h4>
                            <p>{{ $remainingAmount }}{{ " " }} BDT</p>
                        </div>
                        <canvas id="remainingAmountPieChart" width="100" height="100"></canvas>
                    </div>
                </div>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // JavaScript code for rendering pie charts
        var incomeData = {
            labels: ['Income', 'Remaining'],
            datasets: [{
                data: [{{ $totalIncomes }}, {{ $remainingAmount }}],
                backgroundColor: ['#36a2eb', '#FFCE56'],
            }]
        };

        var expenseData = {
            labels: ['Expense', 'Remaining'],
            datasets: [{
                data: [{{ $totalExpenses }}, {{ $remainingAmount }}],
                backgroundColor: ['#ff6384', '#FFCE56'],
            }]
        };

        var incomePieChart = new Chart(document.getElementById('incomePieChart').getContext('2d'), {
            type: 'pie',
            data: incomeData
        });

        var expensePieChart = new Chart(document.getElementById('expensePieChart').getContext('2d'), {
            type: 'pie',
            data: expenseData
        });
        /*kkkhsedkdhnseudweudheudh*/
        var totalTransactions = {{ $totalTransactionCount }};
var totalIncomeCount = {{ $totalIncomeCount }};
var totalExpenseCount = {{ $totalExpenseCount }};
var incomeProportion = 100*totalIncomeCount / totalTransactions;
var expenseProportion = 100*totalExpenseCount / totalTransactions;
var remainingAmountProportion = 1 - incomeProportion - expenseProportion;

// JavaScript code for rendering pie charts
var transactionData = {
    labels: ['Income', 'Expenses'],
    datasets: [{
        data: [incomeProportion, expenseProportion],
        backgroundColor: ['#36a2eb', '#ff6384'],
    }]
};

var remainingAmountData = {
    labels: ['Spent','Remaining Amount'],
    datasets: [{
        data: [{{ $totalExpenses }}, {{ $remainingAmount }}],
        backgroundColor: ['#36a2eb', '#FFCE56'],
    }]
};

var transactionPieChart = new Chart(document.getElementById('transactionPieChart').getContext('2d'), {
    type: 'pie',
    data: transactionData
});

var remainingAmountPieChart = new Chart(document.getElementById('remainingAmountPieChart').getContext('2d'), {
    type: 'pie',
    data: remainingAmountData
});

    </script>
@endsection


