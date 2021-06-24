@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss = "alert" aria-label = "Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session()->get('error') }}
        <button type="button" class="close" data-dismiss = "alert" aria-label = "Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
