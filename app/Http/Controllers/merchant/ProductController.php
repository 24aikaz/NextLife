<?php

namespace App\Http\Controllers\merchant;

use App\Models\Bid;
use App\Models\Order;
use App\Models\Auction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        return view('merchant.product');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform a search query on the products
        $products = Product::where('pname', 'like', '%' . $query . '%')
            ->orWhere('pdesc', 'like', '%' . $query . '%')
            ->get();

        return view('search', [
            'products' => $products
        ]);
    }

    public function addproduct(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([
            'pname' => 'required',
            'pdesc' => 'required',
            'startprice' => 'required|numeric',
            'category' => 'required',
            'image' => 'required|image',
            'status' => 'nullable|in:active,inactive',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        // Handle image upload
        $imageName = $request->file('image')->getClientOriginalName();
        $imageData = $request->file('image')->store('images', 'public');

        // Create and save the product using create method
        $product = Product::create([
            'pname' => $validatedData['pname'],
            'pdesc' => $validatedData['pdesc'],
            'name' => $imageName,
            'image' => $imageData,
            'startprice' => $validatedData['startprice'],
            'currentprice' => $validatedData['startprice'],
             'status' => 'Active', // Set it to "active" by default
            'bidcount' => 0,
            'category' => $request->input('category'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'seller_id' => auth()->id(), // Associate the product with the logged-in user
        ]);

        return redirect()->back();
    }

    public function getProducts(Request $request)
    {
        $products = Product::all();

        return response()->json($products);
    }
    public function destroy(Request $request, $Product_ID)
{
    try {
        // Find the product by ID
        $product = Product::find($Product_ID);

        if (!$product) {
            // Product not found, return an error message or redirect as needed
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Check if the logged-in user is the owner of the product
        if ($product->seller_id != auth()->user()->id) {
            // Unauthorized access, return an error message or redirect as needed
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        // Find and delete the associated auctions by Product_ID
        Auction::where('Product_ID', $Product_ID)->delete();
        
        // Find and delete the associated bids by product_id
        Bid::where('product_id', $Product_ID)->delete();

        // Delete the product
        $product->delete();

        // Return a success message
        return response()->json(['message' => 'Product and associated auctions/bids deleted successfully.']);
    } catch (\Exception $e) {
        // Use dd() to dump information about the exception for debugging
        dd($e);
        // Handle the exception and return an error response
        return response()->json(['message' => 'An error occurred while deleting the product.'], 500);
    }
}

public function getWonProducts()
{
    // Get the logged-in user's ID
    $userId = Auth::id();

    // Retrieve won products using the auctions table
    $wonProducts = Auction::where('winner_id', $userId)
        ->join('products', 'auctions.Product_ID', '=', 'products.Product_ID')
        ->select('products.*')
        ->get();

    return view('won-products', ['wonProducts' => $wonProducts]);
}
public function checkout()
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    $products = Product::all();
    $lineItems = [];
    $totalPrice = 0;
    foreach ($products as $product) {
        $totalPrice += $product->winning_bid;
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->pname,
                    'images' => [$product->image]
                ],
                'unit_amount' => $product->winning_bid * 100,
            ],
            'quantity' => 1,
        ];
    }
    $session = \Stripe\Checkout\Session::create([
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
        'cancel_url' => route('checkout.cancel', [], true),
    ]);

    $order = new Order();
    $order->status = 'unpaid';
    $order->total_price = $totalPrice;
    $order->session_id = $session->id;
    $order->save();

    return redirect($session->url);
}

public function success(Request $request)
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $sessionId = $request->get('session_id');

    try {
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        if (!$session) {
            throw new NotFoundHttpException;
        }
        $customer = \Stripe\Customer::retrieve($session->customer);

        $order = Order::where('session_id', $session->id)->first();
        if (!$order) {
            throw new NotFoundHttpException();
        }
        if ($order->status === 'unpaid') {
            $order->status = 'paid';
            $order->save();
        }

        return view('product.checkout-success', compact('customer'));
    } catch (\Exception $e) {
        throw new NotFoundHttpException();
    }

}



}