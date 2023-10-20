@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="create-body-container">
            <div class="card">
                <div class="card-header">Expense List</div>
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
