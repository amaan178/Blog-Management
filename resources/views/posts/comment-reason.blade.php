@extends('layouts.admin-panel.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-header m-0">
            <h3>Select Reason for disapproving the Comment</h3>
        </div>
        <div class="card-body">
            <form action="{{route('comment.disapprove-comment', $comment->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Inappropriate Content">
                    <label class="form-check-label" for="exampleRadios1">
                        Inappropriate Content
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Links are from or lead to harmful or inappropriate sites">
                    <label class="form-check-label" for="exampleRadios2">
                        Links are from or lead to harmful or inappropriate sites
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="False Information">
                    <label class="form-check-label" for="exampleRadios1">
                        False Information
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="Hate speech or Symbols">
                    <label class="form-check-label" for="exampleRadios2">
                        Hate speech or Symbols
                    </label>
                </div>
                <button href="" type='submit' class="btn btn-sm btn-outline-danger mt-4">Submit Reason</button>
            </form>
        </div>
    </div>
@endsection

@section('page-level-scripts')
@endsection
