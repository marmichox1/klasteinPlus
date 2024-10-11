function validateLogin() {
    const login = document.getElementById('login').value.trim();
    const password = document.getElementById('password').value.trim();

    if (login === "" || password === "") {
        alert("Both fields are required!");
        return false;
    }
    return true;
}
