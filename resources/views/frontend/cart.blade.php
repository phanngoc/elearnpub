@extends ('frontend.master')

@section ('head.title')
    E learn pub
@stop

@section ('body.content')

<link href="{!!Asset('lesscss/css/cart.css')!!}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ Asset('react/react.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/react-with-addons.js') }}"></script>
<script type="text/javascript" src="{{ Asset('react/JSXTransformer.js') }}"></script>

<div class="content-wrapper">

    <!-- Main content -->
    <section class="large-container">
        <div id="inner-wrapper-cart">
            
        </div>
    </section>
</div>
<script type="text/jsx">
    var NavigateCart = React.createClass({
      getInitialState : function(){
        return {}
      },
      render : function(){
        return (
          <div className="navigate-cart">
            <div className="inner-navigate">
                <ul>
                 <li>Edit Cart</li>
                 <li>Checkout</li>
                 <li>Download</li>
                </ul>  
            </div>
          </div> 
        );
      },
    });

    var ShoppingCart = React.createClass({
      getInitialState : function(){
        return { items : [] }
      },
      componentDidMount: function() {
        $.get('{{ route("ajax_getCart") }}', function(result) {
          var resultJson = jQuery.parseJSON(result);
          console.log(result);
          if (this.isMounted()) {
            this.setState({
              items: resultJson,
            });
          }
        }.bind(this));
      },
      fireModal : function(e)
      {
        
      },
      render : function(){
        return (
          <div className="area-cart">
            <header><p>Your shopping cart will be saved if you navigate away from this page , so feel free to buy more book </p></header>
            <div className="content-area-cart">
              <table className="table">
                <thead>
                    <tr>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Total</th>
                      <th>Edit</th>
                      <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                  {
                     this.state.items.map(function (item) {
                        return (
                          <tr>
                            <td>{item.title}</td>
                            <td>{item.meta['quantity']}</td>
                            <td>{item.meta['amount']}</td>
                            <td>{item.meta['quantity']*item.meta['amount']}</td>
                            <td><a href="#" onClick={this.fireModal}><i className="fa fa-pencil-square-o"></i></a></td>
                            <td><a href="#"><i className="fa fa-times"></i></a></td>
                          </tr>
                        );
                     })
                  }
                </tbody>
              </table>  
            </div>
            <button className="btn btn-primary continue">Continue</button>
          </div> 
        );
      },
    });

    var WrapperCart = React.createClass({
      getInitialState : function(){
        return {}
      },
      render : function(){
        return (
          <div className="wrapper-cart">
            <NavigateCart />
            <ShoppingCart />
          </div> 
        );
      },
    });
     React.render(<WrapperCart /> , document.getElementById('inner-wrapper-cart'));
</script
@stop