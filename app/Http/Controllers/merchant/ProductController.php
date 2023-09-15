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
            'status' => 'Active',
            // Set it to "active" by default
            'bidcount' => 0,
            'category' => $request->input('category'),
            'startdate' => $request->input('startdate'),
            'enddate' => $request->input('enddate'),
            'seller_id' => auth()->id(),
            // Associate the product with the logged-in user
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
            ->orderBy('created_at', 'desc')
            ->get();

        return view('won-products', ['wonProducts' => $wonProducts]);
    }
    public function checkout(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the product ID from the request
        $productId = $request->input('Product_ID');

        // Find the product by ID
        $product = Product::find($productId);

        if (!$product) {
            // Handle the case where the product is not found (e.g., return an error message)
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Create a line item for the selected product
        $lineItem = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->pname,
                ],
                'unit_amount' => $product->winning_bid * 100,
            ],
            'quantity' => 1,
        ];

        // Create a checkout session for the single product
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [$lineItem],
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $product->winning_bid;
        $order->session_id = $session->id;
        $order->save();

        return redirect($session->url);
    }


    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');
        $error = null; // Initialize the $error variable
        $username = null; // Initialize the $username variable

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            // Get the currently logged-in user
            $user = Auth::user();

            if ($user) {
                $username = $user->username;
            }

            $order = Order::where('session_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            return view('checkout-success', compact('username'));

        } catch (\Exception $e) {
            $error = 'An error occurred: ' . $e->getMessage();

        }

    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }

            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }
}