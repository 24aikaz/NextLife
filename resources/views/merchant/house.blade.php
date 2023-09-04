@extends('app')

@section('content')
    
    <div style="padding: 4rem 7rem">

        <p>This will show the products that only the current merchant has put on sale.</p>

        @if (auth()->user()->usertype == 'merchant')
                <form class="d-flex justify-content-end" action="{{ route('product') }}" method="GET">
                    <Button class="btn btn-outline-dark" title="Add product for sale!"><i
                            class="fa-solid fa-plus"></i></Button>
                </form>
        @endif
    </div>

@endsection