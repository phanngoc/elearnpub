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
    var RowTable = React.createClass({
      render : function(){
        return (
          <tr>
            <td>{this.props.item.title}</td>
            <td>{this.props.item.meta['quantity']}</td>
            <td>{this.props.item.meta['amount']}</td>
            <td>{this.props.item.meta['quantity']*this.props.item.meta['amount']}</td>
            <td><a href="#" onClick={this.props.handleClick.bind(this,this.props.item)} ><i className="fa fa-pencil-square-o"></i></a></td>
            <td><a href="#" onClick={this.props.handleDelete.bind(this,this.props.item)}><i className="fa fa-times"></i></a></td>
          </tr>
        );  
      },
    });
    var ShoppingCart = React.createClass({
      getInitialState : function(){
        return { items : [] , isOpen : false , item : {title:'',teaser:'',avatar : '',meta : {quantity:1},price : {minimumprice:0,suggestedprice:0}}};
      },
      componentDidMount: function() {
        $.get('{{ route("ajax_getCart") }}', function(result) {
          var resultJson = jQuery.parseJSON(result);
          console.log(resultJson);
          if (this.isMounted()) {
            this.setState({
              items: resultJson,
            });
          }
        }.bind(this));
      },
      handleClick : function(item)
      {
        console.log(item);
        this.setState({item:item,isOpen : true});
      },
      handleDelete : function(item)
      {
        if(confirm("Are you delete ?"))
        {
          var newItems = _.filter(this.state.items, function(it){ return it.id != item.id; });
          console.log(newItems);
          this.setState({items : newItems,isOpen : false});
        }
      },
      update : function(item)
      {
        console.log('update toi noi can');
        var newItems = this.state.items;
        $.each(newItems,function(key,value){
          if(value.id == item.id)
          {
            newItems[key] = item;
          }
        });
        this.setState({ items : newItems,isOpen : false});
      },
      render : function(){
        var itemNotExist = (<p></p>);
        if (this.state.items.length == 0)
        {
            console.log("ok ne");
            itemNotExist = (<p>You don't have item in cart</p>)
        }

        return (
          
          <div className="area-cart">
            <ModalEdit isOpen={this.state.isOpen} itemClick={this.state.item} update={this.update}/>
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
                  { itemNotExist }
                  {
                       this.state.items.map(function (item) {
                          return (
                            <RowTable item={item} handleClick={this.handleClick} handleDelete={this.handleDelete}/>
                          );
                       },this) 
                  }
                </tbody>
              </table>  
            </div>
            <button className="btn btn-primary continue">Continue</button>
          </div> 
        );
      },
    });
    
    var ContentModal = React.createClass({
      getInitialState : function()
      {
        return {item : this.props.item};
      },
      componentDidMount: function() {
        $("#amount-you-pay").numeric('.',{negative : false,decimalPlaces : 1});
        $("#amount-author-earn").numeric('.',{negative : false,decimalPlaces : 1});
        $("#quantity").numeric(false);
      },
      // componentWillMount : function(){
      //    // this.setState({item : this.props.item});
      // },
      componentWillReceiveProps : function(nextProps){
         this.setState({item : nextProps.item});
      },
      shouldComponentUpdate: function(nextProps, nextState) {
        console.log(nextProps);
        return true;
      },
      handleChangeMinimum : function(e){
         var newitem = this.state.item;
         newitem.meta.amount = e.target.value;
         this.setState({item : newitem});
      },
      handleChangeMaximum : function(e)
      {
         var newitem = this.state.item;
         newitem.meta.amount = (e.target.value) * 100 / 90;
         this.setState({item : newitem});
      },
      handleChangeQuantity : function(e)
      {
         var newitem = this.state.item;
         newitem.meta.quantity = e.target.value;
         this.setState({item : newitem});
      },
      render : function(){
        
        return (
          <div className="wrapper-content">
            <div className="row">
              <div className="col-md-3">
                 <img src={'{{ Asset("resourcebook") }}/'+this.state.item.avatar}/>
              </div>
              <div className="col-md-9">
                 <h3>{ this.state.item.title }</h3>
                 <p>{ this.state.item.teaser }</p>
              </div>
            </div>
            <div className="row">
              <div className="inner-price">
                <div className="header-price">
                  <div className="quantity"><span>Copies</span><input type="text" className="form-control" onChange={this.handleChangeQuantity} placeholder="00" value={this.state.item.meta.quantity} id="quantity"/></div> 
                  <span className="minimumprice">$ { this.state.item.price.minimumprice } MINIMUM</span>
                  <span className="suggestedprice">$ { this.state.item.price.suggestedprice } SUGGESTED</span>
                </div>
                <div className="pick-price">
                  <div className="row">
                    <div className="col-md-4">
                        <div className="wrap-label"><span>You pay</span></div>
                    </div>
                    <div className="col-md-8">
                        <div className="input-group">
                          <span className="input-group-addon">$</span>
                          <input type="text" className="form-control" onChange={this.handleChangeMinimum} placeholder="00" value={ this.state.item.meta.amount } id="amount-you-pay" name="amountYouPay"/>
                        </div>
                    </div>
                  </div>
                  
                  <div className="row">
                    <div className="col-md-4">
                        <div className="wrap-label"><span>Author earn</span></div>
                    </div>
                    <div className="col-md-8">
                        <div className="input-group">
                            <span className="input-group-addon">$</span>
                            <input type="text" className="form-control" onChange={this.handleChangeMaximum} placeholder="00" value={ this.state.item.meta.amount * 90/100 } id="amount-author-earn" name="amountAuthorEarn"/>
                        </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>

            <div className="modal-footer">
                <button type="button" className="update pull-right btn btn-default" onClick={this.props.update.bind(this,this.state.item,false)} data-dismiss="modal">Update</button>
            </div>
          </div>
        );
      },
    });

    var ModalEdit = React.createClass({
      getInitialState : function()
      {
        return {};
      },
      componentWillReceiveProps : function(nextProps)
      {
        console.log(nextProps);
        if(nextProps.isOpen == true)
        {
          $('#myModal').modal('show');
        }
        else
        {
          $('#myModal').modal('hide');
        }
      },
      render : function(){
        return (
          
            <div id="myModal" className="modal fade" role="dialog">
              <div className="modal-dialog">
 
                <div className="modal-content">
                  <div className="modal-header">
                    <button type="button" className="close" data-dismiss="modal">&times;</button>
                    <h4 className="modal-title">Edit Purchase</h4>
                  </div>
                  <div className="modal-body">
                      <ContentModal item={this.props.itemClick} update={this.props.update}/>
                  </div>
                  <div className="modal-footer">
                    <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
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