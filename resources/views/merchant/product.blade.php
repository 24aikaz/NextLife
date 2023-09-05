@extends('app')

@section('content')
    <div id="additem_content" style="padding-top: 5rem">

        <div class="card mx-auto">

            <form action="{{ route('product') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h2 class="title text-center">Sell item</h2>

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input class="form-control additem_input underline" type="text" name="pname" id="product_name">
                    @error('pname')
                        <div class="errormsg">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group"><label for="product_description">Product Description</label>
                    <input class="form-control additem_input underline" type="textarea" name="pdesc" id="product_description">
                    @error('pdesc')
                        <div class="errormsg">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="starting_price">Starting Price</label>
                    <input class="form-control additem_input underline" type="number" name="startprice" id="starting_price" placeholder="$">
                    @error('startprice')
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
                    <label for="image">Select image to upload:</label><br>
                    <input class="form-control additem_input" type="file" name="image" accept="image/*" id="image"
                        required>
                    @error('image')
                        <div class="errormsg">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="sell_btn btn btn-outline-dark" type="submit">Place for bidding</button>
            </form>

        </div>

    </div>

    @vite(['resources/js/uploadproduct.js'])
@endsection
