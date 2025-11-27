
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