<ul class="nav navbar-nav" id="responsive-menu">

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
            if(url($item->link()) == url()->current()){
                $isActive = 'active';
            }

            // Set Icon
            if(isset($options->icon) && $options->icon == true){
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        @endphp

    <li class="{{ $isActive }}">
        <a href="{{ url($item->link()) }}">{{ $item->title }}</a>
        @if(!$originalItem->children->isEmpty())
            <ul>
                @foreach($originalItem->children as $item_child)
                    <li><a href="{{ url($item_child->link()) }}">{{ $item_child->title }}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
    @endforeach

</ul>
