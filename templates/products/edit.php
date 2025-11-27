<?php $this->extend('/layout/app'); ?>
<?php $this->assign('title', 'Edit Product'); ?>

<?php $this->start('main'); ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <form id="form-edit" action="<?= $this->Url->build(['_name' => 'products.update']) ?>" method="POST">
            <div class="flex items-center mb-10">
                <div class="font-medium text-2xl">Edit Product</div>

                <div class="ms-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            <label class="floating-label mb-8">
                <input type="text" class="input input-lg w-full" name="title" value="<?= $product->title ?>">
                <span>Title</span>
            </label>

            <label class="floating-label mb-8">
                <textarea class="textarea input-lg w-full h-24" name="description"><?= $product->description ?></textarea>
                <span>Description</span>
            </label>

            <label class="floating-label mb-8">
                <input type="number" class="input input-lg w-full" name="price" step="0.01" value="<?= $product->price ?>">
                <span>Price</span>
            </label>

            <label class="mb-8">
                <input type="file" class="file-input file-input-lg w-full" name="image" accept="images/*">
                <div class="text-neutral text-sm mt-2">optional</div>
            </label>

            <input type="hidden" name="id" value="<?= $product->id ?>">
        </form>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('js'); ?>
<script>
    $('#form-edit').submit(function(e)
    {   
        e.preventDefault();

        const form = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json'
        })
        .done(function(res)
        {
            Swal.fire({
                icon: res.status,
                text: res.message
            });
        });
    });
</script>
<?php $this->end(); ?>
