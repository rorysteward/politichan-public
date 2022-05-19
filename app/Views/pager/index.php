<div class="govuk-breadcrumbs">
    <ol class="govuk-breadcrumbs__list">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </a>
            </li>
            <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="govuk-breadcrumbs__list-item active" <?= $link['active'] ? '' : '' ?>>
                <a class="govuk-breadcrumbs__link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>
            <li class="govuk-breadcrumbs__list-item">
                <a class="govuk-breadcrumbs__link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </a>
            </li>
        <?php endif ?>
    </ol>
</div>