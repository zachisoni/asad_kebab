<?= $this->extend('./layouts/template');?>
<?= $this->section('content'); ?>
<?php $i = 0; ?>
<article class="flex justify-center w-full">
  <?php ?>
  <form method="post" enctype="multipart/form-data"
    action="<?= isset($members) ? base_url('transaction/add_transaction') :base_url('transaction/add_stock'); ?>" 
    class="rounded-xl bg-white shadow-lg py-10 flex flex-col items-center px-6">
    <input type="number" name="size" id="size" hidden value='0'>
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
                  $i = 0;
                  if($menu->fin_amount > 0):?>
                    <option value="<?= $menu->id ?>" id="<?= $i; ?>"><?= $menu->id." - ".$menu->menu_name; ?></option>
              <?php 
                  $i++;
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
              class="amount m-2 p-2 w-1/2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right">
            Unit(s)
          </td>
          <td class="border border-collapse border-sky-500">
            <p class="total w-full focus:border-none border-none p-2 rounded-lg" id="total[0]">Rp 0</p>
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
  const tbody = document.getElementById('table-body');

  const menuId0 = document.getElementById(`menu_id[0]`);
  const totalRow0 = document.getElementById(`total[0]`);
  const amount0 = document.getElementById(`amount[0]`);
  const cost0 = document.getElementById(`cost[0]`);

  const amounts = [0]
  const costs = [0]
  const totals = [0]

  <?php if(isset($members)) :?> 
    const menus = {
    <?php foreach ($menus as $menu ):?> 
      <?=$menu->id?> : [
        <?= $menu->fin_amount ?>,
        <?= $menu->price ?>
      ],
    <?php endforeach;?>
    };
    document.addEventListener('DOMContentLoaded', () => {
      setPrice(cost0, menuId0, 0);
      setTotalPerRow(totalRow0, 0);
      <?php if (isset($members)) : ?>
        amount0.max = menus[menuId0.value][0];
      <?php endif; ?>
    })
  <?php endif; ?>


  cost0.addEventListener('change', () => {
    setCost(cost0, 0);
    setTotalPerRow(totalRow0, 0);
  });
  amount0.addEventListener('change', () => {
    setAmount(amount0, 0);
    setTotalPerRow(totalRow0, 0);
  });

  menuId0.addEventListener('change', () => {
    setPrice(cost0, menuId0, 0);
    setTotalPerRow(totalRow0, 0);
    <?php if (isset($members)) : ?>
      amount0.max = menus[menuId0.value][0];
      if (amount0.value > menus[menuId0.value][0]) {
        amount0.value = menus[menuId0.value][0];
      }
    <?php endif;?>
  });
  
  let size = 1;
  let total = 0.0;
  sizeElement.value = size;

  function setTotalPerRow(totalElement, id){
    const totalThisRow = amounts[id] * costs[id]
    // const totalElement = document.getElementById(`total[${id}]`)
    totals[id] = (totalThisRow);
    totalElement.innerText = 'Rp ' + totalThisRow.toLocaleString('id-ID')
    setTotal();
  }

  function setPrice(costElement, element, id){
    costElement.value = menus[element.value][1];
    costs[id] = menus[element.value][1];
  }

  function setTotal(){
    total = 0
    totals.forEach(element => {
      total += element
    });

    totalTransaction.innerText = 'Rp ' + (Number(total).toLocaleString('id-ID'));
  }

  function setCost(element, id){
    costs[id] = (element.value)
  }

  function setAmount(element, id){
    amounts[id] = (element.value)
  }

  function addRow(){
    const id = size;
    costs.push(0);
    amounts.push(0);
    totals.push(0);
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
    const cost_input = document.createElement('input')
    cost_input.type = 'number'
    cost_input.name = `cost[${id}]`
    cost_input.id = `cost[${id}]`
    cost_input.className = 'cost my-2 p-2 w-1/2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right'
    cost_input.readOnly = <?= isset($members) ? true : false; ?>;
    cost_input.min = 0;
    cost_input.value = 0;
    cost_td.classList.add("flex","items-center","justify-center","border","border-collapse","border-sky-500");

    const amount_td = document.createElement('td');
    const amount_input = document.createElement('input')
    amount_input.type = 'number'
    amount_input.name = `amount[${id}]`
    amount_input.id = `amount[${id}]`
    amount_input.className = 'amount m-2 p-2 w-1/2 bg-slate-100 rounded-lg focus:border-none focus:outline-sky-400 text-right'
    amount_input.min = 0;
    amount_input.value = 0;
    amount_td.classList.add("border","border-collapse","border-sky-500");

    const total_td = document.createElement('td');
    total_td.classList.add("border","border-collapse","border-sky-500");
    const total_element = document.createElement('p');
    total_element.className = 'total w-full focus:border-none border-none p-2 rounded-lg';
    total_element.id = `total[${id}]`;
    total_element.innerText = 'Rp 0';

    function amount_change() {
      setAmount(amount_input, id);
      setTotalPerRow(total_element, id);
    }

    function cost_change() {
      setCost(cost_input, id);
      setTotalPerRow(total_element, id);
    }

    cost_input.addEventListener('change', cost_change)
    amount_input.addEventListener('change', amount_change)
    menu_element.addEventListener('change', () => {
      setPrice(cost_input, menu_element, id);
      setTotalPerRow(total_element, id);
      <?php if (isset($members)) : ?>
        amount_input.max = menus[menu_element.value][0];
        if (amount_input.value > menus[menu_element.value][0]) {
          amount_input.value = menus[menu_element.value][0];
        }
      <?php endif; ?>
    })

    cost_td.appendChild(cost_input)
    cost_td.appendChild(document.createTextNode('/Unit'));
    row.appendChild(cost_td);

    amount_td.appendChild(amount_input)
    amount_td.appendChild(document.createTextNode('Unit(s)'));
    row.appendChild(amount_td);

    total_td.appendChild(total_element);
    row.appendChild(total_td);

    // menu_element.addEventListener('selected', ()=> {
    //   setPrice(cost_input, menu_element, id);
    // })

    tbody.appendChild(row);
    
    size ++;
    sizeElement.value = size;
  }
</script>

<?= $this->endSection(); ?>