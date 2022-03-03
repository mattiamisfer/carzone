<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<table>
<tbody>
<tr>
<td width="349">
    <img src="{{ asset('assets/images/carzone.png') }}" width="345"/>
</td>
<td colspan="3" width="349">
<p>Invoice No: {{ $order['order_id'] }}</p>
<p>Date:  {{ \Carbon\Carbon::now()}}</p>
</td>
</tr>
<tr>
<td colspan="4" width="697">
<p><strong>INVOICE</strong></p>
</td>
</tr>
<tr>
<td width="349">
<p>Particulars</p>
</td>
<td width="114">
<p>Rate per item</p>
</td>
<td width="66">
<p>Qty</p>
</td>
<td width="168">
<p>Gross</p>
</td>
</tr>
<tr>
<td width="349">
<p> {{ $order['data']->name}}</p>
</td>
<td width="114">
<p>{{ $order['data']->prices->price}} AED</p>
</td>
<td width="66">
<p>1</p>
</td>
<td width="168">
<p>{{ $order['data']->prices->price}} AED</p>
</td>
</tr>
 
<td width="349">
<p>Net</p>
</td>
<td colspan="3" width="349">
<p>{{ $order['data']->prices->price}} AED</p>
</td>
</tr>
<tr>
<td colspan="4" width="697">
<p>&nbsp;</p>
</td>
</tr>

<tr>
    <td>
        <p>Dear  {{ $order['name']}}</p>
        <p>Thanks for placing order with CZONE.</p>
        <p>&nbsp;</p>
    </td>
</tr>
</tbody>
</table>
    
</body>
</html>