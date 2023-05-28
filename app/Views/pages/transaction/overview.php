<?= $this->extend('./layouts/template'); ?>
<?= $this->section('content'); ?>

<h1 class="text-2xl font-bold w-full text-center">Transactions</h1>
<article class="py-5 px-2 w-full flex justify-around items-center">
  <a href="<?= base_url('transactions/buying'); ?>" 
    class="rounded-xl m-2 w-2/5 bg-sky-600 hover:translate-y-0 transition duration-500 translate-y-1 shadow-lg
          hover:shadow-xl">
    <div class="bg-white w-full p-2 rounded-t-lg">
      <h2 class="text-xl font-semibold w-full text-center text-sky-600">Buying Transaction</h2>
    </div>
    <div class="w-full p-6 text-white font-semibold">
      See or print exsisting data of buying transaction. Add stock to existing menu
    </div>
  </a>
  <a href="<?= base_url('transactions/selling'); ?>" 
    class="rounded-xl m-2 w-2/5 bg-orange-600 hover:translate-y-0 transition duration-500 translate-y-1 shadow-lg
          hover:shadow-xl">
    <div class="bg-white w-full p-2 rounded-t-lg">
      <h2 class="text-xl font-semibold w-full text-center text-orange-600">Selling Transaction</h2>
    </div>
    <div class="w-full p-6 text-white font-semibold">
      See or print existing data of selling transaction. Make new selling transaction
    </div>
  </a>
</article>

<?= $this->endSection(); ?>