@extends('app')

@section('content')
    <div id="additem_content" style="padding-top: 5rem">
        <p>Sell new item</p>

        @error('pname')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror
        @error('pdesc')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror
        @error('startprice')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror
        @error('category')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ route('product') }}" method="POST">
            @csrf

            <label for="product_name">Product Name</label>
            <input type="text" name="pname" id="product_name">

            <label for="product_description">Product Description</label>
            <input type="textarea" name="pdesc" id="product_description">

            <label for="status">Status</label>
            <input type="text" name="status" id="status" placeholder="Active">

            <label for="starting_price">Starting Price</label>
            <input type="number" name="startprice" id="starting_price">

            <label for="nameforidkwhat">Name for idk what</label>
            <input type="text" name="name" id="nameforidkwhat">

            <label for="product_category">Category</label>
            <select name="category" id="product_category">
                <option value="Cameras">Cameras</option>
                <option value="Computers and Accessories">Computers and Accessories</option>
                <option value="Home Decor">Home Decor</option>
                <option value="Kitchen">Kitchen</option>
                <option value="Miscellaneous">Miscellaneous</option>
                <option value="Mobiles">Mobiles</option>
                <option value="Phones">Phones</option>
                <option value="Wearables">Wearables</option>
            </select>

            <button type="submit">Submit</button>

        </form>

    </div>
@endsection
