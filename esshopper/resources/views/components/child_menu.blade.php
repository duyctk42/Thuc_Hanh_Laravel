@if( $categoryParent ->categoryChildrent->count())
    <ul role="menu" class="sub-menu">
        @foreach($categoryParent ->categoryChildrent as $categorychild)
            <li>
                <a href="shop.html">{{$categorychild->name}}</a>
                @if($categorychild ->categoryChildrent->count())
                    @include('components.child_menu',['categoryParent'=>$categorychild])
                @endif
            </li>
        @endforeach
    </ul>
@endif
