<?php $this->extend('/layout/app'); ?>
<?php $this->assign('title', 'Products'); ?>

<?php $this->start('main'); ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="flex items-center mb-5">
            <div class="font-medium text-2xl">Products</div>

            <div class="ms-auto">
                <a href="<?= $this->Url->build(['_name' => 'products.create']) ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> New
                </a>
            </div>
        </div>

        <div class="overflow-x-auto mb-5">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php if ($products->isEmpty()): ?>
                    <tr class="text-center">
                        <td colspan="10">No record</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <tr class="align-middle">
                        <td><?= $product->id ?></td>
                        <td>
                            <div class="flex items-center gap-3">
                                <img src="<?= $product->image_url ?>" class="max-w-20 h-auto" alt="<?= $product->title ?>">
                                <div class="font-medium"><?= $product->title ?></div>
                            </div>
                        </td>       
                        <td><?= $this->Number->currency($product->price / 1000, 'MYR'); ?></td>
                        <td><?= $product->created ?></td>
                        <td>
                            <a href="<?= $this->Url->build(['_name' => 'products.edit', 'id' => $product->id]) ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?= $this->element('pagination') ?>
    </div>
</div>
<?php $this->end(); ?>