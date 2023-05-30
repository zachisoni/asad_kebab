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
  <hr>
  <h1 class="text-xl text-center"><?= isset($employee_id) ? 'Selling ' : 'Purchasing '?> Record</h1>
  <h3 class="text-center">Date time : <?= $header[0]->timestamp;?></h3>
  <h1 class="text-xl text-center">Cashier : <?= $header[0]->id." - ".$header[0]->fullname ;?></h1>
  <?php if(isset($employee_id)) : ?>
  <?php endif;?>
  <table class="table-auto">
    <thead>
      <tr>
        <th class="p-2 border border-slate-500 border-collapse">Product's Name</th>
        <th class="p-2 border border-slate-500 border-collapse">Price</th>
        <th class="p-2 border border-slate-500 border-collapse">Amount</th>
        <th class="p-2 border border-slate-500 border-collapse">Total</th>
      </tr>
    </thead>
    <tbody class="min-h-screen">
      <?php foreach($details as $detail):?>
      <tr class="min-h-screen">
        <td class="border border-slate-500 border-collapse"><?= $detail->menu_name;?></td>
        <td class="border border-slate-500 border-collapse">Rp <?= $detail->price;?></td>
        <td class="border border-slate-500 border-collapse"><?= $detail->amount;?> Items</td>
        <td class="border border-slate-500 border-collapse">Rp <?= $detail->total_cost;?></td>
      </tr>
      <?php endforeach;?>
      <tr></tr>
      <tr></tr>
    </tbody>
    <tr>
      <td colspan="3">Total</td>
      <td>Rp <?= $header[0]->total_cost; ?></td>
    </tr>
    <tr>
      <br>
      <hr>
    </tr>
    <tr>
      <td colspan="2">
        <a href="<?= $header[0]->transaction_type == 'selling'  ? base_url('sellings') : base_url('purchases') ;?>" 
            class="px-6 py-2 bg-blue-600 text-white rounded-lg">Back</a>
      </td>
      <td colspan="2">
        <a href="#" onclick="window.print()" 
            class="px-6 py-2 bg-blue-600 text-white rounded-lg">Print</a>
      </td>
    </tr>
  </table>
</body>
</html>