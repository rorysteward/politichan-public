<html>

<body>
    <form method="post" id="add_create" name="add_create" action="<?= base_url() ?>/public/creator/newPost">
        <div style="width:800px; margin:0 auto;" class="form-group">
            <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_email">
                    email
                </label>
            </h1>
            <input class="form-control" id="post_email" name="post_email" type="text">
        </div>
        <div style="width:800px; margin:0 auto;" class="form-group">
            <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_title">
                    Title
                </label>
            </h1>
            <input class="form-control" id="post_title" name="post_title" type="text">
        </div>
        <div style="width:800px; margin:0 auto;" class="form-group">
            <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_text">
                    <center> Post text </center>
                </label>
            </h1>
            <textarea class="govuk-textarea" id="post_text" name="post_text" rows="5" aria-describedby="more-detail-hint"></textarea>
        </div>

        <div style="width:800px; margin:0 auto;" class="form-group">
            <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_password" value="<?= 'post_password' ?>>
            Password to delete post
        </label>
        </h1>
             <center><input class=" form-control" id="post_password" name="post_password" type="text"></center>
        </div>

        <div style="width:150px; margin:0 auto;">
            <button class="govuk-button" data-module="govuk-button">
                Submit
            </button>
        </div>
        <div class="govuk-warning-text">
            <span class="govuk-warning-text__icon" aria-hidden="true">!</span>
            <strong class="govuk-warning-text__text">
                <span class="govuk-warning-text__assistive">Warning</span>
                You agree to our terms and conditions, in failure to observe these, your account might be terminanted without warning
            </strong>
        </div>
    </form>
</body>

</html>