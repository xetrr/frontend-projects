$(function () {
  "use strict";

  // Initialize: Show login form if "Login" span has "selected" class
  var selectedSpan = $(".login-page h3 span.selected");
  if (selectedSpan.length) {
    var initialFormClass = selectedSpan.data("class") + "-form";
    $(".login-page form").hide(); // Hide all forms first
    $("." + initialFormClass).show(); // Show the correct form
  }

  // switch between login and signup
  $(".login-page h3 span").click(function () {
    $(this).addClass("selected").siblings().removeClass("selected");
    $(".login-page form").hide();
    // Append "-form" to match the actual form class names
    var formClass = $(this).data("class") + "-form";
    console.log("Showing form: ." + formClass);
    $("." + formClass).fadeIn(100);
  });

  // Live preview: Update item name in preview as user types
  $(".live-name").on("keyup input", function () {
    $(".live-preview .caption h5.card-title").text($(this).val());
  });
  $(".live-desc").on("keyup input", function () {
    $(".live-preview .caption p.card-text").text($(this).val());
  });
  $(".live-price").on("keyup input", function () {
    let value = $(this).val().replace(/[^0-9]/g, '');
    $(".live-preview .price-tag").text( "$"+ value);
  });
});

$(".confirm").click(function () {
  return confirm("Are you sure?");
});

// category show and hide
