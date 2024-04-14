<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Product List</title>
</head>

<body class="bg-gray-300">
  <div class="container mx-auto p-8 ">

  <button class="bg-green-400 text-white p-2 rounded-md">Add product</button>
    <h2 class="text-2xl font-bold mb-4">Product List</h2>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">Product Name</th>
          <th class="py-2 px-4 border-b">Price</th>
          <th class="py-2 px-4 border-b">Stock</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="py-2 px-4 border-b">Product A</td>
          <td class="py-2 px-4 border-b">$19.99</td>
          <td class="py-2 px-4 border-b">10</td>
        </tr>
        <tr>
          <td class="py-2 px-4 border-b">Product B</td>
          <td class="py-2 px-4 border-b">$29.99</td>
          <td class="py-2 px-4 border-b">5</td>
        </tr>
        <tr>
          <td class="py-2 px-4 border-b">Product C</td>
          <td class="py-2 px-4 border-b">$14.99</td>
          <td class="py-2 px-4 border-b">8</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>