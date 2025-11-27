<?php $this->extend('/layout/app'); ?>
<?php $this->assign('title', 'Users'); ?>

<?php $this->start('main'); ?>
<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="font-medium text-2xl">Users</div>

        <div class="overflow-x-auto mb-5">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->created ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?= $this->element('pagination') ?>
    </div>
</div>
<?php $this->end(); ?>