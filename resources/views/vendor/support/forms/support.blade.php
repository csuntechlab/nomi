<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Submit Support Request | {{ $application_name }}</title>

    <style type="text/css">
      .required {
        color: red;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm-8">
          <h1>Submit Support Request</h1>

          <p>You are currently logged-in as {{ $submitter_name }} ({{ $submitter_email }}).</p>
        </div>
      </div>

      @if($errors->count() > 0)
        <div class="row justify-content-md-center">
          <div class="col-sm-8">
            <div class="alert alert-danger">
              <p>The following errors occurred:</p>
              <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
              </ul>
            </div>
          </div>
        </div>
      @elseif(!empty($success))
        <div class="row justify-content-md-center">
          <div class="col-sm-8">
            <div class="alert alert-success">
              {{ $success }}
            </div>
          </div>
        </div>
      @elseif(session('success'))
        <div class="row justify-content-md-center">
          <div class="col-sm-8">
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          </div>
        </div>
      @endif

      <div class="row justify-content-md-center">
        <div class="col-sm-8">
          <form method="POST" action="{{ route('support.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="form-group">
              <label for="impact"><span class="required">*</span> Impact</label>
              <select name="impact" id="impact" class="form-control">
                @foreach($impact as $key => $value)
                  @if(old('impact') == $key)
                    <option value="{{ $key }}" selected="selected">
                  @else
                    <option value="{{ $key }}">
                  @endif
                  {{ $value }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="content"><span class="required">*</span> Support Request Message</label>
              <textarea class="form-control" rows="5" name="content" id="content" placeholder="Please enter your support request message...">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Support Request</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>