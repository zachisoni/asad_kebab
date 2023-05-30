<?= $this->extend('./layouts/template');?>
<?= $this->section('content'); ?>
<section class="flex flex-col w-full items-center">
  <h1 class="text-3xl font-bold w-full text-center mb-4">Menus</h1>
  <?php if(session("isLoggedIn") && session("role") == 1):?>
    <a class="text-white bg-sky-600 font-semibold py-2 px-6 rounded-lg text-center"
      href="<?= base_url('menu/add') ?>">Add New Menu</a>
     
  <?php endif;?>
</section>

<section class="my-4">
  <h2 class="text-2xl font-bold my-3 text-rose-800">Foods</h2>
  <div class="flex">
    <?php if(count($foods) > 0) : ?>
      <?php foreach ($foods as $food):?>
        <a href="<?= base_url('menu/').$food->id ?>" 
          class="rounded-lg shadow-lg my-4 mx-4 bg-white w-40 h-80 hover:scale-105 transition duration-500">
          <img class="rounded-t-lg w-full h-1/2 object-cover"
              src="<?= base_url('img/'). $food->menu_image ?>"
              alt="<?= $food->menu_name;?>">
          <div class="py-6 px-3 h-1/2 flex flex-col justify-between">
            <h2 class="text-xl my-3 font-semibold"><?= $food->menu_name;?></h2>
            <p class="text-orange-700">Rp <?=$food->price?></p>
            <p class="text-sky-600">Stock : <?= $food->fin_amount ?></p>
          </div>
        </a>
      <?php endforeach?>
    <?php else : ?>
      <h2 class="text-lg w-full text-center font-semibold text-rose-600 py-5 bg-white rounded-lg my-5">
        No Foods Data Available
      </h2>
    <?php endif;?>
  </div>
</section>

<section class="my-4">
  <div class="flex flex-col">      
    <h2 class="text-2xl font-bold my-3 text-sky-800">Drinks</h2>  
    <?php if(count($drinks) > 0) : ?>
      <?php foreach ($drinks as $drink):?>
        <a href="<?= base_url('menu/').$drink->id ?>" 
          class="rounded-lg shadow-lg my-4 mx-4 bg-white w-40 h-80">
          <img class="rounded-t-lg w-full h-40 object-cover"
              src="<?= base_url('img/'). $drink->menu_image ?>" 
              alt="<?= $drink->menu_name;?>">
          <div class="py-6 px-3 h-1/2 flex flex-col justify-between">
            <h2 class="text-xl my-3 font-semibold"><?= $drink->menu_name;?></h2>
            <p class="text-orange-700">
              Rp 
              <?= ($drink->price - floor($drink->price) > 0.0 ? $drink->price."00" : $drink->price.".000") ?>
            </p>
            <p class="text-sky-600">Stock : <?= $drink->fin_amount ?></p>
          </div>
        </a>
      <?php endforeach?>
    <?php else : ?>
      <h2 class="text-lg w-full text-center font-semibold text-rose-600 py-5 bg-white rounded-lg my-5">
        No Drinks Data Available
      </h2>
    <?php endif;?>
  </div>
</section>

<?= $this->endSection(); ?>