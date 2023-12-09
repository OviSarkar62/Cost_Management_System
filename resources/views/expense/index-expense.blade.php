@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="create-body-container">
            <div class="card">
                <div class="card-header">Expense List</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <form action="{{ route('search.expense') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('filter.expense') }}" method="GET" class="d-flex">
                            <select name="filter" class="form-control mr-2">
                                <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="this_week" {{ request('filter') == 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="this_month" {{ request('filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_2_months" {{ request('filter') == 'last_2_months' ? 'selected' : '' }}>Last 2 Months</option>
                                <option value="last_3_months" {{ request('filter') == 'last_3_months' ? 'selected' : '' }}>Last 3 Months</option>
                                <option value="last_6_months" {{ request('filter') == 'last_6_months' ? 'selected' : '' }}>Last 6 Months</option>
                                <option value="last_year" {{ request('filter') == 'last_year' ? 'selected' : '' }}>Last Year</option>
                            </select>
                            <button type="submit" class="btn btn-outline-secondary">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $expense)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $expense->title }}</td>
                                <td>{{ $expense->description }}</td>
                                <td>{{ $expense->amount }}</td>
                                <td>{{ date('d-m-Y', strtotime($expense->date . '+06:00')) }}</td>
                                <td>
                                    <a href="{{ route('edit.expense', $expense->id) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('destroy.expense', $expense->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
