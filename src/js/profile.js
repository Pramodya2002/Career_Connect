var i=1;

document.addEventListener('DOMContentLoaded', function(){
	var buttons = document.querySelectorAll(".setting-button");
	buttons.forEach((button) => {
		button.addEventListener('click', showInput);
	});
});
//console.log("Loaded");

function showInput(){
	this.removeEventListener('click', showInput);
	this.addEventListener('click', cancelInput);
	
	this.value = "close";
	this.classList.add("cancel");
	
	let input_holder = this.parentElement.previousElementSibling;
	let value = input_holder.innerText;
	let form = document.createElement('form');
	let input = document.createElement('input');
	let btn = document.createElement('input');
	
	let column = input_holder.getAttribute("data-column");
	
	console.log(column);
	
	
	this.setAttribute('data-input', value);
	
	input.value = value;
	
	if(!value){
		value = "Enter a ";
	}
	
	input.placeholder = value;
	input.name = this.getAttribute('data-identifier');
	input.classList.add('in-t2');
	
	btn.type = "submit";
	btn.value = "check";
	btn.addEventListener('mouseover', function(e){
		btn.style.backgroundColor = "var(--darker-green)";
	});
	btn.addEventListener('mouseout', function(e){
		btn.style.backgroundColor = "var(--dark-green)";
	});
	btn.classList.add("bt-t2");
	btn.classList.add("material-icons")
	
	form.classList.add('setting-form');
	form.appendChild(input);
	form.appendChild(btn);
	
	form.method = 'POST';
	
	form.setAttribute('action', 'api/update-user.php');
	
	input_holder.innerHTML = "";
	
	input_holder.appendChild(form);
	//console.log(input_holder.innerHTML);
}

function cancelInput(){
	this.removeEventListener('click', cancelInput);
	this.value = "edit";
	this.classList.remove('cancel');
	let value = this.getAttribute('data-input');
	//e.removeEventListener('click', addListner);
	this.addEventListener('click', showInput);
	//addListner(this);
	let input_holder = this.parentElement.previousElementSibling;
	
	input_holder.innerHTML = value;
}