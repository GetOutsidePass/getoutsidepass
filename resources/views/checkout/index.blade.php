@extends('_layouts.body')

@section('meta-page')
  <title>The Dimple Pass | Save Money on National Park Travel</title>
  <meta name="description" content="Meta Description Here" />
@stop

@section('meta-og')
  <meta property="og:type" content="article"/>
  <meta property="og:title" content="OG Title Here"/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="OG Image URL Here."/>
  <meta property="og:site_name" content="Dimple Pass"/>
  <meta property="og:description" content="OG Description Here."/>
  <meta property="og:locale" content="en_US"/>
@stop

@section('logo-tag')
Checkout : My Profile
@stop

@section('content')

{{-- Page Content --}}
<div class="container padding-bottom-3x mb-2">
  <div class="row mt-5">

    <div class="col-xl-9 col-lg-8">

      {{-- Checkout Steps --}}
      <div class="checkout-steps hidden-xs-down">
        <a href="/checkout/review">3. Review</a>
        <a href="/checkout/payment"><span class="angle"></span>2. Payment</a>
        <a class="active" href="/checkout"><span class="angle"></span>1. My Profile</a>
      </div>

      {{-- Spacer --}}
      <div class="padding-top-2x mt-2 hidden-lg-up"></div>

      <div class="col-sm-12 mb-4">
        <h4 class="dp-warning">You'll need to create an account to attach to your Dimple Pass.</h4>
      </div>

      {{-- Start Form --}}
      {!! Form::open(['action' => 'MemberController@store','method' => 'POST', 'class' => 'row', 'id' => 'checkoutProfile']) !!}

        <div class="col-md-6">
          <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
              {!! Form::label('firstname', 'First Name <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('firstname', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Happy']) !!}
              <small class="text-danger">{{ $errors->first('firstname') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
              {!! Form::label('lastname', 'Last Name <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('lastname', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'GoLucky']) !!}
              <small class="text-danger">{{ $errors->first('lastname') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('emailid') ? ' has-error' : '' }}">
              {!! Form::label('emailid', 'Email <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('emailid', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'happy@golucky.com']) !!}
              <small class="text-danger">{{ $errors->first('emailid') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              {!! Form::label('phone', 'Phone <small class="gray">optional</small>', [], false) !!}
              {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '(000) 000-0000']) !!}
              <small class="text-danger">{{ $errors->first('phone') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label('password', 'Password <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('password', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '*****']) !!}
              <small class="text-danger">{{ $errors->first('password') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('password2') ? ' has-error' : '' }}">
              {!! Form::label('password2', 'Re-enter Password <i class="pe-7s-leaf dp-warning"></i>', [], false) !!}
              {!! Form::text('password2', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '*****']) !!}
              <small class="text-danger">{{ $errors->first('password2') }}</small>
          </div>
        </div>
  
        {{-- Checkout Progress Buttons --}}
        <div class="checkout-footer margin-top-1x">
          <div class="column"></div>
          <div class="column">
            {!! Form::button('<span class="hidden-xs-down">Payment </span><i class="icon-arrow-right"></i></a>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
          </div>
        </div>

      {{-- End Form --}}
      {!! Form::close() !!}

    </div>

    {{-- Sidebar --}}
    <div class="col-xl-3 col-lg-4 hidden-xs-down">
      <aside class="sidebar stickyOrderSummary">
        <div class="padding-top-2x hidden-lg-up"></div>
        {{-- Order Summary --}}
        <section class="widget widget-order-summary">
          <h3 class="widget-title">Order Summary</h3>
          <table class="table">
            <tr>
              <td>Glacier</td>
              <td class="text-medium">$<span class="passFee">26.00</span></td>
            </tr>
            <tr>
              <td>Yellowstone</td>
              <td class="text-medium">$<span class="passFee">26.00</span></td>
            </tr>
            <tr>
              <td>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="donate4">
                  <label class="custom-control-label dp-warning" for="donate4">Add $4 to get kids outdoors.</label>
                  <p><a href="#"><i class="pe-7s-help1"></i> What is this?</a></p> 
                </div>
              </td>     
              <td  class="text-medium">$<span id="donateAmount" class="donateAmount">0</span></td>   
            </tr>       
            <tr>
              <td></td>
              <td class="text-lg text-medium">$<span id="totalDue" class="totalDue"></span></td>
            </tr>
          </table>
        </section>
      </aside>
    </div>
  </div>
</div>

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
/// Add direct donation to total on checkbox click.
//////////

$('#donate4').on('click', function() {
  addDonation();
});

//////////
/// Add direct donation to total
//////////

function addDonation() {
  if ($('#donate4').is(':checked')) {
    var donateAmount = 4;
  } else {
    var donateAmount = 0;
  }
  $('.donateAmount').text(addCommas(roundTo(donateAmount, 0)));
  var total = totalPasses + donateAmount;
  $('.totalDue').text(addCommas(roundTo(total, 0)));
}

//////////
/// Add total due and display
//////////

function addTotalDue() {
  totalPasses = 0;
  $('.passFee').each(function(){
      totalPasses += parseFloat($(this).text());  // Or this.innerHTML, this.innerText
  });
  $('.totalDue').text(addCommas(roundTo(totalPasses, 0)));
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
  $('#checkoutProfile').formValidation({
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
      emailid: {
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
      password2: {
        validators: {
          notEmpty: {
            message: 'A password is required.'
          }
        }
      }
    }
  });
});

</script>
@stop