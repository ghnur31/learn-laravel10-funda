<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <h2>Title: {{ $title }}</h2>
  <h2>Date: {{ $date }}</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Price</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
        <tr>
          <td>{{ $product->id }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->formatted_price }}</td>         
        </tr>
      @endforeach
  </table>
</body>
</html>