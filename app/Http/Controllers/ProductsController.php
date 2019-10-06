<?php

namespace App\Http\Controllers;


use App\Category;
use App\Order;
use App\OrdersProduct;
use App\ProductImage;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Contracts\Session\Session;
use Intervention\Image\Facades\Image;
use App\Product;
use App\User;
use App\Country;
use App\DeliveryAddress;
use Session;




class ProductsController extends Controller
{
    public function addProduct(Request $request){

        if($request->isMethod('post')) {
            $data = $request->all();

            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Under Category is missing');
            }
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                $product->description = '';
            }
            if(!empty($data['care'])){
                $product->care = $data['care'];
            }else{
                $product->care = '';
            }
            $product->price = $data['price'];

            //upload photos
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //ajustar tamanhos
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    //store photos name in products table

                    $product->image = $filename;
                }
            }

            $product->save();
            return redirect('/admin/view-products')->with('flash_message_success','Product has been added Successfully');

         }

        // Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value= '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        // Categories drop down end
        return view('admin.products.add_product',['categories_dropdown'=>$categories_dropdown]);
    }
    public function editProduct(Request $request, $id){

        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;

                    //ajustar tamanhos
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                }else{
                    $filename = $data['current_image'];
                }

                if(empty($data['description'])){
                    $data['description'] = '';
                }
                if(empty($data['care'])){
                    $data['care'] = '';
                }
            }

            if (empty($data['status'])){
                $status = 0;
            } else{
                $status = 1;
            }

            Product::where(['id'=>$id])->update([
                'category_id'=>$data['category_id'],
                'product_name'=>$data['product_name'],
                'product_code'=>$data['product_code'],
                'product_color'=>$data['product_color'],
                'description'=>$data['description'],
                'care'=>$data['care'],
                'price'=>$data['price'],
                'image'=>$filename,
                'status'=>$status]);

            return redirect()->back()->with('flash_message_success','Product has been updated successfully!');
        }

        // Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();

        // Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($categories as $cat){
            if($cat->id==$productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id==$productDetails->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value= '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        // Categories drop down end

        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }
    public function viewProducts(){
        $products = Product::orderby('id','DESC')->get();
        foreach($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name['name'];
        }
        return view('admin.products.view_products')->with(compact('products'));
    }
    public function deleteProduct(Request $request, $id){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been delete successfully!');
    }
    public function deleteProductImage($id){

        // Get Product Image Name
        $productImage=Product::where(['id'=>$id])->first();

        //Get Product Image Paths
        $large_image_path = 'imagens/backend_images/products/large/';
        $medium_image_path = 'imagens/backend_images/products/medium/';
        $small_image_path = 'imagens/backend_images/products/small/';

        // Delete Large Image if not exists in folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }



        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }

    // ATTRIBUTES

    // ADD ATTRIBUTE
    public function addAttribute(Request $request, $id){
        $productDetails = Product::with(['attributes'])->where(['id'=>$id])->first();
//        $productDetails = json_decode(json_encode($productDetails));
        if($request->isMethod('post')){
            $data = $request->all();

            foreach ($data['sku'] as $key => $val){
                if(!empty($val)){
                    // SKU Check
                    $attrCountSKU = ProductsAttribute::where('sku', $val)->count();
                    if ($attrCountSKU > 0) {
                        return redirect('admin/add-attributes/' . $id)
                            ->with('flash_message_error', 'SKU already exists! Please add a different SKU');
                    }

                    // Product Size Check
                    $attrCountSize = ProductsAttribute::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if ($attrCountSize > 0) {
                        return redirect('admin/add-attributes/' . $id)
                            ->with('flash_message_error', '"' . $data['size'][$key] .
                                '" Size already exists for this product! Please add a different Size');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }

            return redirect('admin/add-attributes/'.$id)->with('flash_message_success','Product Attributes has been added successfully!');

        }
        return view('admin.products.add_attributes',['productDetails'=>$productDetails]);
    }

    // DELETE ATTRIBUTE

    public function deleteAttribute($id){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute has been deleted successfully!');
    }

    public function editAttributes(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
            foreach ($data['idAttr'] as $key => $attr) {

                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update
                (['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
        return redirect()->back()->with('flash_message_success','Products Attributes has been updated successfully!');

        }
    }

    // ADD IMAGES
    public function addImages(Request $request, $id)
    {
        $productDetails = Product::where(['id' => $id])->first();
        $categoryDetails = Category::where(['id' => $productDetails->category_id])->first();
        $category_name = $categoryDetails['name'];

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach ($files as $file) {
                    // Upload images after resizing
                    $image = new ProductImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/backend_images/products/large/' . $fileName;
                    $medium_image_path = 'images/backend_images/products/medium/' . $fileName;
                    $small_image_path = 'images/backend_images/products/small/' . $fileName;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);
                    $image->image = $fileName;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }
            return redirect('admin/add-images/' . $id)->with('flash_message_success', 'Product Images added successfully!');
        }

        $productImages = ProductImage::where(['product_id' => $id])->orderBy('id', 'DESC')->get();
        $title = "Add Images";
        return view('admin.products.add_images')->with(compact('title', 'productDetails', 'category_name', 'productImages'));

    }

    public function deleteAltImage($id)
    {
        // Get Product Image Name
        $productImage = ProductImage::where(['id' => $id])->first();

        //Get Product Image Paths
        $large_image_path = 'imagens/backend_images/products/large/';
        $medium_image_path = 'imagens/backend_images/products/medium/';
        $small_image_path = 'imagens/backend_images/products/small/';

        // Delete Large Image if not exists in folder
        if (file_exists($large_image_path . $productImage->image)) {
            unlink($large_image_path . $productImage->image);
        }

        // Delete Medium Image if not exists in folder
        if (file_exists($medium_image_path . $productImage->image)) {
            unlink($medium_image_path . $productImage->image);
        }

        // Delete Small Image if not exists in folder
        if (file_exists($small_image_path . $productImage->image)) {
            unlink($small_image_path . $productImage->image);
        }

        // Delete Image
        ProductImage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product Alternate Image has been deleted successfully!');
    }

    // PRODUCTS
    public function products($url){
        //get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoriesDetails = Category::where(['url'=>$url])->first();

        if($categoriesDetails->parent_id==0){
            //if url is main category url
            $subCategories = Category::where(['parent_id'=>$categoriesDetails->id])->get();
            //$cat_ids = "";
            foreach ($subCategories as $subCat){
                $cat_ids[] = $subCat->id; //$cat_ids .= $subCat->id.",";
            }
            $productsAll = Product::whereIn('category_id',$cat_ids)->get();  //array($cat_ids)
            $productsAll = json_decode(json_encode($productsAll));


        }else{
            $productsAll = Product::where(['category_id'=>$categoriesDetails->id])->get();
        }

        $productsAll = Product::where(['category_id' => $categoriesDetails->id])->get();

        return view('products.listing')->with(compact('categories','categoriesDetails','productsAll'));


    }

    public function product($id){
        // 404 Page is product is disabled
        $productsCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount == 0){
            abort(404);
        }


        //Get Product Details
        $productDetails = Product::with('attributes')->where('id',$id)->first();
        $productDetails = json_decode(json_encode($productDetails));


        // Related Products
        $relatedProducts = Product::where('id','!=', $id)->where(['category_id'=>$productDetails->category_id])->get();


        // Get All Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        // Get Product Alternate Images
        $productAltImages = ProductImage::where('product_id',$id)->get();

        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        //abc
        return view('products.detail')->with(compact('productDetails','categories','total_stock','productAltImages','relatedProducts'));

    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;

    }


    // CART

    public function addtocart(Request $request){
        $data = $request->all();

//        if(empty($data['user_email'])){
//            $data['user_email'] = '';
//        }

        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = session()->get('session_id');
        if(empty($session_id)){
            $session_id = rand();
            session()->put('session_id',$session_id);
        }


        $sideArr = explode("-",$data['size']);

        $countProducts = DB::table('cart')->where([
            'product_id'=>$data['product_id'],
            'product_color'=>$data['product_color'],
            'size'=>$sideArr[1],
            'session_id'=>$session_id
        ])->count();

        if($countProducts>0){
             return redirect()->back()->with('flash_message_error','Item already exists in your cart!');
        }else{
              $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sideArr[1]])->first();

            DB::table('cart')->insert([
                'product_id'=>$data['product_id'],
                'product_name'=>$data['product_name'],
                'product_code'=>$getSKU->sku,
                'product_color'=>$data['product_color'],
                'size'=>$sideArr[1],
                'price'=>$data['price'],
                'quantity'=>$data['quantity'],
                'user_email'=>$data['user_email'],
                'session_id'=>$session_id
            ]);}

        return redirect('cart')->with('flash_message_success','Product has been added in your Cart!');
    }

    public function cart(){
//        $session_id = session()->get('session_id');

        if(Auth::check()){
            $user_email = Auth::user()['email'];
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else{
            $session_id = session()->get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }

//       $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view ('products.cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id){
        DB::table('cart')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Product has been deleted from your cart successfully!');
    }

    public function updateCartQuantity($id,$quantity){

        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
        $getAttributeStock->stock ;
        $updated_quantity = $getCartDetails->quantity+$quantity ;
        if($getAttributeStock->stock >= $updated_quantity) {
            DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
            return redirect('cart')->with('flash_message_success', 'Product Quantity has been updated successfully!');
        }else{
            return redirect('cart')->with('flash_message_error', "Required Product Quantity isn't available!");
        }

    }

    // CHECKOUT

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        $shippingDetails=array();
        //check if shipping address exist
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        $session_id = session()->get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['billing_name']) ||
                empty($data['billing_address']) ||
                empty($data['billing_zipcode']) ||
                empty($data['billing_country']) ||
                empty($data['billing_phone']) ||
                empty($data['billing_city']) ||
                empty($data['shipping_name']) ||
                empty($data['shipping_address']) ||
                empty($data['shipping_zipcode']) ||
                empty($data['shipping_country']) ||
                empty($data['shipping_phone']) ||
                empty($data['shipping_city'])){

                return redirect()->back()->with('flash_message_error','Please fill all fields to Checkout!');
            }
            User::where('id', $user_id)->update([
                'name'=>$data['billing_name'],
                'address'=>$data['billing_address'],
                'zipcode'=>$data['billing_zipcode'],
                'country'=>$data['billing_country'],
                'city'=>$data['billing_city'],
                'phone'=>$data['billing_phone']]);

            if($shippingCount>0){
                DeliveryAddress::where('user_id',$user_id)->update([
                    'name'=>$data['shipping_name'],
                    'address'=>$data['shipping_address'],
                    'zipcode'=>$data['shipping_zipcode'],
                    'country'=>$data['shipping_country'],
                    'city'=>$data['shipping_city'],
                    'phone'=>$data['shipping_phone']]);
            }else{
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->city = $data['shipping_city'];
                $shipping->address = $data['shipping_address'];
                $shipping->zipcode = $data['shipping_zipcode'];
                $shipping->country = $data['shipping_country'];
                $shipping->phone = $data['shipping_phone'];
                $shipping->save();
            }
            return redirect()->action('ProductsController@orderReview');
        }

        return view ('products.checkout',compact('userDetails','countries','shippingDetails'));
    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        // TENTAR PASSAR DEPOIS O VALOR PARA A PAGINA DO OVERVIEW. AINDA N TA A PASSAR O SIZE E SERIA INTERESSANTE       $productcode = Product::where('');

        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }

//        $size = DB::table('products')->where(['productcode'=>])

        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first();

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->zipcode = $shippingDetails->zipcode;
            $order->country = $shippingDetails->country;
            $order->phone = $shippingDetails->phone;
            $order->status = "New";
            $order->payment = $data['payment'];
            $order->payment_method = $data['payment_method'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_size = $pro->size;
                $cartPro->product_price = $pro->price;
                $cartPro->product_quantity = $pro->quantity;
                $cartPro->save();
            }

            Session::put('order_id',$order_id);
            Session::put('payment',$data['payment']);

            if($data['payment_method'] =="COD"){
                return redirect('/thanks');
            }else{
                return redirect('/paypal');
            }



        }

    }

    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.thanks');
    }
    public function paypal(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.paypal');
    }



    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('orders.user_orders')->with(compact('orders'));
    }
    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }
    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        $orders = json_decode(json_encode($orders));
        return view('admin.orders.view_orders')->with(compact('orders'));
    }
    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));

        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();


        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }


    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['status'=>$data['status']]);
            return redirect()->back()->with('flash_message_success','Order Status has been updated successfully!');
        }
    }

}
