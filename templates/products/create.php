<?php $this->extend('/layout/app'); ?>
<?php $this->assign('title', 'New Product'); ?>

<?php $this->start('main'); ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <form id="form-create" action="<?= $this->Url->build(['_name' => 'products.store']) ?>" method="POST">
            <div class="flex items-center mb-10">
                <div class="font-medium text-2xl">New Product</div>

                <div class="ms-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            <label class="floating-label mb-4">
                <input type="text" class="input input-lg w-full" name="title" placeholder="Title">
                <span>Title</span>
            </label>

            <label class="floating-label mb-4">
                <textarea class="textarea input-lg w-full h-24" name="description" placeholder="Description"></textarea>
                <span>Description</span>
            </label>

            <label class="floating-label mb-4">
                <input type="number" class="input input-lg w-full" name="price" placeholder="Price" step="0.01">
                <span>Price</span>
            </label>

            <label class="mb-4">
                <input type="file" class="file-input file-input-lg w-full" name="image" accept="images/*">
            </label>
        </form>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('js'); ?>
<script>
    $('#form-create').submit(function(e)
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

            if (res.status == 'success')
            {
                form[0].reset();
            }
        });
    });
</script>
<?php $this->end(); ?>
