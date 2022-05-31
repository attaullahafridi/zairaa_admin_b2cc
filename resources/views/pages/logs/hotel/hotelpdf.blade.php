<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hotel Logs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Hotel Logs</h2>
  <p>Date: {{\Carbon\Carbon::parse($selected_date1)->format('d-M-Y')}}</p>            
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Location</th>
        <th>No. of Searches</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($data))
      @foreach($data as $da)
      <tr>
        <td>{{$da->to_location}}</td>
        <td>{{$da->num_of_occ}}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>
</div>

</body>
</html>
