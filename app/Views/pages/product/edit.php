<?= $this->extend('./layouts/template');?>
<?= $this->section('content');?>
<article class="flex justify-center w-full">
  <?php $addOrEdit = isset($menu_data) ? "Edit Menu" : "Add Menu"; ?>
  
  <form method="post" enctype="multipart/form-data"
    action="<?= isset($menu_data) ? base_url('menu/save/'.$menu_data['id']) : base_url('menu/saveNew') ?>" 
    class="w-3/4 rounded-xl bg-white shadow-lg py-10 flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-6"><?= $addOrEdit ?></h1>
    <?php if(null !== validation_list_errors()):?>
      <div class="text-red-700 text-md text-center"><?= validation_list_errors(); ?></div>
    <?php endif; ?>
    <table class="table-auto w-5/6 my-5">
      <tr class="px-5">
        <td><label for="menu_name" class="text-lg font-semibold">Menu Name</label></td>
        <td>
          <input type="text" name="menu_name" id="menu_name"
            <?= isset($menu_data) ? 'value ="'.$menu_data['menu_name'].'"' : 'placeholder="Menu Name"'?>
            class="my-2 p-2 placeholder:italic w-full bg-slate-100 rounded-lg 
            focus:border-none focus:outline-sky-400">
        </td>
      </tr>
      <tr>
        <td><label for="price" class="text-lg font-semibold">Price</label></td>
        <td class="flex items-center">Rp 
          <input type="number" name="price" id="cost" min="0" 
            value="<?= isset($menu_data) ? $menu_data['price'] : "0"?>"
            class="my-2 p-2 w-1/4 bg-slate-100 rounded-lg ml-2 focus:border-none focus:outline-sky-400">
        </td>
      </tr>
      <tr>
        <td><label for="init_amount" class="text-lg font-semibold">Initial Amount</label></td>
        <td>
          <input type="number" name="init_amount" id="init_amount" min="0"
            class="my-2 p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400"
            value="<?= isset($menu_data) ? $menu_data['init_amount'].'" readonly="readonly"' : '0'?>">
        </td>
      </tr>
      <tr>
        <td><label for="menu_type" class="text-lg font-semibold">Menu Type</label></td>
        <td>
          <select name="menu_type" id="menu_type"
            class="my-2 p-2 w-full bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
            <?php foreach ($types as $type) : ?>
              <option name="<?= $type->id ?>" id="<?= $type->id ?>" value="<?= $type->id ?>"
                <?= isset($menu_data) && $menu_data['menu_type'] == $type->id ? "selected" : ""?>>
                <?= $type->type_name ?>
              </option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><label for="menu_image" class="text-lg font-semibold">Menu Image</label></td>
        <td>
          <input type="file" name="menu_image" id="menu_image" onchange="previewImage(this);"
              class="file:my-2 file:py-2 file:px-4 w-3/4 file:bg-slate-800 transition duration-600
              file:rounded-full file:border-none file:text-white hover:file:bg-slate-700">

          <img alt="" id="image_preview" class="w-80 object-cover rounded-xl"
            src="<?= isset($menu_data) ? base_url().'/img/'.$menu_data['menu_image'] : "#" ?>">
        </td>
      </tr>
      <tr>
        <td><label for="details" class="text-lg font-semibold">Menu Details</label></td>
        <td>
          <textarea name="details" id="details" cols="55" rows="5" placeholder="Menu Details"
            class="my-2 p-2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400
              placeholder:italic"><?= isset($menu_data) ? $menu_data['details'] : ''?></textarea>
        </td>
      </tr>
    </table>
    <input type="submit" value="<?= $addOrEdit ?>" class="py-3 px-10 bg-blue-500 text-sky-100 font-semibold rounded-xl
      hover:bg-blue-600 hover:text-white transition duration-600">
 </form>
</article>

<script src="/js/priceZeros.js"></script>
<script>
  const menuType = document.getElementById('menu_type');

  menuType.addEventListener("change", event => {
    console.log("Menu Type : " + menuType.value);
  });

  const imagePreview = document.getElementById('image_preview');

  function previewImage(input){
    let imageSrc = URL.createObjectURL(input.files[0]);
    imagePreview.classList.add("h-80");
    imagePreview.src = imageSrc;
  }

</script>

<?= $this->endSection(); ?>