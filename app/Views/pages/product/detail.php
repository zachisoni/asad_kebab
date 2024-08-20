<?= $this->extend('./layouts/template');?>
<?= $this->section('content');?>

<article class="flex items-start justify-center px-24">
  <p id="menu_id" hidden><?= $details['id']?></p>
  <p id="menu_name" hidden><?= $details['menu_name']?></p>
  <img src="<?=$_ENV['IMAGE_URL'].$details['menu_image'];?>" alt="" srcset="" 
    class="h-96 w-96 object-cover rounded-xl mx-10">
    <div class="bg-white rounded-xl shadow-lg w-3/4 px-10 py-6 flex flex-col items-center">
      <h2 class="text-2xl font-bold mt-5 w-full"><?= $details['menu_name'] ?></h2>
      <h3 class="text-xl font-semibold w-full text-orange-600">
        <?="Rp ".$details['price']; ?>
      </h3>
      <h3 class="text-sky-600 text-xl font-semibold w-full mb-2 mt-4">Stock : <?= $details['fin_amount'] ?></h3>
      <?php if(session("isLoggedIn") && session("role") == 1):?>
        <h3 class="text-pink-600 text-xl font-semibold w-full mb-2">Sellings : <?= $details['selling'] ?></h3>
        <form action="<?= base_url("menu/delete/").$details['id'] ?>" method="post" 
            class="w-full flex flex-col items-center">
          <a href="<?= base_url("menu/edit/".$details['id'])?>" 
            class="my-3 px-6 py-3 bg-sky-600 rounded-lg text-lg font-semibold text-white w-1/2 text-center
              hover:bg-sky-700 transition duration-600">
            Edit Menu
          </a>
          <input type="submit" value="Delete Menu" 
            onclick="return confirm(`Are you sure want to delete Menu '${menuName.innerText}' (id = ${menuId.innerText}) ?`);"
            class="my-3 px-6 py-3 bg-rose-600 rounded-lg text-lg font-semibold text-white w-1/2 text-center
              hover:bg-red-700 transition duration-600">
        </form>
      <?php endif; ?>
      <div class="py-5 px-5 bg-slate-50 rounded-lg w-5/6">
        <h3 class="text-lg font-semibold my-3">Details</h3>
      <p class="my-5"><?= $details['details']?></p>
    </div>
  </div>
</article>

<script>
  const menuId = document.getElementById('menu_id');
  const menuName = document.getElementById('menu_name');
</script>

<?= $this->endSection();?>