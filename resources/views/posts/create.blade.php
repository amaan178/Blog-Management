@extends('layouts.admin-panel.app')

@section('page-level-styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
        integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')



    <div class="card">
        <div class="card-header m-0">
            Add a new post
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" placeholder="Enter post title">
                    @error('title')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <input type="text" name="excerpt" id="excerpt"
                        class="form-control @error('excerpt') is-invalid @enderror" value="{{ old('excerpt') }}"
                        placeholder="Enter post excerpt">
                    @error('excerpt')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                    <trix-editor input="content">
                    </trix-editor>
                    @error('content')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category_id" class="select2 form-control">
                        <option></option> {{-- blank option for placeholder --}}
                        @foreach ($categories as $category)
                            @if ($category->id == old('category_id'))
                                <option value="{{ $category->id }} " selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endif
                        @endforeach
                    </select>
                    @error('category')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <select name="tags[]" id="tag_id" class="select2 form-control" multiple>
                        <option></option> {{-- blank option for placeholder --}}
                        @foreach ($tags as $tag)
                            {{-- @if ($tag->id == old('tag_id'))
                                <option value="{{ $tag->id }} " selected>{{ $tag->name }}</option>
                            @else
                                <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                            @endif --}}
                            <option value=" {{ $tag->id }} "
                                {{ old('tags') && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('tag')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" published_at="published_at" id="published_at"
                        class="form-control @error('published_at') is-invalid @enderror"
                        value="{{ old('published_at') }}" placeholder="Enter post published_at">
                    @error('published_at')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                    @error('image')
                        <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
@endsection


@section('page-level-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.select2').select2({
            placeholder: 'Select an option',
        });
        flatpickr("#published_at", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: new Date(),
        });
    </script>
@endsection
