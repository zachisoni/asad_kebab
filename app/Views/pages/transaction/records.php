<?= $this->extend('./layouts/template'); ?>
<?= $this->section('content'); ?>
<article class="flex flex-col items-center">
  <?php if(current_url() == site_url('transactions/buying')) :?>
    <h1 class="text-2xl font-bold text-center w-full my-3">Buying Records</h1>
    <a href="<?= base_url('transactions/buying/add') ?>" 
      class="py-2 px-6 bg-green-500 text-white font-semibold text-center rounded-lg text-lg my-2">
      Add Stock
    </a>
  <?php else :?>
    <h1 class="text-2xl font-bold text-center w-full my-3">Selling Records</h1>
    <a href="<?= base_url('transactions/selling/add') ?>" 
      class="py-2 px-6 bg-green-500 text-white font-semibold text-center rounded-lg text-lg my-2">
      Add Sell Transaction
    </a>
  <?php endif;?>
  <table class="table-auto my-4">
    <thead class="text-xl bg-sky-500 font-semibold text-white">
      <tr>
        <th class="px-3 py-2 border border-slate-300 border-colapse">ID</th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Product Name</th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">
          <?= isset($selling) ? 'Price per unit' : 'Cost'; ?>
        </th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Amount</th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Total Cost</th>
        <?php if(isset($selling)) : ?>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Member ID</th>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Employee ID</th>
        <?php endif;?>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Timestamp</th>
      </tr>
    </thead>
    <tbody class="bg-white text-center">
      <?php 
      if(current_url() == site_url('transactions/buying')):
        foreach($buying as $data): ?>
        <tr>
          <td class="border border-slate-300 border-colapse"><?= $data->id; ?></td>
          <td class="border border-slate-300 border-colapse"><?= $data->menu_name; ?></td>
          <td class="border border-slate-300 border-colapse">
            <?= $data->cost - floor($data->cost) == 0 ? "Rp ".$data->cost.".000" : "Rp ".$data->cost."00"; ?>
          </td>
          <td class="border border-slate-300 border-colapse"><?= $data->amount; ?></td>
          <td class="border border-slate-300 border-colapse">
            <?= $data->total_cost - floor($data->total_cost) == 0 ? "Rp ".$data->total_cost.".000" : "Rp ".$data->total_cost."00"; ?>
          </td>
          <td class="border border-slate-300 border-colapse"><?= $data->timestamp; ?></td>
        </tr>
      <?php endforeach; else : 
        foreach($selling as $data): ?>
          <tr>
            <td class="border border-slate-300 border-colapse"><?= $data->id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->menu_name; ?></td>
            <td class="border border-slate-300 border-colapse">
              <?= $data->cost - floor($data->cost) == 0 ? "Rp ".$data->cost.".000" : "Rp ".$data->cost."00"; ?>
            </td>
            <td class="border border-slate-300 border-colapse"><?= $data->amount; ?></td>
            <td class="border border-slate-300 border-colapse">
              <?= $data->total_cost - floor($data->total_cost) == 0 ? "Rp ".$data->total_cost.".000" : "Rp ".$data->total_cost."00"; ?>
            </td>
            <td class="border border-slate-300 border-colapse"><?= $data->user_id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->employee_id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->timestamp; ?></td>
          </tr>
      <?php endforeach; 
      endif;?>
      
    </tbody>
  </table>
</article>


<?= $this->endSection(); ?>