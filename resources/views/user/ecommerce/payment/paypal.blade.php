<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AZdXuUZJVs-doHIrSaCCnq0gBpeA4skuGsBFR_CPcOw8ownmuv08z-vRWnUQ5J42eoHs8-jBp6hd4EFo"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '50.00'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    alert('Payment completed. ' + details.payer.name.given_name + ', your transaction id is: ' + details.id);
                });
            }
        }).render('#paypal-button-container');
    </script>
</head>
<body>
    <div id="paypal-button-container"></div>
</body>
</html>