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

{{-- Start Form --}}
{!! Form::open(['action' => 'CheckoutController@registerUser','method' => 'POST', 'id' => 'checkoutRegister', 'class' => 'interactive-credit-card']) !!}
{!! Form::hidden('pass_id', $pass->id) !!}

{{-- Page Content --}}
<div class="container padding-bottom-3x mb-2">
  <div class="row mt-5">
    <div class="col-lg-8">

        <h3 class="text-warning text-bold">Start saving money right now.</h3>
        <h4><strong>Your pass will be available immediately upon purchase.</strong></h4>

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
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Name on Card <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('name', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'Full Name']) !!}
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                    {!! Form::label('zipcode', 'Zip Code <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('zipcode', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'Zip Code']) !!}
                    <small class="text-danger">{{ $errors->first('zipcode') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'Email <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('email', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'you@email.com']) !!}
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
              <div class="col-sm-12">
                <div class="card-wrapper"></div>
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                    {!! Form::label('number', 'Card Number <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('number', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'Card Number']) !!}
                    <small class="text-danger">{{ $errors->first('number') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('expiry') ? ' has-error' : '' }}">
                    {!! Form::label('expiry', 'Expiration <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('expiry', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'MM/YY']) !!}
                    <small class="text-danger">{{ $errors->first('expiry') }}</small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group{{ $errors->has('cvc') ? ' has-error' : '' }}">
                    {!! Form::label('cvc', 'CVC <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
                    {!! Form::text('cvc', null, ['class' => 'form-control form-control-rounded', 'required' => 'required', 'placeholder' => 'CVC']) !!}
                    <small class="text-danger">{{ $errors->first('cvc') }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
      @include('/checkout/_inc/ordersummary')
    </div>

  </div>
</div>

{{-- End Form --}}
{!! Form::close() !!}

@stop

@section('scripts')
<script>

//////////
/// On Page Load
//////////

$(function() {

  /// Add total of all passes.
  addTotalDue();

});

//////////
/// Promo Code Validation
//////////

$('#promo').on('blur', function() {
  alert('Validate on blur.');
});


//////////
/// Direct Donation sync and math.
//////////

$('.donate4').on('click', function() {
  if($(this).is(':checked')) {
    $('.donate4').prop('checked', true);
    $('#dropdown-donate4').show();
  } else {
    $('.donate4').prop('checked', false);
    $('#dropdown-donate4').hide();
  }
  // Fire donation math.
  addTotalDue();
});

//////////
/// Update Pass Count in Header after removal
//////////

function passCountSubtract() {
  var count = Number($('#count').text());
  count--;
  $(".count").text(count).fadeIn(1200);
}

//////////
/// Add total due and display
//////////

function addTotalDue() {
  // Add total of passes.
  totalPasses = 0;
  $('.passFee').each(function(){
      totalPasses += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
  });
  // Add donation.
  if ($('#donate4').is(':checked')) {
    var donateAmount = 4;
  } else {
    var donateAmount = 0;
  }
  $('.donateAmount').text(addCommas(roundTo(donateAmount, 0)));
  // Add total of passes and donation.
  var total = totalPasses + donateAmount; 
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

$(function () {
  $('#checkoutRegister').formValidation({
    framework: 'bootstrap',
    excluded: ':disabled',
    fields: {
      firstname: {
        validators: {
          notEmpty: {
            message: 'What is your first name?'
          }
        }
      },
      lastname: {
        validators: {
          notEmpty: {
            message: 'What is you last name?'
          }
        }
      },
      email: {
        trigger: 'blur',
        validators: {
          notEmpty: {
            message: 'Email is required.'
          }
        }
      },
      number: {
        validators: {
          notEmpty: {
            message: 'What is the credit card number?'
          }
        }
      },
      name: {
        validators: {
          notEmpty: {
            message: 'What is the name on the card?'
          }
        }
      },
      address: {
        validators: {
          notEmpty: {
            message: 'What is your address?'
          }
        }
      },
      city: {
        validators: {
          notEmpty: {
            message: 'What city?'
          }
        }
      },
      state: {
        validators: {
          notEmpty: {
            message: 'Which state?'
          }
        }
      },
      expiry: {
        validators: {
          notEmpty: {
            message: 'Required'
          }
        }
      },
      cvc: {
        validators: {
          notEmpty: {
            message: 'Required'
          }
        }
      },
      zipcode: {
        validators: {
          notEmpty: {
            message: 'How about a Zip Code?'
          }
        }
      }
    }
  });
});

</script>
@stop