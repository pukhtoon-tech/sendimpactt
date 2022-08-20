@extends('marketplace.frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('csv_viewer/styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@11/dist/handsontable.full.min.css">
@endsection

@section('content')

<div class="text-center">
  <a href="{{ route('marketplace.frontend') }}" class="place-your-ad-here">
      <h1 class="footer-brand">{{ orgName() }}</h1>
      <h6 class="footer-sub-brand">CSV Viewer</h6>
  </a>
</div>

<input type="file" id="input-file" />
<label for="input-file" class="btn-1">Upload CSV File</label>

<div id="handsontable-container"></div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/handsontable@11/dist/handsontable.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/papaparse@5"></script>
<script src="{{ asset('csv_viewer/app.js') }}"></script>
@endsection