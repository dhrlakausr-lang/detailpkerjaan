// ===============================
// DROPDOWN MENU
// ===============================

function toggleMenu(event){

    event.stopPropagation();

    const menu =
    document.getElementById("dropdownMenu");

    if(menu.style.display === "block"){

        menu.style.display = "none";

    }else{

        menu.style.display = "block";

    }

}

// ===============================
// CLOSE DROPDOWN
// ===============================

window.addEventListener("click", function(){

    const menu =
    document.getElementById("dropdownMenu");

    if(menu){

        menu.style.display = "none";

    }

});

// ===============================
// LOGOUT
// ===============================

function logout(){

    alert("Logout berhasil!");

    window.location.href = "index.html";

}