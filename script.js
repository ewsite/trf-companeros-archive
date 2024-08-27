
// VALIDATION FOR CONFIRMING PASSWORD

let pass1 = document.querySelector('#passwored');
let pass2 = document.querySelector('#pass');
let result = document.querySelector('h5');

function checkpassword() {
    result.innerText = pass1.value == pass2.value ? 'Matching' : 'Not Matching';
}

pass1.addEventListener('keyup', () => {
    if (pass2.value.lenght != 0) checkpassword();
    if (pass1.value == "") result.innerText = 'Not Matching';
    if (pass2.value == "") result.innerText = 'Not Matching';
})
pass2.addEventListener('keyup', checkpassword);

