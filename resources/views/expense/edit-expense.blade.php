@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="create-body-container">
                <div class="card">
                    <div class="card-header">
                        Edit Expense
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.expense', $expense->id) }}">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updates -->

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $expense->title }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" required>{{ $expense->description }}</textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $expense->date }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control" value="{{ $expense->amount }}" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
