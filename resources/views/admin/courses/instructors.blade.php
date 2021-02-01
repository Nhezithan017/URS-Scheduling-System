<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="all" />
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="all" />

<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">UNIVERSITY OF RIZAL SYSTEM</h1>
    <h1 class="text-sm">MORONG, CAMPUS</h1>
  </div>
</div>
<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">COLLEGE OF ENGINEERING</h1>

  </div>
</div>
<div class="row mb-4 container-fluid">
@foreach($alloc as $all)

<table width="1000px">
  <tbody>
    <tr>
    
      <td colspan="4" co>Name:</td>
      <td colspan="3">Position Title: </td>
      <td colspan="3">Nature of Appointment: </td>
    </tr>
    <tr>
      <td colspan="10">Degree(s)/Unit Earned:</td>
    </tr>
    <tr>  
      <td colspan="10">Educational Status: </td>
    </tr>
    <tr>
      <th>TIME</th>
      <th>DAYS</th>
      <th>SUBJECT CODE</th>
      <th>DESCRIPTION</th>
      <th>LEC</th>
      <th>LAB/SHOP/FIELD</th>
      <th>NO. OF HOURS</th>
      <th>ROOM</th>
      <th>YR & SEC</th>
      <th>CLASS SIZE</th>
    </tr>
  
    <tr align="center">
  
    <td></td>
      <td></td> 
      <td></td>
      <td></td>
      <td></td>
      <td></td>
 
    </tr>

  
    <tr align="center">
      <td></td>
      <td></td> 
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>

@endforeach
</div>





<script type="text/php">
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
</script> 