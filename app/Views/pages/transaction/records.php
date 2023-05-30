<?= $this->extend('./layouts/template'); ?>
<?= $this->section('content'); ?>
<article class="flex flex-col items-center">
  <?php if(current_url() == site_url('purchases')) :?>
    <h1 class="text-2xl font-bold text-center w-full my-3">Purchases Records</h1>
    <a href="<?= base_url('purchases/add') ?>" 
      class="py-2 px-6 bg-green-500 text-white font-semibold text-center rounded-lg text-lg my-2">
      Add Stock
    </a>
  <?php else :?>
    <h1 class="text-2xl font-bold text-center w-full my-3">Selling Records</h1>
    <a href="<?= base_url('sellings/add') ?>" 
      class="py-2 px-6 bg-green-500 text-white font-semibold text-center rounded-lg text-lg my-2">
      Add Sell Transaction
    </a>
  <?php endif;?>
  <table class="table-auto my-4">
    <thead class="text-xl bg-sky-500 font-semibold text-white">
      <tr>
        <th class="px-3 py-2 border border-slate-300 border-colapse">ID</th>
        <?php if(isset($selling)) : ?>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Member ID</th>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Employee ID</th>
        <?php endif;?>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Total Cost</th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Timestamp</th>
        <th class="px-3 py-2 border border-slate-300 border-colapse">Action</th>
      </tr>
    </thead>
    <tbody class="bg-white text-center">
      <?php 
      if(current_url() == site_url('purchases')):
        foreach($purchase as $data): ?>
        <tr>
          <td class="border border-slate-300 border-colapse"><?= $data->id; ?></td>
          <td class="border border-slate-300 border-colapse"><?= $data->total_cost?></td>
          <td class="border border-slate-300 border-colapse"><?= $data->timestamp; ?></td>
          <td class="px-3 py-2 border border-slate-300 border-colapse">
            <a href="<?= base_url('purchases/detail/').$data->id ?>" class="bg-blue-600 text-white px-6 py-2 rounded-xl">Details</a>
          </td>
        </tr>
      <?php endforeach; else : 
        foreach($selling as $data): ?>
          <tr>
            <td class="border border-slate-300 border-colapse"><?= $data->id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->user_id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->employee_id; ?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->total_cost?></td>
            <td class="border border-slate-300 border-colapse"><?= $data->timestamp; ?></td>
            <td class="px-3 py-2 border border-slate-300 border-colapse">
              <a href="<?= base_url('sellings/detail/').$data->id ?>" class="bg-blue-600 text-white px-6 py-2 rounded-xl">Details</a>
            </td>
          </tr>
      <?php endforeach; 
      endif;?>
      
    </tbody>
  </table>
</article>


<?= $this->endSection(); ?>