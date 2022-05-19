$(document).ready(function () {
  $(document).on("click", ".add-board-submit", function () {
    let name = document.forms["add-board-form"]["board_name"].value;
    let title = document.forms["add-board-form"]["board_title"].value;
    if (name.length > 3 || name.length == 0) {
      $(".board-name")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="national-insurance-number">
        Board Name
      </label>
      <div id="national-insurance-number-hint" class="govuk-hint">
        It can be up to 3 characters
      </div>
      <span id="national-insurance-number-error" class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Enter a Board Name in the correct format
      </span>
      <input class="govuk-input govuk-input--error" id="board_name" name="board_name" type="text" aria-describedby="national-insurance-number-hint national-insurance-number-error">
    </div>`);
      return false;
    }
    if (title.length > 255 || title.length == 0) {
      $(".board-title")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="national-insurance-number">
        Board Title
      </label>
      <div id="national-insurance-number-hint" class="govuk-hint">
        It can be up to 255 characters
      </div>
      <span id="national-insurance-number-error" class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Enter a Board Title in the correct format
      </span>
      <input class="govuk-input govuk-input--error" id="board_title" name="board_title" type="text" aria-describedby="national-insurance-number-hint national-insurance-number-error">
    </div>`);
      return false;
    } else {
      $("#add-board-form").submit();
    }
  });
  $(document).on("click", ".edit-modal", function () {
    let title = document.forms["edit-modal"]["board_title"].value;
    if (title.length > 255 || title.length == 0) {
      $(".board-title")
        .html(`<div class="govuk-form-group govuk-form-group--error">
      <label class="govuk-label" for="national-insurance-number">
        Board Title
      </label>
      <div id="national-insurance-number-hint" class="govuk-hint">
        It can be up to 255 characters
      </div>
      <span id="national-insurance-number-error" class="govuk-error-message">
        <span class="govuk-visually-hidden">Error:</span> Enter a Board Title in the correct format
      </span>
      <input class="govuk-input govuk-input--error" id="board_title" name="board_title" type="text" aria-describedby="national-insurance-number-hint national-insurance-number-error">
    </div>`);
      return false;
    } else {
      $("#MY_post").submit();
    }
  });
  $(document).on("click", ".delete-post-submit", function () {
    let password = document.forms["delete-post"]["password"].value;
    if (password == "") {
      $(".delete-post")
        .html(`<div class="govuk-form-group govuk-form-group--error">
    <label class="govuk-label" for="password">
      Password
    </label>
    <span class="govuk-error-message">
      <span class="govuk-visually-hidden">Error:</span> Password is required.
    </span>
    <input class="govuk-input govuk-input--error" id="password" name="password" type="password">
  </div>`);
      return false;
    }
    $("#delete-post").submit();
  });
  $(document).on(
    "click",
    ".add-board, .edit-board, .delete-board, .users-button",
    function () {
      const href = $(this).attr("data-target");
      $("#backdrop").css("height", $(document).height());
      $("html").css("overflow-y", "hidden");
      $("#backdrop").fadeIn(100, function () {
        $("#confirm").load(href);
      });

      $("#confirm").show();
    }
  );
  $(document).one(
    "click",
    ".delete-board-submit, .delete-user-submit",
    function () {
      $(".delete-confirm")
        .html(`<div class="govuk-form-group govuk-form-group--error">
    <hr>
  <span id="national-insurance-number-error" class="govuk-error-message">
    <span class="govuk-visually-hidden">Error:</span> Do you wish to continue?
  </span>
</div>`);

      $(document).one(
        "click",
        ".delete-board-submit, .delete-user-submit",
        function () {
          // Second click
          $("#delete-board").submit();
        }
      );
    }
  );
  $(document).on("click", ".close-dialog", function () {
    $("#confirm").css({
      display: "none",
    });
    $(".main-container").css("overflow-y", "auto");
    $(".main-container").css("overflow-x", "hidden");
    $("#backdrop").fadeOut(100);
    $("#confirm").empty();
  });
  $(".delete-post-pass").on("click", function () {
    event.preventDefault();
    const url = $(this).attr("data-target");
    $("#backdrop").css("height", $(document).height());
    $("#backdrop").fadeIn(100, function () {
      $("#confirm").load(url);
    });
    $("#confirm").show();
  });
  $(".delete-post").on("click", function () {
    $(".delete-post").on("click", function () {
      event.preventDefault();
      const url =
        "/board/modal?target=" +
        $(this).attr("data-target") +
        "&board=" +
        $(this).attr("data-board");
      $("#confirm").load(url, function (result) {
        $("#confirm").show();
      });
    });
    $(document).on("click", "#close_dialog", function () {
      $("#confirm").hide();
    });
  });

  $("#header-text").on("click", function () {
    window.location.href = "/";
  });
  $(document).on("click", ".unsage", function () {
    const id = $(this).attr("data-id");
    Cookies.remove(id);
    $("#saged_" + id).css({ display: "none" });
    $("#" + id).css({ display: "block" });
  });
  $(".sage").on("click", function () {
    const div = document.getElementById($(this).attr("data-id"));
    const id = $(div).attr("id").substring(7);
    $(div).hide();
    $(div)
      .eq(0)
      .after(
        `<div class="saged" id="saged_` +
          $(div).attr("id") +
          `" style="display: flex; justify-content: space-around; align-items: center">
        <h class="govuk-heading-s">Post ID - ` +
          id +
          `</h>
        <button class="govuk-button govuk-button--secondary flex unsage" data-module="govuk-button" data-id="thread_` +
          id +
          `">
        Saged
      </button>
        </div>`
      );
    Cookies.set($(this).attr("data-id"), true, { expires: 30 });
  });
  const threads = $(".div1").map(function () {
    if (document.cookie.indexOf($(this).attr("id")) != -1) {
      $(this).css({
        display: "none",
      });
      $(this)
        .eq(0)
        .after(
          `<div class="saged" id="saged_` +
            $(this).attr("id") +
            `" style="display: flex; justify-content: space-around; align-items: center">
        <h class="govuk-heading-s">Post ID - ` +
            $(this).attr("id").substring(7) +
            `</h>
        <button class="govuk-button govuk-button--secondary flex unsage" data-module="govuk-button" data-id="` +
            $(this).attr("id") +
            `">
        Saged
      </button>
        </div>`
        );
    }
  });
});

