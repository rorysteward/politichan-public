<div class="center">
  <h1 class="govuk-heading-m flex">/<?= $board_details[0]['board_name'] ?> - <?= $board_details[0]['board_title'] ?></h1>
  <hr class="govuk-section-break govuk-section-break--m govuk-section-break--visible">
</div>
<main class="govuk-main-wrapper">
  <div class="modal hidden" id="confirm" role="dialog"></div>
  <div class="govuk-width-container" style="zoom: 1; padding-bottom: 0px;">

    <div class="govuk-grid-row">
      <div class="govuk-grid-column-two-thirds">
        <form class="form-post" name="newpostform" method="post" enctype="multipart/form-data" action="<?= base_url() ?>/board/newPost">
          <input id="board_id" name="board_id" type="hidden" value="<?= $board_id ?>">

          <fieldset class="govuk-fieldset">
            <div class="govuk-form-group" id="email-div">
              <label class="govuk-label">
                Email
              </label>
              <input class="govuk-input govuk-input--width-20 post_email" id="post_email" name="post_email" type="text">
            </div>
            <div class="govuk-form-group" id="title-div">
              <label class="govuk-label">
                Post Title
              </label>
              <input class="govuk-input govuk-input--width-20 post_title" id="post_title" name="post_title" type="text">
            </div>
            <div class="form-group" id="text-div">
              <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--m" for="post_text">
                  Post text
                </label>
              </h1>
              <textarea required class="govuk-textarea post_text" id="post_text" name="post_text" rows="4"></textarea>
            </div>
            <div class="govuk-form-group" id="file-div">
              <label class="govuk-label" for="userfile">
                Upload a file
              </label>
              <input class="govuk-file-upload" id="userfile" name="userfile" type="file" accept="image/*" />
            </div>
            <label class="govuk-label" for="post_password">
              Password to delete post
            </label>
            <div class="govuk-form-group flex">

              <input class="govuk-input govuk-!-width-two-thirds" id="post_password" name="post_password" type="text" value="<?= $post_password ?>" readonly />
              <button class="g-recaptcha govuk-button" data-sitekey="<?php echo $site_key ?>" data-callback='onSubmit' data-action='submit'>Submit</button>
            </div>
          </fieldset>

        </form>
      </div>
    </div>
  </div>
</main>
<div class="govuk-grid-row">
  <div class="center">
    <?php if (isset($op_posts)) { ?>
      <?php foreach ($op_posts as $i => $op_post) { ?>
        <div class="div1" id="thread_<?= $op_post['post_id']; ?>">
          <div style="display: flex; justify-content: space-around; align-items: center">
            <h6 class="govuk-heading-s">Post ID - <?= $op_post['post_id']; ?></h6>
            <h6 class="govuk-heading-s">Contact email - <?= $op_post['post_email']; ?></h6>
            <h6 class="govuk-heading-s">Submited at - <?= $op_post['created_at']; ?></h6>
            <button class="govuk-button govuk-button--secondary flex sage" data-module="govuk-button" data-id="thread_<?= $op_post['post_id']; ?>">
              Sage
            </button>
          </div>

          <hr class="govuk-section-break govuk-section-break--visible">
          <h6 class="govuk-heading-s center"><?= $op_post['post_title']; ?></h6>
          <hr class="govuk-section-break govuk-section-break--visible">
          <div class="govuk-grid-column-one-third">
            <img src="<?php echo $cdn ?>/<?= $op_post['image_path'] ?>" class="post-img" alt="post image" onclick="window.open('<?php echo $cdn ?>/<?= $op_post['image_path'] ?>', 'popup', '_blank');" />
          </div>
          <p class="govuk-body govuk-!-font-size-24"><?= $op_post['post_text']; ?></p>
          <hr class="govuk-section-break govuk-section-break--visible">
          <p class="govuk-body govuk-!-font-size-02" style="text-align:right">This thread has <?= $sub_post_count[$i][0]['count']; ?> responses</p>
          <div class="buttons">
            <form method='post' class="report-post" name="post_id">
              <input name="post_id" type="hidden" value="<?= $op_post['post_id']; ?>">
              <input name="board_id" type="hidden" value="<?= $board_id ?>">

              <button style="float:right" formaction="<?= base_url(); ?>/board/reportPost" class="govuk-button govuk-button--secondary" data-module="govuk-button">
                Report this post
              </button>
            </form>
            <a style="float:right" href="<?= base_url(); ?>/thread/<?= $op_post['post_id']; ?>" class="govuk-button" data-module="govuk-button">Continue to thread</a>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      no posts found
    <?php } ?>
  </div>
  <?= $pager->links() ?>
</div>