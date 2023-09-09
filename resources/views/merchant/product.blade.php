@extends('app')

@section('content')
    <div id="additem_content">

        @if (auth()->user()->usertype == 'merchant')
            <div class="card mx-auto">
                <h2 class="title text-center">Sell Product</h2>
            </div>

            <div class="card mx-auto">

                <form action="{{ route('product') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input class="form-control additem_input underline" type="text" name="pname" id="product_name"
                            autocomplete="off">
                        @error('pname')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group"><label for="product_description">Product Description</label>
                        <textarea class="form-control additem_input underline" name="pdesc" id="product_description" rows="3"></textarea>
                        {{-- <input class="form-control additem_input underline" type="textarea" name="pdesc" id="product_description"> --}}
                        @error('pdesc')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="starting_price">Starting Price</label>
                        <input class="form-control additem_input underline" type="number" name="startprice"
                            id="starting_price" placeholder="$">
                        @error('startprice')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="start_date">Auction starts on:</label>
                        <input class="form-control additem_input underline" type="datetime-local" name="startdate"
                            id="start_date">
                        @error('startdate')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="end_date">Auction ends on:</label>
                        <input class="form-control additem_input underline" type="datetime-local" name="enddate"
                            id="end_date">
                        @error('enddate')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_category">Category</label>
                        <select name="category" id="product_category">
                            <option selected="" value="Mobiles">Mobiles</option>
                            <option value="Wearables">Wearables</option>
                            <option value="Computers and Accessories">Computers and Accessories</option>
                            <option value="Cameras">Cameras</option>
                            <option value="Phones">Phones</option>
                            <option value="Kitchen">Kitchen</option>
                            <option value="Home Decor">Home Decor</option>
                            <option value="Miscellaneous">Miscellaneous</option>
                        </select>
                        @error('category')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Select image to upload:</label>
                        <input class="form-control additem_input" type="file" name="image" accept="image/*"
                            id="image">
                        @error('image')
                            <div class="errormsg">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="sell_btn btn btn-outline-dark d-flex" type="submit">Place for bidding</button>
                    </div>

                </form>

            </div>
        @else
            <div class="mx-auto errormsg">
                <h1 class="text-center">ACCESS DENIED!</h1>
            </div>
        @endif

    </div>

    @vite(['resources/js/uploadproduct.js'])
@endsection
