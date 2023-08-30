@extends('app')

@section('content')
    <div id="additem_content" style="padding-top: 5rem">
        <p>Sell new item</p>

        <form action="{{ route('product') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <p>
                <label for="product_name">Product Name</label>
                <input type="text" name="pname" id="product_name">
                @error('pname')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <p>
                <label for="product_description">Product Description</label>
                <input type="textarea" name="pdesc" id="product_description">
                @error('pdesc')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <p>
                <label for="starting_price">Starting Price</label>
                <input type="number" name="startprice" id="starting_price">
                @error('startprice')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <p>
                <label for="product_category">Category</label>
                <select name="category" id="product_category">
                    <option selected="" value="0">Mobiles</option>
                    <option value="2">Wearables</option>
                    <option value="4">Computers and Accessories</option>
                    <option value="5">Cameras</option>
                    <option value="6">Phones</option>
                    <option value="7">Kitchen</option>
                    <option value="8">Home Decor</option>
                    <option value="9">Miscellaneous</option>
                </select>
                @error('category')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <p>
                <label for="mobile">Mobile Number</label>
                <input type="text" name="mobile" id="mobile" placeholder="Mobile no." required>
                @error('mobile')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <p>
                <label for="image">Select image to upload:</label><br>
                <input type="file" name="image" accept="image/*" id="image" required>
                @error('image')
                    <div style="color: red">
                        {{ $message }}
                    </div>
                @enderror
            </p>
        
            <button type="submit">Submit</button>
        </form>
        
        

         
    </div>
    @endsection
    

    