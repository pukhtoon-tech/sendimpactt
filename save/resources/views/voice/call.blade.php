@extends('../layout/' . layout())

@section('subhead')
<title>@translate(Twillio Call)</title>
@endsection

@section('subcontent')

<form method="post" action="{{ route('initiate_call') }}">
      @csrf
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <div class="form-group row col-8">
        <div class="form-group col-12">
          <label for="phoneNumber">Phone number</label>
          <input type="text" class="form-control" name="phone_number" id="phoneNumber" aria-describedby="phoneHelp" placeholder="Example, +18005551212" required>
          <small id="phoneHelp" class="form-text text-muted">Phone number should match <code>[+][country code][phone number including area code]</code></small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>

@endsection

@section('script')

@endsection