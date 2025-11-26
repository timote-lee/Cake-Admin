<?php $this->extend('/layout/app'); ?>
<?php $this->assign('title', 'Dashboard'); ?>

<?php $this->start('main'); ?>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <div class="flex">
                <i class="fas fa-4x text-primary fa-user-circle"></i>

                <div class="flex-1 pl-3">
                    <div class="font-bold text-3xl text-primary"><?= $users_count ?></div>
                    <div class="font-medium">Total Users</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end(); ?>