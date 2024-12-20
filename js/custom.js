




// //slick.min.js

$(function () {

  if ($(".slider").length > 0) {

    var slider = tns({
      container: '.slider',
      items: 1,
      slideBy: 1,
      autoplay: false,
      mode: "gallery",
      controls: false,
    });





  }


  $(".add-to-cart.clickable").click(function () {

    $(this).html("adding..").removeClass('clickable')

    var ele = $(this)
    var data = {
      action: 'my_action',
      security: MyAjax.security,
      prod_id: $(this).attr('rel')
    };

    $.post(MyAjax.ajaxurl, data, function (response) {
      if (parseInt(response) > 0) {
        $("#donor-cart-count").html(parseInt(response))
        $("#donor-cart").removeClass('d-none')
        //  console.log($(this).attr('class'));

        // $(this).html("loading..")
        ele.html("Added").addClass('disabled')

      }

    });

  })


  $(".remove-from-cart").click(function () {
    $(this).html("deleting..")

    var ele = $(this)
    var data = {
      action: 'my_action',
      security: MyAjax.security,
      prod_id: $(this).attr('rel'),
      remove_from_cart: 1
    };

    $.post(MyAjax.ajaxurl, data, function (response) {

      window.location.reload()


      // if (parseInt(response) > 0) {

      //   $("#donor-cart-count").html(parseInt(response))
      //   ele.parent().parent().remove()

      // }else {

      //   $("#donor-actions").html('Your cart is empty')
      //   ele.parent().parent().remove()


      // }

    });

  })
})


if ($("#payment-form").length > 0) {


  // Create a Stripe client.
  var stripe = Stripe('pk_test_pxw09qDlIY86UKf6Pc1JdixJ');

  // Create an instance of Elements.
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  // Create an instance of the card Element.
  var card = elements.create('card', { style: style });

  // Add an instance of the card Element into the `card-element` <div>.
  card.mount('#card-element');

  // Handle real-time validation errors from the card Element.
  card.addEventListener('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  // Handle form submission.
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function (event) {
    event.preventDefault();

    stripe.createToken(card).then(function (result) {
      if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
      }
    });
  });

  // Submit the form with the token ID.
  function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
  }




}


