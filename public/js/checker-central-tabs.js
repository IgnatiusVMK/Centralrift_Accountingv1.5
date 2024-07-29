document.addEventListener("DOMContentLoaded", function() {
    // Hide all forms except the default form
    var tabcontent = document.getElementsByClassName("tab-pane");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("show", "active");
    }

    // Show the default form
    document.getElementById("Cycles").classList.add("show", "active");
    document.getElementById("Cycles-tab").classList.add("active");
});

function openForm(evt, formName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-pane");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("show", "active");
    }
    tablinks = document.getElementsByClassName("nav-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    document.getElementById(formName).classList.add("show", "active");
    evt.currentTarget.classList.add("active");
}
