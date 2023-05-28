<?= $this->extend('./layouts/template');?>
<?= $this->section('content'); ?>
<?php $i = 0; ?>
<article class="flex justify-center w-full">
  <form method="post" enctype="multipart/form-data" 
    action="<?= isset($members) ? base_url('transaction/add_transaction') :base_url('transaction/add_stock'); ?>" 
    class="w-3/4 rounded-xl bg-white shadow-lg py-10 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-6">
      <?= isset($members) ? 'Add Transaction' : 'Add Stock';?>
    </h1>
    <?php if(null !== validation_list_errors()):?>
      <div class="text-red-700 text-md text-center"><?= validation_list_errors(); ?></div>
    <?php endif; ?>
    <p class="text-lg text-semibold"><?= date('d-m-Y', strtotime('+7 Hour')); ?></p>
    <table class="table-auto w-1/2 my-5">
      <tr>
        <td><label for="member_id" class="text-lg font-semibold">Member ID</label></td>
        <td>
          <input type="number" name="member_id" id="member_id" min="0" value="0"
            class="my-2 p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
        </td>
      </tr>
      <tr>
        <td><label for="menu_id" class="text-lg font-semibold">Menu</label></td>
        <td>
          <select name="menu_id" id="menu_id" 
            class="my-2 p-2 w-3/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
            <?php foreach($menus as $menu): ?>
              <option value="<?= $menu->id ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
            <?php endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="cost" class="text-lg font-semibold">Price per unit</label></td>
        <td class="flex items-center justify-left">
          <input type="number" name="cost" id="cost" min="0.0" step="0.1" value="0.0" readonly
            class="my-2 p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">
          <p id="zeros">.000 </p>/ Unit
        </td>
      </tr>
      <tr>
        <td><label for="amount" class="text-lg font-semibold">Quantity</label></td>
        <td class="">
          <input type="number" name="amount" id="amount" min="0"
            class="my-2 p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">
          Unit(s)
        </td>
      </tr>
      <tr>
        <td class="text-lg font-semibold py-3">Total</td>
        <td>
          <p class="text-lg font-semibold" id="total">Rp 0</p>
        </td>
      </tr>
    </table>
    <input type="submit" value="Add Stock" onclick="return confirm('Are you sure want to make transaction?');"
      class=" my-2 px-6 py-3 bg-sky-500 text-sky-50 font-semibold text-lg rounded-lg 
        hover:bg-sky-600 hover:text-white transition duration-500">
  </form>
</article>

<script src="/js/priceZeros.js"></script>
<script>

  const menuId = document.getElementById('menu_id');
  const totalCost = document.getElementById('total');
  const amount = document.getElementById('amount');  

  let total = 0.0;
  let prices = [
    <?php foreach ($menus as $menu ):?>
      <?= $menu->price?>,
    <?php endforeach;?>
  ];

  document.addEventListener('DOMContentLoaded', event=>{
    cost.value = prices[menuId.value - 1];
  })

  menuId.addEventListener('change', event =>{
    cost.value = prices[menuId.value - 1];
    zero.innerText = cost.value - Math.floor(cost.value) == 0 ? ".000" : "00"
    total = (cost.value * amount.value);
    total = total - Math.floor(total) > 0 ? total.toFixed(1) : total;
    totalCost.innerHTML = `Rp ${total}`;
    totalCost.innerHTML += total - Math.floor(total) == 0 ? '.000' : '00';
  });

  amount.addEventListener('change', event => {
    total = (cost.value * amount.value);
    total = total - Math.floor(total) > 0 ? total.toFixed(1) : total;
    totalCost.innerHTML = `Rp ${total}`;
    totalCost.innerHTML += total - Math.floor(total) == 0 ? '.000' : '00';
  });
</script>

<?= $this->endSection(); ?>