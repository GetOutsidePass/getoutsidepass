@extends('_layouts.body')

@section('meta-page')
  <title>Get Outside Pass - National Parks Discount Cards</title>
  <meta name="description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation." />
  <meta name="keywords" content="national parks, travel, discounts, coupons, attractions, activities, things to do, Get Outside Pass">
@stop

@section('meta-og')
  <meta property="og:type" content="article"/>
  <meta property="og:title" content="Get Outside Pass - National Parks Discount Cards"/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="{{ url('/img/destinations/yellowstone-1200x630.jpg') }}"/>
  <meta property="og:site_name" content="Get Outside Pass"/>
  <meta property="og:description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation."/>
  <meta property="og:locale" content="en_US"/>
@stop

@section('content')

{{-- Start Payment Form --}}
{!! Form::open(['action' => 'CheckoutController@paymentStore','method' => 'POST', 'id' => 'checkoutPayment', 'class' => 'interactive-credit-card']) !!}
{!! Form::hidden('pass_id', $pass->id) !!}
{!! Form::hidden('qty', 1) !!}
{!! Form::hidden('total', 0, ['id' => 'totalAmount']) !!}
{!! Form::hidden('price', $pass->price-Request::get('discount'), ['id' => 'price']) !!}

{{-- Page Content --}}
<div class="container padding-bottom-3x">
  <div class="row mt-5">
    
      {{-- Left Column - Payment Info --}}
      <div class="col-lg-8">
        <div class="card mt-3">
          <div class="card-header" role="tab">
            <h6>
              <i class="fa fa-cc-visa"></i>
              <i class="fa fa-cc-mastercard"></i>
              <i class="fa fa-cc-amex"></i>
              <i class="fa fa-cc-discover"></i>
              <i class="fa fa-cc-diners-club"></i>
            </h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                @if (\Session::has('error'))
                  <div class="alert alert-danger mb-3">
                    <h3>{!! \Session::get('error') !!}</h3>
                    <h5>Please check your card details and try again.</h5>
                  </div>
                @else
                  <h3 class="text-bold">Your pass will be available immediately.</h3>   
                @endif
              </div>      
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Name on Card <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('name', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'Full Name']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                    {!! Form::label('zipcode', 'Zip Code <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('zipcode', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'Zip Code']) !!}
                    <small class="text-danger">{{ $errors->first('zipcode') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('email', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'you@email.com']) !!}
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    {!! Form::label('phone', 'Phone <small class="gray">optional</small>', [], false) !!}
                    {!! Form::text('phone', null, ['class' => 'form-control form-control-rounded', 'placeholder' => '(000) 000-0000']) !!}
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                </div>
              </div>
              <div class="col-sm-12 card-info">
                <div class="card-wrapper"></div>
              </div>
              <div class="col-md-6 card-info">
                <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                    {!! Form::label('number', 'Card Number <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('number', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'Card Number', 'required']) !!}
                    <small class="text-danger">{{ $errors->first('number') }}</small>
                </div>
              </div>
              <div class="col-md-3 card-info">
                <div class="form-group{{ $errors->has('expiry') ? ' has-error' : '' }}">
                    {!! Form::label('expiry', 'Expiration <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('expiry', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'MM/YY', 'required']) !!}
                    <small class="text-danger">{{ $errors->first('expiry') }}</small>
                </div>
              </div>
              <div class="col-md-3 card-info">
                <div class="form-group{{ $errors->has('cvc') ? ' has-error' : '' }}">
                    {!! Form::label('cvc', 'CVC <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('cvc', null, ['class' => 'form-control form-control-rounded', 'placeholder' => 'CVC', 'required']) !!}
                    <small class="text-danger">{{ $errors->first('cvc') }}</small>
                </div>
              </div>
              {{-- Message if Local Free Purchase --}}
              <div class="col-sm-12" id="card-info"></div>
            </div>
          </div>
        </div>
    </div>

    {{-- Right Column - Order Summary --}}
    <div class="col-sm-12 col-lg-4">
      <aside class="sidebar sticky mt-3">
        <div class="padding-top-2x hidden-lg-up"></div>
        <section class="widget widget-order-summary">
          <h3 class="widget-title">Order Summary</h3>
          <table class="table">
            <tr class="passid-{{ $pass->id }}">
              <td>
                <h6 class="mb-0">{{ $pass->name }} Pass</h6>
                <p class="mt-0 mb-0">{{ $pass->start->format('M d, Y') }} - {{ $pass->end->format('M d, Y') }}</p>
                <p class="mt-0 mb-0">{{ count($pass->discounts) }} Total Discounts</p>
                <p class="mt-0">Good for up to 5 people.</p>
              </td>
              <td class="text-medium">$<span class="passFee">{{ number_format(($pass->price-Request::get('discount'))/100, 2, '.', ',') }}</span></td>
            </tr>
            <tr>
              <td class="text-left">
                <div class="form-group{{ $errors->has('promo') ? ' has-error' : '' }}">
                  @if (Request::get('promo'))
                    {!! Form::text('promo', (isset($request->promo)) ? $request->promo : null, ['class' => 'form-control form-control-rounded', 'id' => 'promo']) !!}
                  @else
                    {!! Form::text('promo', Cookie::get('promo') ? Cookie::get('promo') : null, ['class' => 'form-control form-control-rounded', 'id' => 'promo']) !!}
                  @endif
                  {!! Form::label('promo', 'Do you have a promo code?') !!}
                  <small class="text-danger" id="promoMessage">{{ $errors->first('promo') }}</small>
                  <span id="promoAmount" style="visibility: hidden;">0</span>
                </div>
              </td> 
              <td class="text-medium"><span id="promoDiscountDisplay">- $<span id="promoDiscount" class="promoDiscount">0.00</span></span></td>    
            </tr>
            <tr>
              <td>
                <div class="custom-control custom-checkbox">
                  {!! Form::checkbox('donate4', '1', null, ['id' => 'donate4', 'class' => 'custom-control-input pointer donate4']) !!} 
                  <label class="custom-control-label dp-warning pointer" for="donate4">Add $4 to get kids outdoors.</label>
                  <p><a href="#" data-toggle="modal" data-target="#modalDonate" id="whatIsThis">What is this?</a></p> 
                </div>
              </td>     
              <td class="text-medium">$<span id="donateAmount" class="donateAmount">0</span></td>   
            </tr>       
            <tr>
              <td></td>
              <td><h4><strong>$<span id="totalDue" class="totalDue"></span></strong></h4></td>
            </tr>
          </table>
        </section>
        {!! Form::button('Get My Pass <i class="icon-arrow-right"></i></a>', ['type' => 'submit', 'id' => 'paymentSubmit', 'class' => 'btn btn-primary btn-xl btn-block mt-0']) !!}
      </aside>
    </div>

  </div>
</div>

{{-- End Payment Form --}}
{!! Form::close() !!}

@stop

@section('scripts')
<script>

//////////
/// On Page Load
//////////

$(function() {

  // Hide the discount.
  $('#promoDiscountDisplay').hide();
  // Set promo discount to zero.
  var promoDiscount = 0;
  // Fire Total Due.
  addTotalDue(promoDiscount);

  // Check for pre-filled promo code.
  var promo = $('#promo').val();
  checkPromo(promo);

});

//////////
/// Promo Code Validation
//////////

// If the promo code is starting to be entered, disable the submit button.
$('#promo').on('focus', function() {
  if ($(this). val() != '') {
    $('#paymentSubmit').attr("disabled", "disabled");
  }
});

// As the user enters the promo code, continue to check for a valid promo code.
$('#promo').on('keyup', function() {
  var promo = $(this).val();
  checkPromo(promo)
});

function checkPromo(promo) {
  var promoCodes = {!! $promoCodes->pluck('code') !!};
  var passid = {{ $pass->id }};
  // If the promo code is valid.
  if (jQuery.inArray(promo, promoCodes)!='-1') {
      $('#promoMessage').html('<strong class="text-success">Cha Ching!</strong>');
      $('#promoDiscountDisplay').show();
      $('#paymentSubmit').removeAttr("disabled", "disabled");
      // If Friends and Family promo code.
      if (promo == 'GOFREE' || promo == 'YNPLOC' || promo == 'COTW18' || promo == 'TOMM19' || promo == 'TOMMFF' || promo == 'GFOR18' || promo == 'GOBUCK' && passid == 1) {
        var promoDiscount = 12;
        $('#promoAmount').text(12);
        // Hide credit card entry fields.
        $('.card-info').remove();
        $('#card-info').show().html('<div class="col-sm-12"><hr><h3 class="text-bold">Well, aren\'t you special!</h3><h5>Enjoy the discounts and spread the word about the GO Pass with travelers!</h5></div>');
        $('#number, #expiry, #cvc').attr("required", false);
        $('#paymentSubmit').removeAttr("disabled", "disabled");
      } else {
        var promoDiscount = 2;
        $('#promoAmount').text(promoDiscount);
        $('.card-info').show();
        $('#card-info').hide();
        $('#number, #expiry, #cvc').attr("required", true);
        $('#paymentSubmit').removeAttr("disabled", "disabled");
      }
      // Fire Total Due
      addTotalDue(promoDiscount);
  } 
  // If the promo code is emptied by the user.
  else if (promo == '') {
      $('#promoMessage').html('');
      $('#promoDiscountDisplay').hide();
      $('.card-info').show();
      $('#card-info').hide();
      $('#number, #expiry, #cvc').attr("required", true);
      $('#paymentSubmit').removeAttr("disabled", "disabled");
      var promoDiscount = 0;
      $('#promoAmount').text(promoDiscount);
      // Fire Total Due
      addTotalDue(promoDiscount);
  }
  // If the promo code is not valid (as they enter usaully). 
  else {
      $('#promoMessage').html('<strong>Code Not Valid</strong>');
      $('#promoDiscountDisplay').hide();
      $('.card-info').show();
      $('#card-info').hide();
      $('#number, #expiry, #cvc').attr("required", true);
      $('#paymentSubmit').attr("disabled", "disabled");
      var promoDiscount = 0;
      $('#promoAmount').text(promoDiscount);
      // Fire Total Due
      addTotalDue(promoDiscount);
  }
};

//////////
/// Direct Donation.
//////////

$('.donate4').on('click', function() {
  if($(this).is(':checked')) {
    $('.donate4').prop('checked', true);
    $('#dropdown-donate4').show();
  } else {
    $('.donate4').prop('checked', false);
    $('#dropdown-donate4').hide();
  }
  var promoAmount = $('#promoAmount').text();
  // Fire Total Due
  addTotalDue(promoAmount);
});

//////////
/// Add total due and display
//////////

function addTotalDue(promoDiscount) {
  // Add total of passes.
  totalPasses = 0;
  $('.passFee').each(function(){
      totalPasses += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
  });
  // Apply Promo Discount.
  $('.promoDiscount').text(addCommas(roundTo(promoDiscount, 0)));
  // Add donation.
  if ($('#donate4').is(':checked')) {
    var donateAmount = 4;
  } else {
    var donateAmount = 0;
  }
  $('.donateAmount').text(addCommas(roundTo(donateAmount, 0)));
  // Determine total amount.
  var promo = $('#promo').val();
  if (promo == 'YNPLOC' || promo == 'GO4YOU' || promo == 'COTW18' || promo == 'TOMM19' || promo == 'TOMMFF' || promo == 'GFOR18' || promo == 'GOBUCK') {
    var total = (0 + donateAmount);
  } else {
    var total = (totalPasses - promoDiscount) + donateAmount;
  }
  // console.log(total*100);
  // Send to hidden input field to send in form.
  $('#totalAmount').val(total*100);
  $('#price').val(total*100);
  // Display total due in Order Summary.
  $('.totalDue').text(addCommas(roundTo(total, 0)));
}

//////////
/// Adds Number Commas and decimal point.
//////////

function addCommas(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}

//////////
/// Rounds current calculations.
//////////

function roundTo(num, places) {
  var calc = (Math.round(num * (Math.pow(10, places))) / (Math.pow(10, places)));
  return calc.toFixed(2);
}

//////////
/// Form Validation
/// http://formvalidation.io/settings/
//////////

// $(function () {
//   $('#checkoutPayment').formValidation({
//     framework: 'bootstrap',
//     excluded: ':disabled',
//     fields: {
//       name: {
//         validators: {
//           notEmpty: {
//             message: 'What is the name on the card?'
//           }
//         }
//       },
//       zipcode: {
//         validators: {
//           notEmpty: {
//             message: 'How about a Zip Code?'
//           }
//         }
//       },
//       email: {
//         trigger: 'blur',
//         validators: {
//           notEmpty: {
//             message: 'Email is required.'
//           }
//         }
//       },
//       // number: {
//       //   validators: {
//       //     notEmpty: {
//       //       message: 'What is the credit card number?'
//       //     }
//       //   }
//       // },
//       // expiry: {
//       //   validators: {
//       //     notEmpty: {
//       //       message: 'Required'
//       //     }
//       //   }
//       // },
//       // cvc: {
//       //   validators: {
//       //     notEmpty: {
//       //       message: 'Required'
//       //     }
//       //   }
//       // }
//     }
//   });
// });

</script>
@stop