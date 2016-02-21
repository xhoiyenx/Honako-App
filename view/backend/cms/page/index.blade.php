@extends('includes.master')
@section('content')
@include('includes.breadcrumb')
@include('includes.messages')
<div class="panel-actions">
  <a href="{{ route('cms.page.create') }}" class="btn btn-success btn-quirk show-form">add new</a>
</div>
<table class="table table-custom table-hover table-cms no-margin">
  <thead>
    <tr>
      <th>Name</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  @if ( ! $contents->isEmpty() )
  <tbody>
    @foreach ( $contents as $content )
    <tr>
      <td>
        <a href="{{ route('cms.page.update', [$content->id]) }}">{{$content->name}}</a>
      </td>
      <td>
        <ul class="table-options">
          <li><a href="{{ route('cms.page.update', [$content->id]) }}"><i class="fa fa-pencil"></i></a></li>
          <li><a href="{{ action('App\Controller\Manager\Cms\Page@delete', [$content->id]) }}"><i class="fa fa-trash"></i></a></li>
        </ul>        
      </td>
    </tr>
    @endforeach
  </tbody>
  @else
  <tbody>
    <tr>
      <td colspan="10">No Data Found</td>
    </tr>
  </tbody>
  @endif
</table>

@endsection