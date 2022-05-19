<form method="post" id="delete-post" name="delete-post" action="<?= base_url() ?>/board/deletePost">
    <div class="govuk-form-group delete-post" style="text-align:center;">
        <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="password">Password?</label></h1>
        <input class="govuk-input govuk-!-width-two-thirds" id="delete_password" name="password" type="text">
    </div>
</form>
<div class="dialog_form_actions">
    <button class="govuk-button govuk-button--secondary close-dialog" data-module="govuk-button">
        Return back
    </button>
    <button class="govuk-button govuk-button--warning delete-post-submit" data-module="govuk-button">
        Delete post
    </button>
</div>