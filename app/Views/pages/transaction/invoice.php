<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?= $title ;?></title>
</head>
<body class="flex flex-col items-center justify-center">
  <h1 class="text-2xl text-center">Asad Kebab</h1>
  <h1 class="text-xl text-center"><?= isset($employee_id) ? 'Selling ' : 'Purchasing '?> Record</h1>
  <h3 class="text-center">Date/time : <?= $timestamp;?></h3>
  <?php if(isset($employee_id)) : ?>
    <h1 class="text-xl text-center">Cashier : <?= $employee_id." - ".$employee_name['username'] ;?></h1>
  <?php endif;?>
  <table border="1px">
    <thead>
      <tr>
        <th class="p-2 border border-slate-500 border-collapse">Product's Name</th>
        <th class="p-2 border border-slate-500 border-collapse">Price</th>
        <th class="p-2 border border-slate-500 border-collapse">Amount</th>
        <th class="p-2 border border-slate-500 border-collapse">Total</th>
      </tr>
    </thead>
    <tbody class="min-h-screen">
      <tr>
        <td class="border border-slate-500 border-collapse"><?= $menu_name['menu_name'];?></td>
        <td class="border border-slate-500 border-collapse"><?= $cost;?></td>
        <td class="border border-slate-500 border-collapse"><?= $amount;?></td>
        <td class="border border-slate-500 border-collapse"><?= $total_cost;?></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
    <tr>
      <td colspan="3">Total</td>
      <td><?= $total_cost; ?></td>
    </tr>
    <tr>
    </tr>
  </table>
</body>
</html>