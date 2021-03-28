"use strict";

var $ = function (id) {
  return document.getElementById(id);
};

var calculate = function () {
  // Get values
  var miles = $("miles_driven").value;
  var gallons = $("gallons_used").value;
  // Assume no errors
  $("miles_error").firstChild.nodeValue = "*";
  $("gallons_error").firstChild.nodeValue = "*";
  var valid = true;

  // Check for errors
  if (isNaN(miles) || miles <= 0) {
    $("miles_error").firstChild.nodeValue =
      "Miles must be numeric and greater than zero.";
    valid = false;
  }
  if (isNaN(gallons) || gallons <= 0) {
    $("gallons_error").firstChild.nodeValue =
      "Gallons must be numeric and greater than zero.";
    valid = false;
  }

  // If no errors, calculate
  if (valid) {
    $("miles_error").firstChild.nodeValue = "";
    $("gallons_error").firstChild.nodeValue = "";
    $("miles_per_gallon").value = miles / gallons;
  }
};

var clearFields = function () {
  $("miles_driven").value = "";
  $("miles_error").firstChild.nodeValue = "*";
  $("gallons_used").value = "";
  $("gallons_error").firstChild.nodeValue = "*";
  $("miles_per_gallon").value = "";    
};

window.onload = function () {
  $("submit").onclick = calculate;
  $("clear").onclick = clearFields;
  $("miles_per_gallon").ondblclick = clearFields;
  $("miles_driven").focus();
};
