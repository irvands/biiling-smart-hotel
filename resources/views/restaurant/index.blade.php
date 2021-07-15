@extends('layouts.app')

@section('content')
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#all" data-toggle="tab" role="tab">Semua</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#appetizer" data-toggle="tab" role="tab">Appetizer</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#maincourse" data-toggle="tab" role="tab">Main Course</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#dessert" data-toggle="tab" role="tab">Dissert</a>
    </li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="all">
        <p>
           @include('restaurant.all')
    
</div>
<div role="tabpanel" class="tab-pane" id="appetizer">
<p>
           @include('restaurant.appetizer')
</div>
<div role="tabpanel" class="tab-pane" id="maincourse">
<p>
           @include('restaurant.maincourse')
</div>
<div role="tabpanel" class="tab-pane" id="dessert">
<p>
           @include('restaurant.dessert')
</div>
</div>


@endsection
