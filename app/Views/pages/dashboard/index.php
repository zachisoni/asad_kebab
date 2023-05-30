<?= $this->extend('./layouts/template'); ?>
<?= $this->section('content'); ?>
<?php 
  $total_transactions =  $sellings[0]->count + $purchases[0]->count;

  $balance = $sellings[0]->selling - $purchases[0]->purchase;
?>
<h1 class="text-2xl font-bold w-full text-center">Dashboard</h1>
<?= password_hash('tezt123', PASSWORD_DEFAULT); ?>
<article class="py-4 px-2 w-full flex items-center justify-around flex-wrap">
  <div class="text-xl font-semibold text-green-600 bg-white shadow-lg flex rounded-lg m-4 basis-full">
    <h2 class="bg-green-600 px-8 py-3 text-white rounded-l-lg">Total Menu</h2>
    <p class="px-8 py-3"><?= $total_menu[0]->menu_count ?> Menus</p>
  </div>

  <div class=" flex text-lg font-semibold text-white bg-white shadow-xl rounded-xl m-4 basis-5/12 flex-wrap">
    <div class="px-8 py-3 rounded-t-xl basis-full">
      <h2 class="text-cyan-600 rounded-tl-xl text-left">Transactions Made</h2>
      <h2 class="rounded-tr-xl text-center text-sky-600 text-2xl"><?= $total_transactions; ?></h2>
    </div>
    <div class="px-8 py-3 basis-1/2 text-white bg-emerald-600 rounded-bl-xl">
      <h2>Sellings</h2>
      <h2 class="text-center text-2xl"><?= $sellings[0]->count ;?></h2>
    </div>
    <div class="px-8 py-3 basis-1/2 text-white bg-rose-600 rounded-br-xl">
      <h2>Purchases</h2>
      <h2 class="text-center text-2xl"><?= $purchases[0]->count;?></h2>
    </div>
  </div>

  <div class=" flex text-lg font-semibold text-white bg-white shadow-xl rounded-xl m-4 basis-5/12 flex-wrap">
    <div class="px-8 py-3 rounded-t-xl basis-full">
      <h2 class="text-cyan-600 rounded-tl-xl text-left">Balance</h2>
      <h2 class="rounded-tr-xl text-center 
        <?= $balance > 0 ? 'text-sky-600' : 'text-rose-600' ?> text-2xl">
      Rp <?=$balance?>
      </h2>
    </div>
    <div class="px-8 py-3 basis-1/2 text-white bg-cyan-600 rounded-bl-xl">
      <h2>Income</h2>
      <h2 class="text-center text-2xl">
        Rp <?= $sellings[0]->selling ;?>
      </h2>
    </div>
    <div class="px-8 py-3 basis-1/2 text-white bg-red-600 rounded-br-xl">
      <h2>Outcome</h2>
      <h2 class="text-center text-2xl">
        Rp <?= $purchases[0]->purchase;?>
      </h2>
    </div>
  </div>
    
</article>

<?= $this->endSection(); ?>