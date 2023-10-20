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
                    <h5>Hello, {{ auth()->user()->name }}, manage your expenses</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('list.income') }}" class="card card-body">
                        <h4>Total Incomes</h4>
                        <p>{{ $totalIncomes }}{{ " " }} BDT</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('list.expense') }}" class="card card-body">
                        <h4>Total Expenses</h4>
                        <p>{{ $totalExpenses }}{{ " " }} BDT</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="card card-body">
                        <h4>Total Transactions</h4>
                        <p>{{ $totalTransactionCount }}</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="card card-body">
                        <h4>Remaining Amount</h4>
                        <p>{{ $remainingAmount }}{{ " " }} BDT</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


