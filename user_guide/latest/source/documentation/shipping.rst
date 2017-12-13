Shipping
--------

There are a number of methods for specifying shipping. For starters,
there are 3 variables you can set for calculating shipping:
**shippingFlatRate**, **shippingQuantityRate**, and
**shippingTotalRate**. You can also set a **shippingCustom** function.
*These 4 methods will be added up to create the total shipping cost*

To set a basic flat rate shipping, you can use **shippingFlatRate**.

.. code-block:: javascript

    simpleCart({
        shippingFlatRate: 10
    });

Remember, you can set this variable at any time. (It may be useful to
change it when a user sets their shipping state or country)

For a shipping rate based on the total quantity of the cart
(i.e. shipping quantity rate of $3 = $21 for 7 items), use
**shippingQuantityRate**:

::

    simpleCart({
        shippingQuantityRate: 3
    });

If you want a shipping rate that is a percentage of the total cost of
the cart, use **shippingTotalRate**:

::

    simpleCart({
        shippingTotalRate: 0.1
    });

You can also add a custom function that returns a shipping cost based on
arbitrary criteria. Let’s say you wanted to have the cost of shipping be
$10, unless there are more than 20 items in the cart:

::

    simpleCart({
        shippingCustom: function(){
             if( simpleCart.quantity() > 20 ){
                  return 0;
             } else {
                  return 10;
             }
        }
    });

You can also set this custom shipping function using a shortcut in the
.shipping() function:

::

    simpleCart.shipping(function(){
        if( simpleCart.quantity() > 20 ){
             return 0;
         } else {
             return 10;
         }
    });

If you want to calculate shipping based on the individual items, you can
modify the simpleCart.Item object to have items calculate their own
shipping.  Let’s say you wanted to have the shipping for each item be 2
if the item’s size is “small”, and 5 if the size is anything else:

::

    simpleCart.Item._.shipping = function(){
         if( this.get( 'size' ) == "small" ){
             return this.quantity()*2;
         } else {
             return this.quantity()*5;
         }
    };

Of course, you could achieve the same effect by creating a custom
shipping method for simpleCart that iterates through all the items:

::

    simpleCart.shipping(function(){
      var total = 0;
      simpleCart.each( function( item ){
        if( item.get('size') == 'small' )[
          total+= item.quantity()*2;
        } else {
          total+= item.quantity()*5;
        }
      });
      return total;
    });

If you want to see what the total shipping is at any time, you can call
the .shipping() method and the total from all of the aforementioned
methods will be returned:

::

    simpleCart.shipping(); // returns current shipping cost