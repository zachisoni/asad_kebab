<?= $this->extend('./layouts/template'); ?>
<?= $this->section('content'); ?>
<article class="flex flex-col justify-center items-center">
  <div id="print" class="bg-white p-6">
    <h1 style="font-size:1.5rem; text-align:center;line-height: 1.75rem;" class="font-bold">Asad Kebab</h1>
    <hr class="my-4">
    <h1 style="font-size:1.25rem; text-align: center;line-height: 1.5rem;" class="font-bold">
      <?= isset($employee_id) ? 'Selling ' : 'Purchasing '?> Record
    </h1>
    <hr class="my-4">
    <p style="text-align:left; font-size:1rem; line-height: 1.5rem; margin-left:0.5rem;" class="my-4">
      Date : <?= substr($header[0]->timestamp, 0, 10);?>
    </p>
    <p style="text-align:left; font-size:1rem; line-height: 1.5rem; margin-left:0.5rem;" class="my-4">
      Time : <?= substr($header[0]->timestamp, 11, 8);?>
    </p>
    <p style="text-align:left; font-size:1rem; line-height: 1.5rem; margin-left:0.5rem;" class="my-4">
      Cashier : <?= $header[0]->id." - ".$header[0]->fullname ;?>
    </p>
    <?php if(isset($employee_id)) : ?>
    <?php endif;?>
    <table class="table-auto my-2" style="border-collapse: collapse; font-size:1.125rem; line-height: 1.5rem;">
      <thead style="border-width: 2px; border-color: #dc2626; border-style: solid none solid none; border-collapse: collapse;">
        <tr>
          <th style="padding:0.5rem 1rem;">Product</th>
          <th style="padding:0.5rem 1rem;">Price</th>
          <th style="padding:0.5rem 1rem;">Amount</th>
          <th style="padding:0.5rem 1rem;">Item's Total</th>
        </tr>
      </thead>
      <tbody style="text-align:left;border-width: 2px; border-color: #dc2626; border-style: solid none solid none;">
        <?php foreach($details as $detail):?>
        <tr class="">
          <td style="padding:0.5rem 1rem;" >
            <?= $detail->menu_name;?>
          </td>
          <td style="padding:0.5rem 1rem;" class="rupiah">
            <?= $detail->price;?>
          </td>
          <td style="padding:0.5rem 1rem;" >
            <?= $detail->amount;?> Items
          </td>
          <td style="padding:0.5rem 1rem;" class="rupiah">
            <?= $detail->total_cost;?>
          </td>
        </tr>
        <?php endforeach;?>
        <tr></tr>
        <tr></tr>
      </tbody>
      <tr>
        <td colspan="3" style="font-weight:bold; padding:1rem;">Total</td>
        <td style="padding:1rem;" class="rupiah"><?= $header[0]->total_cost; ?></td>
      </tr>
    </table>
  </div>
  <div class="flex justify-between w-1/3">

    <a href="<?= str_contains(current_url(), 'purchases')? base_url('purchases') : base_url('sellings')?>" 
        class="px-6 py-2 my-2 mx-3 bg-green-600 text-white rounded-lg">
      Back
    </a>
    <a href="#" class="px-6 py-2 my-2 mx-3 bg-blue-600 text-white rounded-lg" id='print-btn'>
      Print
    </a>
  </div>
</article>

<script>
  const printElement = document.getElementById('print');
  const printBtn = document.getElementById('print-btn');
  const rupiahs = document.getElementsByClassName('rupiah');

  for (const rupiah of rupiahs) {
    rupiah.innerText = 'Rp ' + Number(rupiah.innerText).toLocaleString('id-ID');
  }

  printBtn.addEventListener('click', () => {
    idElementPrint(printElement)
  });

  const idElementPrint = ref => {
    const iframe = document.createElement("iframe");
    iframe.style.display = "none";
    document.body.appendChild(iframe);
    const pri = iframe.contentWindow;
    pri.document.open('','');
    pri.document.write(ref.innerHTML);
    pri.document.close();
    pri.focus();
    pri.print();
    pri.onafterprint = () => { document.body.removeChild(iframe); }
  }
</script>
<?= $this->endSection(); ?>