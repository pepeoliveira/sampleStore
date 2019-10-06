<div class="left-sidebar">
    <h2>Our Collection</h2>
    <div class="panel-group category-products" id="accordian"><!--category-products-->
        <div class="panel panel-default">
            @foreach($categories as $category)
                @if($category->status=="1")
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian"
                               href="#{{$category->id}}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{$category->name}}
                            </a>
                        </h4>
                    </div>
                    <div id="{{$category->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categories as $subcategory)
                                    @if($subcategory->status=="1")
                                        <li>
                                            <a href="{{ url('/products/'.$subcategory->url)}}">{{$subcategory->name}} </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div><!--/category-products-->


    <div class="price-range"><!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                   data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br/>
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div><!--/price-range-->


</div>
