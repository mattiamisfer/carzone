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
 
</td>
</tr>
 
<tr>
<td width="349">
<p>Message</p>
</td>

<td>{{$order['content']}}
</tr>
 
 

<tr>
    <td>
        <p>From  {{ $order['name']}}</p>
         
        <p>&nbsp;</p>
    </td>
</tr>
</tbody>
</table>
    
</body>
</html>