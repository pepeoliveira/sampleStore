<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Mail;


class CmsController extends Controller
{
    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
//            $validator = Validator::make($request->all(), [
//                'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
//                'email' => 'required|email',
//                'subject' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return redirect()->back()->withErrors($validator)->withInput();
//            }
//            // Send Contact Email
//            $email = "admin@sportseshopper.com";
//            $messageData = [
//                'name'=>$data['name'],
//                'email'=>$data['email'],
//                'subject'=>$data['subject'],
//                'comment'=>$data['message']
//            ];
//            Mail::send('emails.enquiry',$messageData,function($message)use($email){
//                $message->to($email)->subject('Enquiry from SPORTS E-SHOPPER');
//            });
            return redirect()->back()->with('flash_message_success','Thanks for your enquiry. We will get back to you soon.');
        }
        // Get All Categories and Sub Categories
        $categories_menu = "";
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $categories = json_decode(json_encode($categories));
        /*echo "<pre>"; print_r($categories); die;*/
        foreach($categories as $cat){
            $categories_menu .= "
            <div class='panel-heading'>
                <h4 class='panel-title'>
                    <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
                        <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                        ".$cat->name."
                    </a>
                </h4>
            </div>
            <div id='".$cat->id."' class='panel-collapse collapse'>
                <div class='panel-body'>
                    <ul>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_menu .= "<li><a href='#'>".$sub_cat->name." </a></li>";
            }
            $categories_menu .= "</ul>
                </div>
            </div>
            ";
        }
        $meta_title = "Contact Us - SPORTS E-SHOPPER Portugal";
        $meta_description = "Contact us for any queries related to our products.";
        $meta_keywords = "contact us, queries";
        return view('pages.contact')->with(compact('categories_menu','categories','meta_title','meta_description','meta_keywords'));
    }
}
