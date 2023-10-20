@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="create-body-container">
            <div class="card">
                <div class="card-header">Income List</div>
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
                            @foreach($incomes as $income)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $income->title }}</td>
                                <td>{{ $income->description }}</td>
                                <td>{{ $income->amount }}</td>
                                <td>{{ date('d-m-Y', strtotime($income->date . '+06:00')) }}</td>
                                <td>
                                    <a href="{{ route('edit.income', $income->id) }}" class="btn btn-primary">Edit</a>
                                    <form method="POST" action="{{ route('destroy.income', $income->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this income?')">Delete</button>
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
