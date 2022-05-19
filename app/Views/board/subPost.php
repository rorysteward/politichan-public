<?php if (isset($return)) { ?>
  <a href="<?= base_url() ?>/boards/<?= $return ?>" class="govuk-back-link">Back</a>
<?php } ?>
<main class="govuk-main-wrapper">
  <div class="govuk-width-container" style="zoom: 1; padding-bottom: 0px;">

    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <form class="form-post" method="post" name="newpostform" enctype="multipart/form-data" action="<?= base_url() ?>/board/newPost">
          <input id="original_post_id" name="original_post_id" type="hidden" value="<?= $original_post_id ?>">

          <fieldset class="govuk-fieldset">
            <div class="govuk-form-group" id="email-div">
              <label class="govuk-label" for="width-20">
                Email
              </label>
              <input class="govuk-input govuk-input--width-20 post_email" id="post_email" name="post_email" type="text">
            </div>
            <div class="govuk-form-group" id="title-div">
              <label class="govuk-label" for="width-20">
                Post Title
              </label>
              <input class="govuk-input govuk-input--width-20 post_title" id="post_title" name="post_title" type="text">
            </div>
            <div class="form-group" id="text-div">
              <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_text">
                  Post text
                </label>
              </h1>
              <textarea required class="govuk-textarea post_text" id="post_text" name="post_text" rows="6" aria-describedby="more-detail-hint"></textarea>
            </div>
            <div class="govuk-form-group" id="file-div">
              <label class="govuk-label" for="userfile">
                Upload a file
              </label>
              <input class="govuk-file-upload" id="userfile" name="userfile" type="file" value="upload" accept="image/*" />
            </div>
            <div class="govuk-form-group">
              <label class="govuk-label" for="post_password">
                Password to delete post
              </label>
              <input class="govuk-input govuk-!-width-two-thirds" id="post_password" name="post_password" type="text" value="<?= $post_password ?>" readonly />
            </div>
          </fieldset>
          <button class="g-recaptcha govuk-button" data-sitekey="<?php echo $site_key ?>" data-callback='onSubmit' data-action='submit'>Submit</button>
        </form>
      </div>
    </div>
  </div>
</main>
<hr class="govuk-section-break govuk-section-break--xl govuk-section-break--visible">
<div class="div1 center" id="thread_<?= $original_post[0]['post_id']; ?>">
  <div style="display: flex; justify-content: space-around; align-items: center">
    <h class="govuk-heading-s">Post ID - <?= $original_post[0]['post_id']; ?></h>
    <h class="govuk-heading-s">Contact email - <?= $original_post[0]['post_email']; ?></h>
    <h class="govuk-heading-s">Submited at - <?= $original_post[0]['created_at']; ?></h>
  </div>
  <div class="govuk-grid-column-one-third">
    <img src="<?php echo $cdn ?>/<?= $original_post[0]['image_path'] ?>" class="post-img" alt="post image" onclick="window.open('<?php echo $cdn ?>/<?= $original_post[0]['image_path'] ?>', 'popup', '_blank');">
  </div>
  <hr class="govuk-section-break govuk-section-break govuk-section-break--visible">
  <p class="govuk-body govuk-!-font-size-24" style="text-align:center"><?= $original_post[0]['post_text']; ?></p>
  <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
  <form method='post' id="post_id" name="post_id">
    <input id="post_id" name="post_id" type="hidden" value="<?= $original_post[0]['post_id']; ?>">
    <input id="board_id" name="board_id" type="hidden" value="<?= $original_post[0]['board_id']; ?>">
    <button formaction="<?= base_url(); ?>/board/reportPost" class="govuk-button govuk-button--secondary" data-module="govuk-button">
      Report this post
    </button>
  </form>
</div>

<?php foreach ($new_sub_posts as $row) : ?>
  <div class="div1 center" id="sub_post_<?php echo $row['post_id']; ?>" style="background: #f3f2f1;">
    <div style="display: flex; justify-content: space-around; align-items: center">
      <h class="govuk-heading-s">Post ID - <?php echo $row['post_id']; ?></h>
      <h class="govuk-heading-s">Contact email - <?php echo $row['post_email']; ?></h>
      <h class="govuk-heading-s">Submited at - <?php echo $row['created_at']; ?></h>
    </div>
    <div class="govuk-grid-column-one-third">
      <img src="<?= $cdn ?>/<?php echo $row['image_path'] ?>" class="post-img" alt="post image" onclick="window.open('<?= $cdn ?>/<?php echo $row['image_path'] ?>', 'popup', '_blank');" />
    </div>
    <hr class="govuk-section-break govuk-section-break govuk-section-break--visible">
    <p class="govuk-body govuk-!-font-size-24" style="text-align:center"><?php echo $row['post_text']; ?></p>
    <hr class="govuk-section-break govuk-section-break--l govuk-section-break--visible">
    <form method='post' id="post_id" name="post_id">
      <input id="post_id" name="sub_post_id" type="hidden" value="<?php echo $row['post_id'] ?>">
      <input name="board_id" type="hidden" value="<?= $original_post[0]['board_id']; ?>">
      <button formaction="<?= base_url(); ?>/board/reportPost" class="govuk-button govuk-button--secondary" data-module="govuk-button">
        Report this post
      </button>
    </form>
  </div>
<?php endforeach; ?>
<div class="app-back-to-top" data-module="app-back-to-top">
  <a class="govuk-link govuk-link--no-visited-state app-back-to-top__link" href="#top" style="text-align:left;">
    <svg role="presentation" focusable="false" class="app-back-to-top__icon" xmlns="http://www.w3.org/2000/svg" width="13" height="17" viewBox="0 0 13 17">
      <path fill="currentColor" d="M6.5 0L0 6.5 1.4 8l4-4v12.7h2V4l4.3 4L13 6.4z"></path>
    </svg>Back to top
  </a>
</div>
</body>