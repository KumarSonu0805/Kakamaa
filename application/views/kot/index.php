
<h3>KOT Items</h3>
<table border="1">
    <tr><th>Category</th><th>Item</th><th>Variant</th><th>Qty</th><th>Status</th></tr>
    <?php foreach ($kot_items as $item): ?>
    <tr>
        <td><?= $item->category ?></td>
        <td><?= $item->item ?></td>
        <td><?= $item->variant ?></td>
        <td><?= $item->qty ?></td>
        <td><?= $item->status ?></td>
    </tr>
    <?php endforeach; ?>
</table>
