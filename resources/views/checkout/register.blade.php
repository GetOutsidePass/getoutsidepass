@extends('_layouts.body')

@section('meta-page')
  <title>Dimple Pass - National Parks Discount Cards</title>
  <meta name="description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation." />
  <meta name="keywords" content="national parks, travel, discounts, coupons, attractions, activities, things to do, dimple pass">
@stop

@section('meta-og')
  <meta property="og:type" content="article"/>
  <meta property="og:title" content="Dimple Pass - National Parks Discount Cards"/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="{{ url('/img/destinations/yellowstone-1200x630.jpg') }}"/>
  <meta property="og:site_name" content="Dimple Pass"/>
  <meta property="og:description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation."/>
  <meta property="og:locale" content="en_US"/>
@stop

@section('content')

{{-- Start Form --}}
{!! Form::open(['action' => 'CheckoutController@registerUser','method' => 'POST', 'id' => 'checkoutRegister']) !!}
{!! Form::hidden('pass_id', $pass->id) !!}

{{-- Page Content --}}
<div class="container padding-bottom-3x mb-2">
  <div class="row mt-5">
    <div class="col-lg-8">

      {{-- Checkout Steps --}}
      <div class="checkout-steps hidden-xs-down">
        <a href="#">2. Payment</a>
        <a class="active" href="#"><span class="angle"></span>1. My Profile</a>
      </div>

      {{-- User Action Statement --}}
      <h3 class="mb-5">Create a profile to attach to your Dimple Pass.</h3>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
              {!! Form::label('firstname', 'First Name <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('firstname', null, ['class' => 'form-control form-control-rounded', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('firstname') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
              {!! Form::label('lastname', 'Last Name <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('lastname', null, ['class' => 'form-control form-control-rounded', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('lastname') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label('email', 'Email <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('email', null, ['class' => 'form-control form-control-rounded', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('email') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              {!! Form::label('phone', 'Phone <small class="gray">optional</small>', [], false) !!}
              {!! Form::text('phone', null, ['class' => 'form-control form-control-rounded', 'placeholder' => '(000) 000-0000']) !!}
              <small class="text-danger">{{ $errors->first('phone') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label('password', 'Password <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::password('password', ['class' => 'form-control form-control-rounded', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('password') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
              {!! Form::label('confirmPassword', 'Re-enter Password <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::password('confirmPassword',['class' => 'form-control form-control-rounded', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('confirmPassword') }}</small>
          </div>
        </div>

        {{-- Checkout Progress Buttons --}}
        <div class="col-sm-12">
          <div class="checkout-footer margin-top-1x">
            {!! Form::button('Payment <i class="icon-arrow-right"></i></a>', ['type' => 'submit', 'class' => 'btn btn-primary float-right m-2']) !!}
          </div>
        </div>

      </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4 hidden-xs-down">
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
      password: {
        validators: {
          notEmpty: {
            message: 'A password is required.'
          }
        }
      },
      confirmPassword: {
        validators: {
          notEmpty: {
            message: 'Password confirmation is required.'
          },
          identical: {
            field: 'password',
            message: 'Passwords do not match.'
          }
        }
      }
    }
  });
});

</script>
@stop