function ValidateEmail(mail) {
  if (
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.emailAddr.value)
  ) {
    return true;
  }
  alert("You have entered an invalid email address!");
  return false;
}
function onSubmit(token) {
  let title = document.forms["newpostform"]["post_title"].value;
  let text = document.forms["newpostform"]["post_text"].value;
  let file = document.forms["newpostform"]["userfile"].value;

  if (title == "") {
    document.getElementById(
      "title-div"
    ).innerHTML = `<div class="govuk-form-group govuk-form-group--error">
    <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_title">
        Post Title
      </label>
    </h1>
    <div id="event-name-hint" class="govuk-hint">
      Post Title is required - maximum 255 characters.
    </div>
    <span id="event-name-error" class="govuk-error-message">
      <span class="govuk-visually-hidden">Error:</span> Enter desired post title
    </span>
    <input class="govuk-input govuk-input--error" id="post_title" name="post_title" type="text" aria-describedby="event-name-hint event-name-error">
  </div>`;
    return false;
  }
  if (text == "") {
    document.getElementById(
      "text-div"
    ).innerHTML = `<div class="govuk-form-group govuk-form-group--error">
    <h1 class="govuk-label-wrapper"><label class="govuk-label govuk-label--l" for="post_text">
        Post text
      </label>
    </h1>
    <div id="more-detail-hint" class="govuk-hint">
      Post text is required - maximum 100000 characters
    </div>
    <span id="more-detail-error" class="govuk-error-message">
      <span class="govuk-visually-hidden">Error:</span> Enter your post text
    </span>
    <textarea class="govuk-textarea govuk-textarea--error" id="post_text" name="post_text" rows="6" aria-describedby="more-detail-hint more-detail-error"></textarea>
  </div>`;
    return false;
  }
  if (file == "") {
    document.getElementById(
      "file-div"
    ).innerHTML = `<div class="govuk-form-group govuk-form-group--error">
    <label class="govuk-label" for="file-upload-1">
      Upload a file
    </label>
    <span id="file-upload-1-error" class="govuk-error-message">
      <span class="govuk-visually-hidden">Error:</span> Image must be valid file and no greater than 10MB
    </span>
    <input class="govuk-file-upload govuk-file-upload--error" id="userfile" name="userfile" type="file" aria-describedby="file-upload-1-error">
  </div>`;
    return false;
  } else {
    $(".form-post").submit();
  }
}
