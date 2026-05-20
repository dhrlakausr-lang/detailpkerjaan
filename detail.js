// ===============================
// SEARCH POPUP
// ===============================

const searchBtn =
document.getElementById("searchBtn");

const searchContainer =
document.getElementById("searchContainer");

searchBtn.addEventListener("click", () => {

    searchContainer.classList.toggle("active");

});

// ===============================
// SEARCH JOB
// ===============================

function searchJob(){

    const keyword =

    document
    .getElementById("searchInput")
    .value
    .toLowerCase()
    .trim();

    // DATA JOB
    const jobs = {

        "ui/ux designer": 1,

        "frontend developer": 2,

        "graphic designer": 3,

        "backend developer": 4

        const jobs = {

    "ui/ux designer": 1,

    "frontend developer": 2,

    "graphic designer": 3,

    "backend developer": 4

    };

    };

    // JIKA ADA
    if(jobs[keyword]){

        window.location.href =

        `detail.php?id=${jobs[keyword]}`;

    }else{

        alert("Pekerjaan tidak ditemukan");

    }

}

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

// CLOSE DROPDOWN

window.addEventListener("click", function(){

    document
    .getElementById("dropdownMenu")
    .style.display = "none";

});

// ===============================
// LOGOUT
// ===============================

function logout(){

    alert("Logout berhasil!");

    window.location.href = "index.html";

}

// ===============================
// SEARCH PEKERJAAN & GAJI
// ===============================

const searchInput =
document.getElementById("searchInput");

const notFound =
document.getElementById("notFound");

searchInput.addEventListener("keyup", () => {

    const value =
    searchInput.value.toLowerCase();

    // DATA PEKERJAAN
    const availableJobs = [

        "ui/ux designer",

        "frontend developer",

        "graphic designer",
        
        "backend developer":

    ];

    // DATA GAJI
    const availableSalary = [

        "5000000",

        "7000000",

        "8000000"

    ];

    // CEK PEKERJAAN
    const foundJob =
    availableJobs.some(job =>
        job.includes(value)
    );

    // CEK GAJI
    const foundSalary =
    availableSalary.some(salary =>
        salary.includes(value)
    );

    // TAMPILKAN ERROR
    if(

        value !== "" &&

        !foundJob &&

        !foundSalary

    ){

        notFound.style.display = "block";

    }else{

        notFound.style.display = "none";

    }

});