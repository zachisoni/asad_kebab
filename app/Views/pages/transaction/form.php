<?= $this->extend('./layouts/template');?>
<?= $this->section('content'); ?>
<?php $i = 0; ?>
<article class="flex justify-center w-full">
  <?php ?>
  <form method="post" enctype="multipart/form-data"
    action="<?= isset($members) ? base_url('transaction/add_transaction') :base_url('transaction/add_stock'); ?>" 
    class="rounded-xl bg-white shadow-lg py-10 flex flex-col items-center px-6">
    <input type="text" name="size" id="size" hidden>
    <h1 class="text-2xl font-bold mb-6">
      <?= isset($members) ? 'Add Selling Transaction' : 'Add Stock';?>
    </h1>
    <?php if(null !== validation_list_errors()):?>
      <div class="text-red-700 text-md text-center"><?= validation_list_errors(); ?></div>
    <?php endif; ?>
    <p class="text-lg text-semibold"><?= date('d-m-Y', strtotime('now')); ?></p>
    <table class="table-auto my-5">
      <thead class="text-xl bg-sky-500 font-semibold text-white rounded-b-xl">
        <tr>
          <?php if(isset($members)) : ?>
            <th class="px-3 py-2 border border-slate-300 border-colapse">Member</th>
          <?php endif;?>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Product</th>
          <th class="px-3 py-2 border border-slate-300 border-colapse">
            <?= isset($members) ? 'Price ' : 'Cost '; ?> per unit
          </th>
          <th class="px-3 py-2 border border-slate-300 border-colapse">Quantity</th>
          <th class="px-3 py-2 border border-slate-300 border-colapse">
            Total <?= isset($members) ? ' price' : ' cost'; ?>
          </th>
        </tr>
      </thead>
      <tbody id="table-body">
        <tr>
          <?php if(isset($members)) : ?>
            <td class="border border-collapse border-sky-500">
              <select name="member_id[0]" id="member_id[0]" 
                class="member_id m-2 p-2 w-3/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
                <option value="null" selected> - </option>
                <?php foreach($members as $member):?>
                  <option value="<?= $member->id ?>"><?= $member->id." - ".$member->fullname; ?></option>
                <?php endforeach;?>
              </select>
            </td>
          <?php endif;?>
          <td class="border border-collapse border-sky-500">
            <select name="menu_id[0]" id="menu_id[0]" 
              class="menu_id my-2 m-2 p-2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
              <?php 
              foreach($menus as $menu):
                if(isset($members)) :
                  if($menu->fin_amount > 0):?>
                    <option value="<?= $menu->id ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
              <?php 
                  endif;
                else:?>
                <option value="<?= $menu->id ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
              <?php 
                endif;
              endforeach;
              ?>
            </select>
          </td>
          <td class="flex items-center border border-collapse border-sky-500 justify-center">
            <input type="number" name="cost[0]" id="cost[0]" min="0" value="0" 
              <?= isset($members) ? 'readonly' : ''; ?>
              class="cost my-2 p-2 w-1/2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">/ Unit
          </td>
          <td class="border border-collapse border-sky-500">
            <input type="number" name="amount[0]" id="amount[0]" min="0" value="0"
              class="amount m-auto p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">
            Unit(s)
          </td>
          <td class="border border-collapse border-sky-500">Rp
            <input type="number" class="total w-1/2 focus:border-none border-none p-2 rounded-lg" id="total[0]" disabled>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="<?= isset($members) ?'5' : '4' ?>" class="pb-5 pt-1 px-2 text-center">
            <a href="#" class="bg-green-500 text-white py-2 px-8 rounded-b-xl font-semibold" onclick="addRow();" id="addRow">
              Add Row
            </a>
          </td>
        </tr>
        <tr class="bg-orange-200">
          <td class="text-lg font-semibold py-3 text-center" colspan="<?= isset($members) ?'4' : '3' ?>">Total</td>
          <td>
            <p class="text-lg font-semibold" id="totalTransaction">Rp 0</p>
          </td>
        </tr>
      </tfoot>
    </table>
    <input type="submit" value="Save Transaction" 
      onclick="return confirm('Are you sure want to make transaction?');"
      class=" my-2 px-6 py-3 bg-sky-500 text-sky-50 font-semibold text-lg rounded-lg 
        hover:bg-sky-600 hover:text-white transition duration-500">
  </form>
</article>

<script>
  const sizeElement = document.getElementById(`size`);
  const addButton = document.getElementById('addRow');
  const totalTransaction = document.getElementById('totalTransaction');
  const totalRows = document.getElementsByClassName('total');
  const tbody = document.getElementById('table-body');
  
  let size = 1;
  let total = 0.0;
  sizeElement.value = size;

