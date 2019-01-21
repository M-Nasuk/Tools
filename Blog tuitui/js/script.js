// Function to clear all input text areas in a form //
function clrinput() {
	let elements = [];
    elements = document.getElementsByClassName("tarea");


	for (var i=0; i<elements.length; i++) {
		elements[i].value = "";
	};
};