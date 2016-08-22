@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/cart.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>
<script type="text/javascript" src="{{ Asset('jquery.numeric.js') }}"></script>
<script type="text/javascript" src="{{ Asset('underscore.js') }}"></script>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="large-container">
        <div id="inner-wrapper-cart">

        </div>
    </section>
</div>

<script type="text/javascript">
  var ROUTE_GET_CART = '{{ route("ajax_getCart") }}';
  var LINK_ASSET_RESOURCE_BOOK = '{{ Asset("resourcebook") }}';
  var ROUTE_CHECKOUT = '{{ route("checkout") }}';
  var ROUTE_UPDATE_CART = '{{ route("updateCart") }}';
  var TOKEN = '{{ csrf_token() }}';
</script>

<script type="text/jsx" src="{{ Asset('js/cart.jsx') }}"></script>
@stop
