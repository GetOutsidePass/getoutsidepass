@extends('_layouts.body')

@section('meta-page')
  <title>Get Outside Pass - My Profile</title>
  <meta name="description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation." />
  <meta name="keywords" content="national parks, travel, discounts, coupons, attractions, activities, things to do, Get Outside Pass">
@stop

@section('meta-og')
  <meta property="og:type" content="article"/>
  <meta property="og:title" content="Get Outside Pass - My Profile"/>
  <meta property="og:url" content="{{ Request::url() }}"/>
  <meta property="og:image" content="{{ url('/img/destinations/yellowstone-1200x630.jpg') }}"/>
  <meta property="og:site_name" content="Get Outside Pass"/>
  <meta property="og:description" content="One Pass. Multiple Discounts. Save money and don't miss a thing during your National Park Vacation."/>
  <meta property="og:locale" content="en_US"/>
@stop

@section('content')

{{-- Page Title --}}
<div class="page-title hidden-sm-down">
  <div class="container">
    <div class="column">
      <h1>My Profile: {{ $user->firstname . " " . $user->lastname }}</h1>
    </div>
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="/">Home</a>
        </li>
        <li class="separator">&nbsp;</li>
        <li>My Profile</li>
      </ul>
    </div>
  </div>
</div>

<div class="hidden-sm-up mt-5"></div>

{{-- Page Content --}}
<div class="container padding-bottom-3x mb-2">
  <div class="row">
    <div class="col-lg-4">
      <div class="sticky">
        <aside class="user-info-wrapper">
          <div class="user-cover" style="background-image: url(/img/account/user-cover-img.jpg);">
            {{-- <div class="info-label" data-toggle="tooltip" title="You currently have 290 Reward Points to spend"><i class="icon-medal"></i>290 points</div> --}}
          </div>
          <div class="user-info">
            <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="/img/account/user-ava.jpg" alt="User"></div>
            <div class="user-data">
              <h4>{{ (!is_null(Auth::user()->firstname)) ? Auth::user()->firstname : null }} {{ (!is_null(Auth::user()->lastname)) ? Auth::user()->lastname : null }}</h4>
              <span>Joined {{ (!is_null(Auth::user()->created_at)) ? Auth::user()->created_at->format('F j, Y') : null }}</span>
            </div>
          </div>
        </aside>
        <nav class="list-group">
          <a class="list-group-item with-badge" href="{{ route('member.show', Auth::user()) }}"><i class="icon-tag"></i>My Passes<span class="badge badge-primary badge-pill">{{ count(Auth::user()->purchases) }}</span></a>
          <a class="list-group-item active" href="{{ route('member.edit', Auth::user()) }}"><i class="icon-head"></i>My Profile</a>
        </nav>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="padding-top-2x mt-2 hidden-lg-up"></div>

        @if(Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span>
          <h3>Yabba Dabba Doo!</h3>
          <h5> {{ session('status') }}</h5>
        </div>
        @endif

        {{-- Start Form --}}
        {!! Form::model($user,['route' => ['member.update', $user], 'method' => 'PUT', 'id' => 'memberEdit', 'class' => 'row form-horizontal']) !!}

        <div class="row">     
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                {!! Form::label('firstname', 'First Name') !!}
                {!! Form::text('firstname', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'First Name']) !!}
                <small class="text-danger">{{ $errors->first('firstname') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                {!! Form::label('lastname', 'Last Name') !!}
                {!! Form::text('lastname', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Last Name']) !!}
                <small class="text-danger">{{ $errors->first('lastname') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email']) !!}
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                {!! Form::label('phone', 'Phone') !!}
                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Phone']) !!}
                <small class="text-danger">{{ $errors->first('phone') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                {!! Form::label('city', 'City') !!}
                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('city') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                {!! Form::label('state', 'State') !!}
                {!! Form::select('state', $states, null, ['id' => 'state', 'class' => 'form-control', 'placeholder' => 'Choose']) !!}
                <small class="text-danger">{{ $errors->first('state') }}</small>
            </div>
          </div>  
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                {!! Form::label('zip', 'Zip') !!}
                {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('zip') }}</small>
            </div>
          </div> 
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                {!! Form::label('country', 'Country') !!}
                {!! Form::select('country', $countries, null, ['id' => 'country', 'class' => 'form-control', 'placeholder' => 'Choose']) !!}
                <small class="text-danger">{{ $errors->first('country') }}</small>
            </div>
          </div>
          <div class="col-md-6 changePasswordDisplay">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                {!! Form::label('password', 'Change Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
          </div>
          <div class="col-md-6 changePasswordDisplay">
            <div class="form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
                {!! Form::label('confirmPassword', 'Confirm New Password') !!}
                {!! Form::password('confirmPassword', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                <small class="text-danger">{{ $errors->first('confirmPassword') }}</small>
            </div>
          </div>
          <div class="col-sm-12 text-right" id="changePasswordButton">
            <h6><a href="#" id="changePassword" class="btn btn-sm btn-primary">Change Password</a></h6>
          </div>

        <div class="col-12">
          <hr class="mt-2 mb-3">
          <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="mx-3 custom-control custom-checkbox d-block">
              <input class="custom-control-input" type="checkbox" id="subscribe_me" checked>
              <label class="custom-control-label" for="subscribe_me">Subscribe me to Newsletter</label>
            </div>
            {!! Form::button('Update Profile <i class="icon-arrow-right"></i></a>', ['type' => 'submit', 'class' => 'btn btn-primary margin-right-none']) !!}
          </div>
        </div>

        {!! Form::close() !!}

      </div>

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

  /// Status Alert Fadeout
  $("#status").fadeOut(2000)

  /// Hide Change Password Display
  $('.changePasswordDisplay').hide();

});

//////////
/// Show Password Fields
/////////

$('#changePassword').on('click', function() {
  $('.changePasswordDisplay').toggle();
  $('#changePasswordButton').toggle();
});

//////////
/// Form Validation
/// http://formvalidation.io/settings/
//////////

$(function () {
    $('#memberEdit').formValidation({
        framework: 'bootstrap',
        icon: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
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
            validators: {
              notEmpty: {
                message: 'Email is required.'
              }
            }
          },
          password: {
            enabled: false,
            validators: {
              notEmpty: {
                message: 'A password is required.'
              }
            }
          },
          confirmPassword: {
            enabled: false,
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
    }).on('click', '#changePasswordButton', function() {
    // Enable Validation of Password Fields
      $('#memberEdit')
        .formValidation('enableFieldValidators', 'password')
        .formValidation('enableFieldValidators', 'confirmPassword');
  });
});

</script>
@stop