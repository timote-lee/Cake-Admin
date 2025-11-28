<?php

$this->Paginator->setTemplates([
    'nextActive'   => '<a href="{{url}}" class="join-item btn btn-sm" rel="next" aria-label="Next">{{text}}</a>',
    'nextDisabled' => '<a href="{{url}}" class="join-item btn btn-sm" disabled="disabled" aria-label="Next">{{text}}</a>',
    'prevActive'   => '<a href="{{url}}" class="join-item btn btn-sm" rel="prev" aria-label="Previous">{{text}}</a>',
    'prevDisabled' => '<a href="{{url}}" class="join-item btn btn-sm" disabled="disabled" aria-label="Previous">{{text}}</a>',
    'number'       => '<a href="{{url}}" class="join-item btn btn-sm" aria-label="Page {{text}}">{{text}}</a>',
    'current'      => '<a href="{{url}}" class="join-item btn btn-sm btn-active" aria-label="Current Page {{text}}">{{text}}</a>',
    'ellipsis'     => '<a href="{{url}}" class="join-item btn btn-sm" disabled="disabled">...</a>',
]);

?>

<div class="join">
    <?= $this->Paginator->prev('Previous', ['aria-label' => 'Previous Page']) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next('Next', ['aria-label' => 'Next Page']) ?>
</div>