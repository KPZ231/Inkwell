const documentName = document.getElementById("documentName");

function save() {
  var myFile = new File([editor.value], documentName.value, {
    type: "text/plain;charset=utf-8",
  });
  saveAs(myFile);
}

function loadFile() {
  const input = document.createElement("input");
  input.type = "file";
  input.accept = "text/markdown";
  input.addEventListener("change", () => {
    const file = input.files[0];
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      editor.value = reader.result;
      const markdown = editor.value;
      preview.innerHTML = marked(markdown);
      hljs.highlightAll();
    });
    reader.readAsText(file);
  });
  input.click();
}