<?php if (isset($menus[0]->price)) : ?>
  let max_values = [
    <?php foreach($menus as $menu) :?>
      <?= $menu->fin_amount; ?>,
    <?php endforeach;?>
  ];

  
  tbody.addEventListener('click', event => {
    totalTransaction.innerText = 'Rp ' + total;
    console.log('total : '+total);
  });

  let prices = [
    <?php foreach ($menus as $menu ):?> 
      <?= $menu->price?>,
      <?php endforeach;?>
    ];
    
  <?php endif;?>
  setValue();

  function setValue() {
    let totalInRow = 0.0
    for(let i = 0; i < size; i++){
      let menuId = document.getElementById(`menu_id[${i}]`);
      let totalRow = document.getElementById(`total[${i}]`);
      let amount = document.getElementById(`amount[${i}]`);  
      let cost = document.getElementById(`cost[${i}]`);
      let zero = document.getElementById(`zeros[${i}]`);
      console.log(cost.id)
      
      <?php if (isset($menus[0]->price)) : ?>
          document.addEventListener('DOMContentLoaded', event=>{
          cost.value = prices[menuId.value - 1];
        })
      <?php endif;?>
      
      cost.addEventListener('click', event => {
        setPrice();
        
      });

      cost.addEventListener('change', event=>{
        setTotalCost();
      });
      
      amount.addEventListener('change', event => {
        setTotalCost();
      });
      
      function setTotalCost() {
        totalInRow = (cost.value * amount.value);
        totalRow.value = totalInRow;
      }

      function setPrice(){
        <?php if (isset($menus[0]->price)) : ?>
          amount.max = max_values[menuId.value - 1];
          cost.value = prices[menuId.value - 1];
          <?php endif;?>
          totalInRow = (cost.value * amount.value);
          totalRow.value = totalInRow;
      }

      total += totalInRow;
    }
  }

  function addRow(){
    const row = document.createElement('tr');

    row.innerHTML = `<?php if(isset($members)) : ?>
              <td class="border border-collapse border-sky-500">
                <select name="member_id[${size}]" id="member_id[${size}]" 
                class="member_id m-2 p-2 w-3/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400">
                <option value="null" selected> - </option>
                <?php foreach($members as $member):?>
                  <option value="<?= $member->id ?>"><?= $member->id." - ".$member->fullname; ?></option>
                <?php endforeach;?>
                </select>
              </td>
              <?php endif;?>`;

    const menu_td = document.createElement('td');
    menu_td.classList.add("border","border-collapse","border-sky-500");
    const menu_element = document.createElement('select');
    menu_element.name = `menu_id[${size}]`;
    menu_element.id = `menu_id[${size}]`;
    menu_element.classList.add("menu_id","my-2","m-2","p-2","bg-slate-100","rounded-lg","focus:border-none","focus:outline-sky-400")
    menu_element.innerHTML = `<?php 
                                foreach($menus as $menu):
                                  if(isset($members)) :
                                    if($menu->fin_amount > 0):?>
                                      <option value="<?= $menu->id ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
                                <?php endif;
                                  else: ?>
                                    <option value="<?= $menu->id ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
                                <?php 
                                  endif;
                                endforeach;?>`
    menu_td.appendChild(menu_element);
    row.appendChild(menu_td);

    const cost_td = document.createElement('td');
    cost_td.innerHTML = `<input type="number" name="cost[${size}]" id="cost[${size}]" min="0" value="0" 
                          <?= isset($members) ? 'readonly' : ''; ?>
                          class="cost my-2 p-2 w-1/2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">/ Unit`;
    cost_td.classList.add("flex","items-center","justify-center","border","border-collapse","border-sky-500");
    row.appendChild(cost_td);

    const amount_td = document.createElement('td');
    amount_td.classList.add("border","border-collapse","border-sky-500");
    amount_td.innerHTML = `<input type="number" name="amount[${size}]" id="amount[${size}]" min="0" value="0"
                            class="amount m-auto p-2 w-1/4 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">
                          Unit(s)`;
    row.appendChild(amount_td);

    const total_td = document.createElement('td');
    total_td.classList.add("border","border-collapse","border-sky-500");
    const total_element = document.createElement('p');
    total_element.classList.add("text-lg","total");
    total_element.id = `total[${size}]`;
    total_element.innerText = 'Rp 0';
    total_td.appendChild(total_element);
    row.appendChild(total_td);

    tbody.appendChild(row);
    
    size ++;
    sizeElement.value = size;
    setValue();
  }
</script>

<?= $this->endSection(); ?>