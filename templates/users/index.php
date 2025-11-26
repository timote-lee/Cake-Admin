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

        <?php

        $this->Paginator->setTemplates([
            'nextActive'   => '<button class="join-item btn btn-sm" rel="next" aria-label="Next">{{text}}</button>',
            'nextDisabled' => '<button class="join-item btn btn-sm" disabled="disabled" aria-label="Next">{{text}}</button>',
            'prevActive'   => '<button class="join-item btn btn-sm" rel="prev" aria-label="Previous">{{text}}</button>',
            'prevDisabled' => '<button class="join-item btn btn-sm" disabled="disabled" aria-label="Previous">{{text}}</button>',
            'number'       => '<button class="join-item btn btn-sm" aria-label="Page {{text}}">{{text}}</button>',
            'current'      => '<button class="join-item btn btn-sm btn-active" aria-label="Current Page {{text}}">{{text}}</button>',
            'ellipsis'     => '<button class="join-item btn btn-sm" disabled="disabled">...</button>',
        ]);

        ?>

        <div class="join">
            <?= $this->Paginator->prev('Previous', ['aria-label' => 'Previous Page']) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Next', ['aria-label' => 'Next Page']) ?>
        </div>
    </div>
</div>
<?php $this->end(); ?>