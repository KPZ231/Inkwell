function showWindow(window_ = document.getElementById("customizeWindow")) {
  if (window_.style.display === "block") {
    window_.style.display = "none";
  } else {
    window_.style.display = "block";
  }
}


function setDefaults() {
  document.body.style.backgroundColor = "#303030";
  document.getElementById("editor").style.backgroundColor = "#343434";
  document.getElementById("preview").style.backgroundColor = "#404040";
  document.getElementById("toolbar").style.backgroundColor = "#343434";
  document.body.style.color = "#f5f5f5";
  document.querySelectorAll("code").forEach(function(code) {
    code.style.color = "#ffffff";
  });
  document.body.style.fontFamily = "monospace";
  bodyColorPicker.value = "#303030";
  editorColorPicker.value = "#343434";
  previewColorPicker.value = "#404040";
  toolbarColorPicker.value = "#343434";
  textColorPicker.value = "#f5f5f5";
  codeColorPicker.value = "#ffffff";
  fontDropdown.value = "monospace";
}


var bodyColor = document.body.style.backgroundColor;
var editorColor = document.getElementById("editor").style.backgroundColor;
var previewColor = document.getElementById("preview").style.backgroundColor;
var toolbarColor = document.getElementById("toolbar").style.backgroundColor;
var font = document.body.style.fontFamily;
var textColor = document.querySelectorAll("p, h1, h2, h3, h4");
var codeColor = document.querySelectorAll("code");

var bodyColorPicker = document.getElementById("bodyColorSelector");
var editorColorPicker = document.getElementById("editorColorSelector");
var previewColorPicker = document.getElementById("previewColorSelector");
var toolbarColorPicker = document.getElementById("toolbarColorSelector");
var textColorPicker = document.getElementById("textColorSelector");
var codeColorPicker = document.getElementById("codeColorSelector");
var fontDropdown = document.getElementById("fontDropdown");

bodyColorPicker.addEventListener("change", function (event) {
  document.body.style.backgroundColor = event.target.value;
  bodyColor = document.body.style.backgroundColor;
  saveData();
});

editorColorPicker.addEventListener("change", function (event) {
  document.getElementById("editor").style.backgroundColor = event.target.value;
  editorColor = document.getElementById("editor").style.backgroundColor;
  saveData();
});

previewColorPicker.addEventListener("change", function (event) {
  document.getElementById("preview").style.backgroundColor = event.target.value;
  previewColor = document.getElementById("preview").style.backgroundColor;
  saveData();
});

toolbarColorPicker.addEventListener("change", function (event) {
  document.getElementById("toolbar").style.backgroundColor = event.target.value;
  toolbarColor = document.getElementById("toolbar").style.backgroundColor;
  saveData();
});

fontDropdown.addEventListener("change", function (event) {
  document.body.style.fontFamily = event.target.value;
  saveData();
});

textColorPicker.addEventListener("change", function (event) {
  var elements = document.querySelectorAll("p, h1, h2, h3, h4");
  elements.forEach(function (element) {
    element.style.color = event.target.value;
    saveData();
  });
});

codeColorPicker.addEventListener("change", function (event) {
  var codeElements = document.querySelectorAll("code");
  for (var i = 0; i < codeElements.length; i++) {
    codeElements[i].style.color = event.target.value;
    saveData();
  }
});

// Save the data to cookies
function saveData() {
  document.cookie = "bodyColor=" + encodeURIComponent(bodyColor) + ";path=/";
  document.cookie =
    "editorColor=" + encodeURIComponent(editorColor) + ";path=/";
  document.cookie =
    "previewColor=" + encodeURIComponent(previewColor) + ";path=/";
  document.cookie =
    "toolbarColor=" + encodeURIComponent(toolbarColor) + ";path=/";
  document.cookie =
    "fontFamily=" +
    encodeURIComponent(document.body.style.fontFamily) +
    ";path=/";
  document.cookie = "textColor=" + encodeURIComponent(textColor) + ";path=/";
  document.cookie = "codeColor=" + encodeURIComponent(codeColor) + ";path=/";
}

// Load the data from cookies
function loadData() {
  var cookies = document.cookie.split(";");
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf("bodyColor=") == 0) {
      bodyColor = decodeURIComponent(
        cookie.substring("bodyColor=".length, cookie.length)
      );
      document.body.style.backgroundColor = bodyColor;
    }
    if (cookie.indexOf("editorColor=") == 0) {
      editorColor = decodeURIComponent(
        cookie.substring("editorColor=".length, cookie.length)
      );
      document.getElementById("editor").style.backgroundColor = editorColor;
    }
    if (cookie.indexOf("previewColor=") == 0) {
      previewColor = decodeURIComponent(
        cookie.substring("previewColor=".length, cookie.length)
      );
      document.getElementById("preview").style.backgroundColor = previewColor;
    }
    if (cookie.indexOf("toolbarColor=") == 0) {
      toolbarColor = decodeURIComponent(
        cookie.substring("toolbarColor=".length, cookie.length)
      );
      document.getElementById("toolbar").style.backgroundColor = toolbarColor;
    }
    if (cookie.indexOf("fontFamily=") == 0) {
      var fontFamily = decodeURIComponent(
        cookie.substring("fontFamily=".length, cookie.length)
      );
      document.body.style.fontFamily = fontFamily;
      fontDropdown.value = fontFamily;
    }
    if (cookie.indexOf("textColor=") == 0) {
      textColor = decodeURIComponent(
        cookie.substring("textColor=".length, cookie.length)
      );
      var elements = document.querySelectorAll("p, h1, h2, h3, h4");
      elements.forEach(function (element) {
        element.style.color = textColor;
      });
    }
    if (cookie.indexOf("codeColor=") == 0) {
      codeColor = decodeURIComponent(
        cookie.substring("codeColor=".length, cookie.length)
      );
      var codeElements = document.querySelectorAll("code");
      for (var j = 0; j < codeElements.length; j++) {
        codeElements[j].style.color = codeColor;
      }
    }
  }
}

// Call loadData() function when the page is loaded to load the saved data from cookies
window.addEventListener("load", function () {
  loadData();

  var savedData = loadData();
  if (savedData) {
    document.body.style.backgroundColor = savedData.bodyColor;
    document.getElementById("editor").style.backgroundColor = savedData.editorColor;
    document.getElementById("preview").style.backgroundColor = savedData.previewColor;
    document.getElementById("toolbar").style.backgroundColor = savedData.toolbarColor;
    document.body.style.color = savedData.textColor;
    document.querySelectorAll("code").forEach(function(code) {
      code.style.color = savedData.codeColor;
    });
    document.body.style.fontFamily = savedData.fontFamily;
    bodyColorPicker.value = savedData.bodyColor;
    editorColorPicker.value = savedData.editorColor;
    previewColorPicker.value = savedData.previewColor;
    toolbarColorPicker.value = savedData.toolbarColor;
    textColorPicker.value = savedData.textColor;
    codeColorPicker.value = savedData.codeColor;
    fontDropdown.value = savedData.fontFamily;
  }
});
