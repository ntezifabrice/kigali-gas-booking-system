<ul id="responsive-menu">

    @php

    if (Voyager::translatable($items)) {
    $items = $items->load('translations');
    }

    @endphp

    @foreach ($items as $item)

    @php

    $originalItem = $item;
    if (Voyager::translatable($item)) {
    $item = $item->translate($options->locale);
    }

    $isActive = null;
    $styles = null;
    $icon = null;

    // Background Color or Color
    if (isset($options->color) && $options->color == true) {
    $styles = 'color:'.$item->color;
    }
    if (isset($options->background) && $options->background == true) {
    $styles = 'background-color:'.$item->color;
    }

    // Check if link is current
    if((url($item->link()) == url()->current()) || strpos(request()->url(), 'booking') ){
    $isActive = 'active';
    }

    // Set Icon
    if(isset($item->icon_class)){
    $icon = '<i class="' . $item->icon_class . '"> '.$item->title.'</i>';
    }else{
    $icon = '<i class="sl sl-icon-settings"> '.$item->title.'</i>';
    }

    @endphp

    <li class="{{ $isActive }}">
        <a href="{{ url($item->link()) }}">{!! $icon !!}</a>
        @if(!$originalItem->children->isEmpty())
        <ul>
            @foreach($originalItem->children as $item_child)
            <li><a href="{{ url($item_child->link()) }}">{{ $item_child->title }} @if(strrpos($item_child->link(), '?status=')) <span class="nav-tag {!! strrpos($item_child->link(), '=pending')?'yellow">'.auth()->user()->transactions->where('status','Pending')->count():(strrpos($item_child->link(), '=finished')?'grey">'.auth()->user()->transactions->where('status','Finished')->count():(strrpos($item_child->link(), '=active')?'green">'.auth()->user()->transactions->where('status','Active')->count():'red">'.auth()->user()->transactions->where('status','Cancelled')->count())) !!}</span> @endif</a></li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
    <li><a id="logoutModal"><i class="sl sl-icon-power"></i> Logout</a></li>

</ul>
