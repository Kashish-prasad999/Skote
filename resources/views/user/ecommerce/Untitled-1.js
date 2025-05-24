//  $('.quantity-plus').on('click', function() {
    //            let $base=$(this);
    //            $.ajax({
    //              url: '{{route('cart.updateQuantity','+')}}'+ '/' +$base.data('id'),
    //              type: 'GET',
    //              success: function(res) {
    //                console.log(res);
    //                window.location.reload();
    //              },
    //              error: function () { alert("Error!");}
    //            })
    //          });
    //          $('.quantity-minus').on('click', function() {
    //            let $base=$(this);
    //            $.ajax({
    //              url: '{{route('cart.updateQuantity','-')}}'+ '/' +$base.data('id'),
    //              type: 'GET',
    //              data:{
    //                '_token': $('input[name=_token]').val()
    //              },
    //              success: function(res){
    //                console.log(res);
    //                window.location.reload();
    //              },
    //              error: function () { alert("Error!");}
    //            })
    //          });


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

     // $("#amount").text(usd.toFixed(2));
    // $("#currency").text("USD");

    //     $('#proceed').on('click', function() {
    //         var cardType = $('input[name=card]:checked').val(),
    //             nameOnCard = $.trim($('#nameOnCard').val()),
    //             cardNumber = $.trim($("#cardNumber").val()),
    //             expMonth = $.trim($("#expMonth").val()),
    //             expYear = $.trim($("#expYear").val()),
    //             cvv = $.trim($("#cvv").val());

    //         if (cardType == 'master') {
    //             var regexMaster = /^(?:5[1-5][0-9]{14}|677189|2221[0-9]{12}|22[3-9][0-9]{13}|2[3-6][0-9]{14}|27[01][0-9]{1
    //             var regex = new RegExp("^(?:4[0-9]{12}(?:[0-9]{3})?)$");
    //         } else if (cardType == 'visa') {
    //             var regex = new RegExp("^4[0-9]{6}? [0-9]{5}$");
    //         }

    //         if (!regex.test(cardNumber)) {
    //             alert('Please enter a valid credit/debit card number');
    //             return false;
    //         }

    //         if ((expMonth < 1 || expMonth > 12) || !$.isNumeric(expMonth)) {
    //             alert('Invalid Expiry Month');
    //             return false;
    //         }

    //         if (parseInt(expYear) < parseInt(new Date().getFullYear()) ||
    //             (parseInt(expYear) === parseInt(new Date().getFullYear()) && parseInt(expMonth) <= parseInt(new Date().getMonth()))) {
    //                 alert();
    //                 return false;
    //         }

    //         if (cvv.length != 3 && cvv.length != 4) {
    //             alert('CVV must be 3 or 4 digits');
    //             return false;
    //         }

    //         // Proceed with payment...
    //         Stripe.setPublishableKey($("#stripe_public_key").val());
    //         Stripe.createToken({
    //           "number": cardNumber,
    //           "cvc": cvv,
    //           "exp_month": expMonth,
    //           "exp_year": expYear
    //         }, stripeResponseHandler);
    //     });
    // });

    //////////////////////////////////////////////////////////////////////////////

    
                // updateProductsByPrice(data.from, data.to,search);
                // window.location.href = "{{route('buy.payment.method',[$total, $productId,'transaction_id' => details.id])}";

                // fetch("{{route('buy.payment.method',[$total, $productId,'transaction_id' => ' '])}" + details.id, {
                //         method: 'GET',
                //         headers: {
                //             'Content-Type': 'application/json',
                //         },
                //     })   
                //     .then(response => response.json())
                //     .then(data => {
                //         console.log('Success:', data);
                //         // handle the response data here
                //     })
                //     .catch((error) => {
                //         console.error('Error:', error);
                //     });
                // window.location = "{{route('buy.payment.method',[$total, $productId,'transaction_id' => details.id])}"

                ///////////////////////////////////////////////////////////////////////////////////
                  // window.location.href = "{{route('ord')}}";

                  // window.location.replace('{{route("order",[$total, $req, $productId, 0])}}');

                  ////////////////////////////////////////////////////////////////////////
                  var total = "{{$total}}";
                  var product = "{{$productId}}";
                  var req = "Netbanking";
                  var transaction = null;
                  var usd = (total / 83.25).toFixed(2);
                  console.log("usd", usd);
                  console.log(product);
                  console.log(req);
              
              
                  paypal.Buttons({
                      createOrder: function(data, actions) {
                          return actions.order.create({
                              purchase_units: [{
                                  amount: {
                                      value: usd
                                  }
                              }]
                          });
                      },
                      onApprove: function(data, actions) {
                          return actions.order.capture().then(function(details) {
                              alert('Payment completed. ' + details.payer.name.given_name + ', your transaction id is: ' + details.id);
                              transaction = details.id;
              
                              Transaction(total, product, req, transaction);
              
                              
                          });
                      }
                  }).render('#paypal-button-container');
              
                  function Transaction(total, product, req, transaction) {
                      $.ajax({
                          type: "GET",
                          url: "{{route('order')}}",
                          data: {
                              total: total,
                              product: product,
                              req: req,
                              transaction: transaction,
                          },
                          dataType: 'json',
                          success: function(response) {
                              console.log(response);
                              // $("#product-list").html(response);
                            
              
                          },
                      });
                  }
                  ////////////////////////////////////////////////
                  function displayOrder(order) {
                    var orderData = {
                        order: order
                    };
                    var orderView = view('user.ecommerce.order', orderData);
                    var orderDiv = document.getElementById("order-details");
                    orderDiv.innerHTML = orderView;
                }
                //////////////////////////////
                 // function Transaction(total, product, req, transaction) {
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('order')}}",
    //         data: {
    //             total: total,
    //             product: product,
    //             req: req,
    //             transaction: transaction,
    //         },
    //         dataType: 'hmtl',
    //         success: function(response) {
    //             var order = response.order;
    //             console.log(response);
    //             // console.log(response.order);
    //             console.log(order);
    //             // displayOrder(order);
    //             // document.write(response);
    //             window.location.replace('user.ecommerce.order.blade.php', order);
    //             // window.location.reload('user.ecommerce.order.blade.php', order);
    //             // $("#product-list").html(response); 
    //         },
    //     });
    // }
    ////////////////////////////////////////////////////////////////////////////
    $('#card-payment-form').on('submit', function(e) {
        e.preventDefault();

        // Disable the submit button to prevent multiple submissions
        $('.pay').prop('disabled', true);

        // Send an AJAX request to the server to validate the form data
        $.ajax({
            url: "{{ route('payment.method', [$total, 0]) }}",
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    // If the form data is valid, submit the form
                    $('#card-payment-form').submit();
                } else {
                    // If the form data is invalid, show error messages
                    $('.pay_card .form-group').each(function() {
                        if ($(this).hasClass('was-validated')) {
                            $(this).removeClass('was-validated');
                        }

                        if ($(this).find('input').val() === '') {
                            $(this).addClass('was-validated');
                            $(this).find('input').after('<div class="invalid-feedback">This field is required.</div>');
                        }
                    });

                    // Enable the submit button
                    $('.pay').prop('disabled', false);
                }
            },
            error: function() {
                // If there was an error with the AJAX request, show an error message
                alert('An error occurred. Please try again later.');

                // Enable the submit button
                $('.pay').prop('disabled', false);
            }
        });
    });

    ////////////////////////////////////////////////////////////////////////////////////
     // });
// function cardPayment(){
//     $.ajax({
//         url:'/orderplace',
//         method:"POST",
//         data:{
//             "product":product, 
//             "_token":"{{ csrf_token() }}",
//             "transaction":transaction,
//             "total": total,
//             "address":$('#address').val(),
//             "method":'card',
//         },
//         success:function(data){
//             console.log(data);
//             stripe = Stripe($("#stripe-key").val());    
//             var style = {"base": {"color": "#32325d","lineHeight": "48px"}};  
//             var fontFamily = {'fontFamily':'Arial'};
//             var element = document.getElementById('card-element');
//             var card = elements.create('card', {style: style});
//             card.mount(element);
//             card.focusOut((status, response)=>{
//                 if (response.error) {   
//                     $("#card-errors").text(response.error.message).css("color","red");
//                 } else{
//                     $("#card-errors").text("");
//                 }
//             });
//             // Handle form submission.
//             var form = document.getElementById('payment-form');
//             form.addEventListener('submit', function(event) {
//                 event.preventDefault();
//                 $("#payBtn").attr("disabled",true);
//                 var options={
//                     name:$("#nameOnCard").val(),
//                     address_zip:$("#postalCode").val()
//                 };
//             )};