@extends('layouts.app')
@section('content')


<form  method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction">

@csrf
@method('PUT')

    <input type="hidden" name="encRequest" value="{{$encrypted_data}}"/>
    <input type="hidden" name="access_code" value="{{$access_code}}"/>

</form>
 
@endsection

@section('payment-js')
<script language='javascript'>document.redirect.submit();</script>
@endsection